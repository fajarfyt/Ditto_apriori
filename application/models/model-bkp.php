<?php

class Model extends CI_Model {

	public function cek_user($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
	    $query = $this->db->get('users');
	    return $query->row_array();
	}

	public function getAll($table) {
		return $this->db->get($table);
	}

	public function getMenu() {
		$this->db->order_by('nama_menu', 'asc');
		$query = $this->db->get('menu');
		return $query;
	}

	public function storeData($table, $data){
		$this->db->insert($table, $data);
	}

	public function getData($table, $where){
		return $this->db->get_where($table, $where);
	}

	public function updateData($table, $where, $data){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function deleteData($table, $where){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getIDdate($table,$tgl) {
		$this->db->select('id_trans');
		$this->db->from($table);
		$this->db->like('tgl_trans', $tgl);
		return $this->db->get();
	}

	public function jmlItem($tgl){
		$this->db->select('count(D.id_menu) as id, D.id_menu');
		$this->db->from('detail_trans D');
		$this->db->join('transaksi T', 'D.id_trans = T.id_trans');
		$this->db->like('T.tgl_trans', $tgl);
		$this->db->group_by('D.id_menu');
		return $this->db->get();
	}

	public function get_assoc()
	{
		$this->db->select('*');
		$this->db->from('temp_assoc');
		return $this->db->get();
	}
	
	public function get_temp(){
		$this->db->select('*');
		$this->db->from('temp_assoc');
		$this->db->order_by('id_assoc', 'desc');
		return $this->db->get();
	}

	public function last_detail_id(){
		$this->db->select('id_trans');
		$this->db->from('transaksi');
		$this->db->order_by('id_trans', 'desc');
		$this->db->limit(1);
		return $this->db->get();
	}

	// select detail trans berdasarkan id transs
	public function get_menu($id) {
		$this->db->select('D.id_trans,M.nama_menu,M.kode,D.qty');
		$this->db->from('detail_trans D');
		$this->db->join('menu M', 'D.id_menu = M.id_menu');
		$this->db->where('D.id_trans', $id);
		return $this->db->get();
	}
	public function get_input() {
		$this->db->select('D.id_trans, M.nama_menu, M.kode, D.qty');
		$this->db->from('detail_trans D');
		$this->db->join('menu M', 'D.id_menu = M.id_menu');
		$this->db->group_by('M.id_menu');
		return $this->db->get();
	}
	public function get_detail_assoc($id) {
		$this->db->select('a.nama_menu');
		$this->db->from('menu a');
		$this->db->join('temp_assoc_detail b', 'b.id_menu = a.id_menu', 'left');
		$this->db->where('b.id_assoc', $id);
		return $this->db->get();
	}
	public function harga_items($kode) {
		$this->db->select('harga');
		$this->db->from('menu');
		$this->db->where('kode', $kode);
		return $this->db->get();
	}
	public function ambilID_assc($id) {
		$this->db->select('kode');
		$this->db->from('temp_assoc_detail');
		$this->db->where('id_assoc', $id);
		return $this->db->get();
	}
}