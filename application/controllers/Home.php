<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// echo "<pre>";
		// var_dump($this->cart->contents());
		$data['page'] = 'Dashboard';
		$data['content'] = 'pages/Dashboard';
		$data['item'] = $this->cart->contents();
		$this->load->view('template/main', $data);
	}
}
