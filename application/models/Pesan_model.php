<?php 
if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

class Pesan_model extends CI_Model
{
	public $table = 'pesan';
	public $id = 'id_pesan';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}

	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	function total_rows($q = NULL){
		$this->db->like('id_pesan', $q);
		$this->db->like('kode_pesan', $q);
		$this->db->like('pengirim', $q);
		$this->db->like('to_nis', $q);
		$this->db->like('tanggal', $q);
		$this->db->like('subjek_pesan', $q);
		$this->db->like('isi_pesan', $q);
		$this->db->like('baca', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function get_limit_data($limit, $start = 0, $q = NULL){
		$this->db->order_by($this->id, $this->order);
		$this->db->or_like('id_pesan', $q);
		$this->db->or_like('kode_pesan', $q);
		$this->db->or_like('pengirim', $q);
		$this->db->or_like('to_nis', $q);
		$this->db->or_like('tanggal', $q);
		$this->db->or_like('subjek_pesan', $q);
		$this->db->or_like('isi_pesan', $q);
		$this->db->or_like('baca', $q);
		return $this->db->get($this->table)->result();
	}

	function insert($data){
		$this->db->insert($this->table, $data);
	}

	function update($id, $data){
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	function delete($id){
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}
}


 ?>