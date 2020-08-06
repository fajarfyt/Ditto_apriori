<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	// public function index()
	// {
	// 	$data['page'] = 'Order Here'; 
	// 	$data['item'] = $this->model->getMenu()->result();
	// 	$data['content'] = 'pages/Order';
	// 	$this->load->view('template/main', $data);
	// }
	public function index()
	{
		$data['page'] = 'Order Here'; 
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['item'] = $this->model->getMenu()->result();
		$data['content'] = 'pages/Order';
		$this->load->view('template/main', $data);
	}
	public function select($get)
	{
		if ($get == null) {
			$data['page'] = 'Order Here'; 
			$data['kategori'] = $this->model->getAll('menu_grup')->result();
			$data['item'] = $this->model->getMenu()->result();
			$data['content'] = 'pages/Order';
			$this->load->view('template/main', $data);
		} else {
			$data['page'] = 'Order Here'; 
			$data['kategori'] = $this->model->getAll('menu_grup')->result();
			$data['item'] = $this->model->getData('menu', ['id_group' => $get])->result();
			$data['content'] = 'pages/Order';
			$this->load->view('template/main', $data);
		}
	}

	function add_to_cart(){ 
	    $data = array(
	        'id' => $this->input->post('product_id'), 
	        'name' => $this->input->post('product_name'), 
	        'price' => $this->input->post('product_price'), 
	        'qty' => $this->input->post('quantity'), 
	    );
	    $this->cart->insert($data);
	    echo $this->show_cart(); 
	}

	function show_cart(){ 
	    $output = '';
	    $no = 0;
	    foreach ($this->cart->contents() as $items) {
	        $no++;
	        $output .='
	            <tr>
	                <td>'.$items['name'].'</td>
	                <td>'.number_format($items['price']).'</td>
	                <td>'.$items['qty'].'</td>
	                <td>'.number_format($items['subtotal']).'</td>
	                <td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
	            </tr>
	        ';
	    }
	    $output .= '
	        <tr>
	            <th colspan="3">Total</th>
	            <th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
	        </tr>
	    ';
	    return $output;
	}

	function load_cart(){ 
	    echo $this->show_cart();
	}

	function delete_cart(){ 
	    $data = array(
	        'rowid' => $this->input->post('row_id'), 
	        'qty' => 0, 
	    );
	    $this->cart->update($data);
	    echo $this->show_cart();
	}

	public function checkout() {
		$last_id = $this->model->last_detail_id()->row();
		// var_dump($last_id);die();
		if ($cart = $this->cart->contents()) {
			$tran = [
				'ammount' => $this->cart->total(),
				'tgl_trans' => date("Y-m-d")
			];
			$this->model->storeData('transaksi', $tran);
			foreach ($cart as $key) {
				$data = [
					'id_trans' => (int)$last_id->id_trans+1,
					'id_menu' => $key['id'],
					'qty' => $key['qty'],
					'total' => $key['subtotal']
				];
				// echo "<pre>";
				// var_dump($data);
				$this->model->storeData('detail_trans', $data);
			}
			$this->cart->destroy();
			redirect(base_url('index.php/order'));
		} else {
			redirect(base_url('index.php/order'));
		}
	}
}
