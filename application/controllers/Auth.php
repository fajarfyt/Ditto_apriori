<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function login(){
		$user = $this->input->post('username');
		$pass = $this->input->post('password');

		// die($user.' + '.$pass);

		$login = $this->model->cek_user($user, $pass);

		if (!empty($login)) {
			$this->session->set_userdata($login);
			redirect(base_url('index.php/order'));
		} else {
			$this->session->set_flashdata('gagal', 'Username atau Password Salah');
			redirect(base_url('index.php/auth'));
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php/auth'));
	}
}
