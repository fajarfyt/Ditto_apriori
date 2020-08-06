<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Menu'; 
		$data['item'] = $this->model->menuJoin()->result();
		$data['grup'] = $this->model->getAll('menu_grup')->result();
		$data['content'] = 'pages/Menu';
		$this->load->view('template/main', $data);
	}

	public function store(){
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['file_name']    		= base64_encode("" . mt_rand());
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('photo_menu')) {
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
        } else {
        	$data = [
        		'nama_menu' => $this->input->post('nama_menu'),
				'id_group' => $this->input->post('id_group'),
				'id_paket' => '1',
				'harga' => $this->input->post('harga'),
				'gross_amount' => $this->input->post('harga'),
				'gambar' => '/uploads/'.$this->upload->data()['file_name']
			];

			$this->model->storeData('menu', $data);

			redirect(base_url('index.php/menu'));
        }
	}

	public function edit($id){
		$data['page'] = 'Menu'; 
		$data['item'] = $this->model->menuJoinbyId($id)->row();
		$data['grup'] = $this->model->getAll('menu_grup')->result();
		$data['content'] = 'pages/editMenu';
		$this->load->view('template/main', $data);
	}

	public function update(){
		$id = $this->input->post('id_menu');

		$menu = $this->model->getData('menu', ['id_menu' => $id])->row();
		if (empty($menu)) {
			show_404();
		}

		$data = [
			'nama_menu' => $this->input->post('nama_menu'),
			'id_group' => $this->input->post('id_group'),
			'harga' => $this->input->post('harga'),
			'gross_amount' => $this->input->post('harga')
		];

		if (!empty($_FILES['photo_menu']['name'])) {
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['file_name']    		= base64_encode("" . mt_rand());
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('photo_menu'))
			{
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$data = [
					'gambar' => '/uploads/'.$this->upload->data()['file_name'],
				];
				@unlink('.'.$menu->foto);
			}
		}

		$this->model->updateData('menu', ['id_menu'=>$id], $data);
		redirect(base_url('index.php/menu'));
	}

	public function delete($id){
		
		
		$idpkt = $this->model->get_id_paket_menu($id)->result(); // id buat input di tabel menu
    	foreach ($idpkt as $k) {
    		$id_pkt = $k->id_paket;
        }

        if ($id_pkt != 1) {
        	$this->model->deleteData('menu', ['id_menu' => $id]);
	        $this->model->deleteData('detail_paket', ['id_paket' => $id_pkt]);
	        $this->model->deleteData('paket', ['id_paket' => $id_pkt]);
        } else{
        	$this->model->deleteData('menu', ['id_menu' => $id]);
        }
        
		redirect(base_url('index.php/menu'));
	}

	public function autoIns(){
		// $ktg = 1;
		$data = $this->model->getAll('menu')->result();
		foreach ($data as $key) {
			$id = $key->id_menu;
			$dataSend = [
				'nama_menu' => $key->nama_menu,
				'id_group' => $key->id_group,
				'id_paket' => $key->id_paket,
				'harga' => $key->harga,
				// 'kategori' => "KTG".$ktg,
				'disct_' => $key->disct_,
				'gross_amount' => $key->gross_amount,
				'gambar' => $key->gambar,
			];
			$this->model->updateData('menu', ['id_menu'=>$id], $dataSend);
			// $ktg++;
		}
	}
}
