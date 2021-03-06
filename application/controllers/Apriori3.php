<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', '-1');

class Apriori extends CI_Controller {

	private $data;
	private $itemsets = [];
	private $assoc_rules = [];
	private $thresholds = [];
	private $last_iteration = 0;
	private $current_iteration = 0;

	public function index()
	{
		$data['page'] = 'Buat Paket';
		$data['assoc'] = $this->model->get_assoc()->result();
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['detail'] = $this->model->get_detail_assoc('1')->result();
		$data['content'] = 'pages/Buat_paket';
		$this->load->view('template/main', $data);
	}

	public function start()
	{
		$min_sup = $this->input->post('min_sup');
		$min_conf = $this->input->post('min_conf');
		// var_dump($min_sup.' - '.$min_conf);die();

		$this->set_threshold($min_sup,$min_conf);
		$this->kosongkan();
		$datas = $this->ambil_dataset();
		// echo "<pre>";
		// print_r($datas);die();
		$this->set_data($datas); // digunakan untuk inisalisasi private $data
		
		$lopp=1;
		while ($this->possible()) {
			$this->itemset_kandidat();
			$this->itemset_besar();

			echo "<pre>";
			// var_dump('IKI HASIL C'.$lopp);
			// var_dump($this->itemsets);
			// die();
			$lopp++;
		}
		echo "<pre>";
		// var_dump($this->itemsets);die();

		$this->aturan_asosiasi();
		$aturan = $this->get_assoc_rules();

		// echo "<pre>";
		// print_r($datas);
		// var_dump($aturan);die();

		$data['page'] = 'Buat Paket';
		$data['assoc'] = $this->model->get_assoc()->result();
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['detail'] = $this->model->get_detail_assoc('1')->result();
		$data['content'] = 'pages/Buat_paket';
		$this->load->view('template/main', $data);
	}

	public function set_threshold($min_sup,$min_conf)
	{
		# code...
		$this->thresholds = [
			'min_sup' => $min_sup,
			'min_conf' => $min_conf           
		];
	}

	public function kosongkan()
	{
		# code...
		$this->db->truncate('temp_assoc');
		$this->db->truncate('temp_assoc_detail');
	}

	public function ambil_dataset()
	{
		# code...
		echo "<pre>";
		// $tgl = date('Y-m');
		$tgl = '2019-08';
		$bulan = '08';
		$tahun = '2019';

		$dataset = [];
		$get_id = $this->model->getIDdate('transaksi',$bulan,$tahun)->result();
		foreach ($get_id as $key) {
			$id = $key->id_trans;
			$jml = $this->model->get_menu($id)->result();
			foreach ($jml as $menu) {
				$id_menu[] = $menu->id_menu;
				$arr[] = $menu->nama_menu;
			}
			array_push($dataset, [
				'id' => $id,
				'tags' => $id_menu,
				'menu' => $arr
			]);
			// var_dump($dataset);
			unset($id_menu);
			unset($arr); // menghapus array yang bernilai sama
		}

		$in = $this->model->get_input()->result();
		$inputan = [];
		foreach ($in as $a) {
			# code...
			// $inputan = $a->id_menu;
			array_push($inputan, $a->id_menu);
			// var_dump($inputan);
		}

		$data = [
			'input' => $inputan,
			'dataset' => $dataset 
		];
		// var_dump($data);
		// die();

		return $data;
	}

	public function set_data($_data){
		$this->data = $_data;
	}

	public function get_assoc_rules(){
		return $this->assoc_rules;
	}

	// Step 1
	// Cek Jika Iterasi Terakhir Kurang Dari Iterasi Saat ini atau
	// Iterasi Terakhir  Kurang dari sama dengan 0 atau
	// Iterasi Saat ini Kurang dari sama dengan 0 maka akan me-return 'true' jika tidak maka 'false'
	public function possible(){
		return ($this->last_iteration < $this->current_iteration || $this->last_iteration <= 0 || $this->current_iteration <= 0) ? true : false;
	}

	//Step 3
	//Jika itemset == null maka return  $max = 1
	public function buat_iterasi(){
		$max = 0;
		if($this->itemsets == []){ 
			// var_dump('null');die();
			$max = 1;
		}else{
			foreach ($this->itemsets as $itemset) {
				if($itemset['iteration'] >= $max){
					$max = $itemset['iteration'] + 1;
				}
			}
		}
		return $max;
	}

	public function get_min_sup(){
		return floor(count($this->data['dataset'])*($this->thresholds['min_sup']/100));
	}

	// Step 4 
	public function itemset_exists($_itemset){
		$response = false;
		// var_dump($this->itemsets);die();
		if($this->itemsets != []){ // Tidak sama dengan null
			foreach ($this->itemsets as $i => $i_value) {
				if($this->match($_itemset, $this->itemsets[$i]['itemset'])){
					$response = true;
				}
			}
		}
		// var_dump($response);die();
		return $response;
	}

	public function match($str_a, $str_b){
		$response = false;
		// var_dump($str_b);
		$items_a = !is_array($str_a) ? explode(' ', $str_a) : $str_a;
		$items_b = !is_array($str_b) ? explode(' ', $str_b) : $str_b;
		// var_dump($items_a);
		if($this->itemsets){
			natsort($items_a);
			natsort($items_b);
			if(implode(' ', $items_a) == implode(' ', $items_b)){
				$response = true;
			}
		}
		return $response;
	}

	public function tambah_itemset($iteration, $tag){
		$this->itemsets[] = [
			'iteration' => $iteration,
			'itemset' => $tag,
			'sup_count' => 0
		];
		// echo "<pre>";
		// var_dump($this->itemsets);
	}

	//Step 2
	public function itemset_kandidat(){
		$iteration = $this->buat_iterasi(); // iteration == $max di function buat iterasi
		// echo "<pre>";
		// var_dump($this->data['dataset']);
		// echo('<br/>');
		// var_dump('Iterasi Ke >>>>>>>>>>>>>>>>>>>> '.$iteration);
		// echo('<br/>');
		if($iteration == 1){
			foreach ($this->data['dataset'] as $d) {
				foreach ($d['tags'] as $tag) {
					// var_dump($tag);
					if(!$this->itemset_exists($tag)){ // -> Step 4             proses 1:false
						// var_dump('bernilai true');
						$this->tambah_itemset($iteration, $tag); // ditambahkan pada private $itemsets
					}
				}
			}
			// echo "<pre>";
			// var_dump($this->itemsets);
		} else {
			foreach ($this->itemsets as $key_prev => $value_prev) { // $key_prev : array ke 0 itemsets[]
				// var_dump($value_prev);die();
				if($this->itemsets[$key_prev]['iteration'] == $iteration - 1){
					foreach ($this->data['dataset'] as $key_data => $value_data) {
						foreach ($this->data['dataset'][$key_data]['tags'] as $key_tag => $value_tag) {
							if(!in_array($this->data['dataset'][$key_data]['tags'][$key_tag], explode(' ', $this->itemsets[$key_prev]['itemset']))){
								$new_itemset = implode(' ', [$this->itemsets[$key_prev]['itemset'], $this->data['dataset'][$key_data]['tags'][$key_tag]]);
								// var_dump($new_itemset);
								if(!$this->itemset_exists($new_itemset)){
									$this->tambah_itemset($iteration, $new_itemset);
								}
							}
						}
					}
				}
			}
			// echo "<pre>";
			// var_dump($this->itemsets);
		}
		$this->tambah_frekuensi_itemset($iteration);
	}

	public function tambah_frekuensi_itemset($iteration){
		// var_dump(count($this->itemsets).' data $itemsets di proses');
		// var_dump(count($this->data['dataset']).' data $data[dataset] di proses');
		foreach ($this->data['dataset'] as $d => $d_value) {
			foreach ($this->itemsets as $i => $i_value) {
				// echo "<pre>";
				// var_dump(explode(' ', $this->itemsets[0]['itemset']));
				if($this->itemsets[$i]['iteration'] == $iteration){
					$intersect_count = 0;
					foreach (explode(' ', $this->itemsets[$i]['itemset']) as $single_item) { //// berdasarkan jumlah item transaksi
						if(in_array($single_item, $this->data['dataset'][$d]['tags'])){

							// var_dump(in_array($single_item, $this->data['dataset'][$d]['tags']));
							// var_dump('single item');
							// var_dump($single_item);
							// var_dump($this->data['dataset'][$d]['tags']);

							$intersect_count++;
						}
					}
					if($intersect_count == count(explode(' ', $this->itemsets[$i]['itemset']))){
						// var_dump('hahaha');
						// var_dump('intersect count '.$intersect_count.' + '.count(explode(' ', $this->itemsets[$i]['itemset'])));
						foreach ($this->itemsets as $existing_itemset => $value) {
							if($this->itemsets[$existing_itemset]['itemset'] === $this->itemsets[$i]['itemset']){
								$this->itemsets[$existing_itemset]['sup_count']++;
							}

							/////////////////// VARDUMP
							// if (c) {
							// 	var_dump('if '.$this->itemsets[$existing_itemset]['itemset'].' = '.$this->itemsets[$i]['itemset']);
							// 	var_dump('sup-count '.$this->itemsets[$existing_itemset]['itemset'].' => '.$this->itemsets[$existing_itemset]['sup_count']);
							// 	echo "<br/>";
							// }
						}
						// die();
					}
				}
			}
		}
		/////// VARDUMP
		// var_dump('IKI HASIL C'.$iteration);
		// echo "<br/>";
		// var_dump($this->itemsets);
		// for ($ase=0; $this->itemsets[$ase]['sup_count'] > 0; $ase++) { 
		// 	var_dump($this->itemsets[$ase]);
		// }
		// die();
	}

	public function itemset_besar(){
		foreach ($this->itemsets as $key => $value) {
			
			///////// VARDUMP SEMUA DATA SETELAH MEMILIKI NILAI SUP_COUNT (C1 SEBELUM DISELEKSI)
			// var_dump($this->itemsets);
			// var_dump($this->itemsets[$key]['sup_count'].' < '.$this->get_min_sup());
			/////////

			if($this->itemsets[$key]['sup_count'] < $this->get_min_sup()){ // eleminasi / scan
				unset($this->itemsets[$key]);
			}
			// var_dump('BATAS MIN_SUP '.$this->get_min_sup());
			// var_dump($this->itemsets);
		}
		// var_dump('BATAS MIN_SUP '.$this->get_min_sup());die();

		$this->itemsets = array_values($this->itemsets);
		$this->last_iteration = $this->current_iteration;
		$this->current_iteration = ($this->buat_iterasi() - 1);

		// var_dump($this->last_iteration);
		// var_dump($this->current_iteration);
		// var_dump($this->itemsets);
	}

	public function aturan_asosiasi(){
		$num = 1;
		$assoc_detail = [];
		foreach ($this->data['input'] as $input_item) {
			
			foreach ($this->itemsets as $i => $i_value) {
				if($this->itemsets[$i]['iteration'] >= 2){
					$items = explode(' ', $this->itemsets[$i]['itemset']);
					if(in_array($input_item, $items)){
						$dataset_count = 0;
						foreach ($this->data['dataset'] as $d => $d_value) {
							$item_count = 0;
							foreach ($items as $item) {
								if(in_array($item, $this->data['dataset'][$d]['tags'])) $item_count++;
							}
							if($item_count == count($items)){
								$dataset_count++;
							}
						}
						
						foreach ($this->itemsets as $j => $j_value) {
							if($this->itemsets[$j]['iteration'] == 1){
								if($this->match($this->itemsets[$j]['itemset'], $input_item)){
									$sup_count = $this->itemsets[$j]['sup_count'];
									$confidence = floor(($dataset_count/$sup_count)*100);
									
									if($confidence >= $this->thresholds['min_conf']){
										$assoc_items = implode(' ', array_diff($items, explode(' ', $input_item)));
										// var_dump($items);

										$this->insert_assoc($num,$confidence);

										$assoc_detail[] = [
											'items' => $items
										];


										$this->assoc_rules[] = [
											'item' => $input_item,
											'assoc_items' => $assoc_items,
											'confidence' => $confidence
										];
										$num++;

										
									}
								}
							}
						}
					}
				}
			}
		}

		$this->insert_assoc_detail($assoc_detail);
	}


	public function insert_assoc($num,$conf)
	{
		# code...
		$cek_assoc = $this->model->get_temp()->result();
		
		if ($num == 1) {
			# code...
			$data = array(
		        'id_assoc'=>$num,
		        'confidence' => $conf,
		        'tgl_assoc'=>date('Y-m-d')
			);
			$this->db->insert('temp_assoc',$data);
		} else if ($cek_assoc != $num && $cek_assoc != null) {
			# code...
			$data = array(
		        'id_assoc'=>$num,
		        'confidence' => $conf,
		        'tgl_assoc'=>date('Y-m-d')
			);
			$this->db->insert('temp_assoc',$data);
		}
	}

	public function insert_assoc_detail($assoc_detail)
	{
		$k = 1;
		for ($i=0; $i < count($assoc_detail); $i++) { 
			for ($j=0; $j < count($assoc_detail[$i]['items']); $j++) { 
				
				$data = [
					'id_assoc' => $k,
					'id_menu' => $assoc_detail[$i]['items'][$j]
				];					

				$this->db->insert('temp_assoc_detail',$data);
			}
			$k++;
				
		}
	}

	public function detail_assoc($id){
		$data['page'] = 'Buat Paket';
		$data['assoc'] = $this->model->get_assoc()->result();
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['detail'] = $this->model->get_detail_assoc($id)->result();
		$data['content'] = 'pages/Buat_paket';
		$this->load->view('template/main', $data);
	}

	public function fajar($id) {
		$hitung_ = $this->model->ambilID_assc($id)->result();
        $total = 0;
        foreach ($hitung_ as $k) {
			$id_menu_ = $k->id_menu;
			$harga_ = $this->model->harga_items($id_menu_)->result();
			foreach ($harga_ as $key) {
				$total = $total + $key->harga;
			}
        }

        $data = [
        	'responseCode' => '00',
        	'data' => [
        		'total' => $total
        	]
        ];
        // var_dump($total);
        echo json_encode($data);
	}

	public function input()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|PNG';
		$config['max_size']             = 1000;
		$config['file_name']    		= base64_encode("" . mt_rand());
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('photo_menu')) {
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
        } else {
        	// $tanggal = date();
        	// $pakets = [
        	// 		'jenis' => 'paket',
        	// 		'tanggal_buat' => $tanggal
        	// ];
        	// $this->model->storeData('paket', $pakets);
        	$idpkt = $this->model->get_id_paket()->result(); // id buat input di tabel menu
        	foreach ($idpkt as $k) {
        		$id_pkt = $k->id_paket;
        	}
        	
        	$harga = $this->input->post('harga');
        	$discount = $this->input->post('disct_');
        	$hasil = ($harga * $discount)/100;
        	$selisih = $harga - $hasil;
        	$id = $this->input->post('id_assoc'); // id assoc buat hapus di temporary
        	
        	$data = [
	    		'nama_menu' => $this->input->post('nama_menu'),
				'id_group' => $this->input->post('kategori'),
				'id_paket' => $id_pkt,
				'harga' => $this->input->post('harga'),
				'disct_' => $this->input->post('disct_'),
				'gross_amount' => $selisih,
				'gambar' => '/uploads/'.$this->upload->data()['file_name']
			];

			$this->model->storeData('menu', $data);
			$this->model->deleteData('temp_assoc', ['id_assoc' => $id]); // hapus tempo
			$this->model->deleteData('temp_assoc_detail', ['id_assoc' => $id]); // hapus tempo

			redirect(base_url('index.php/apriori'));
        }

	}
}