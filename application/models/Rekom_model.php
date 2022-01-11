<?php 
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekom_model extends CI_Model
{

    public $table = 'rekomendasi';
    public $id = 'id_produk';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_produk', $q);
	$this->db->or_like('kode_produk', $q);
    $this->db->or_like('foto', $q);
    $this->db->or_like('kode_rekom', $q);
	$this->db->or_like('tgl_awal_rekom', $q);
	$this->db->or_like('tgl_akhir_rekom', $q);
	$this->db->or_like('active', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_produk', $q);
	$this->db->or_like('kode_produk', $q);
    $this->db->or_like('foto', $q);
	$this->db->or_like('kode_rekom', $q);
    $this->db->or_like('tgl_awal_rekom', $q);
	$this->db->or_like('tgl_akhir_rekom', $q);
	$this->db->or_like('active', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function deleteImage($id) {
        $row = $this->get_by_id($id);
        if ($row->foto != "default.png" or $row->foto != "default.jpg") {
            $filename = explode(".", $row->foto)[0];
            return array_map('unlink', glob(FCPATH."image/All/$filename.*"));
        }
    }

    function deleteImageUp($id) {
        $row = $this->get_by_id($id);
        if ($_FILES['foto']['name'] == '') {
        }elseif ($row->foto != "default.png" or $row->foto != "default.jpg") {
            $filename = explode(".", $row->foto)[0];
            return array_map('unlink', glob(FCPATH."image/All/$filename.*"));
        }
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->deleteImageUp($id);
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->deleteImage($id);
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

 ?>