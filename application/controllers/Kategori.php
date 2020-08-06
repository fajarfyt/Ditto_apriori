<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Kategori'; 
		$data['item'] = $this->model->getAll('menu_grup')->result();
		$data['content'] = 'pages/Kategori';
		$this->load->view('template/main', $data);
	}

	public function store(){
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['file_name']    		= base64_encode("" . mt_rand());
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('photo_kat')) {
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
        } else {
        	$data = [
				'gambar_group' => '/uploads/'.$this->upload->data()['file_name'],
				'nama_menu_group' => $this->input->post('nama_menu_group')
			];

			$this->model->storeData('menu_grup', $data);

			redirect(base_url('index.php/kategori'));
        }
	}

	public function edit($id){
		$data['page'] = 'Kategori'; 
		$data['item'] = $this->model->getData('menu_grup', ['id_group' => $id])->row();
		$data['content'] = 'pages/editKategori';
		$this->load->view('template/main', $data);
	}

	public function update(){
		$id = $this->input->post('id_group');

        $menu = $this->model->getData('menu_grup', ['id_group' => $id])->row();
		if (empty($menu)) {
			show_404();
		}

		$data = [
			'nama_menu_group' => $this->input->post('nama_menu_group')
		];

		if (!empty($_FILES['photo_kat']['name'])) {
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['file_name']    		= base64_encode("" . mt_rand());
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('photo_kat'))
			{
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$data = [
					'gambar_group' => '/uploads/'.$this->upload->data()['file_name'],
				];
				@unlink('.'.$menu->foto);
			}
		}

		$this->model->updateData('menu_grup', ['id_group'=>$id], $data);
		redirect(base_url('index.php/kategori'));
	}

	public function delete($id){
		$this->model->deleteData('menu_grup', ['id_group' => $id]);
		redirect(base_url('index.php/kategori'));
	}
}
