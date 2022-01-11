<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class No_urut extends CI_Model
{

    function buat_kode_barang()   {    
      $this->db->select('RIGHT(barang.id_barang,4) as kode', FALSE);
      $this->db->order_by('id_barang','DESC');    
      $this->db->limit(1);     
      $query = $this->db->get('barang');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){       
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;     
      }
      else{       
       //jika kode belum ada      
       $kode = 1;     
      }
      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);    
      $kodejadi = "BRG".$kodemax;     
      return $kodejadi;  
     }

     function buat_kode_penjualan()   {    
      $this->db->select('RIGHT(penjualan_header.id_penjualan,5) as kode', FALSE);
      $this->db->order_by('id_penjualan','DESC');    
      $this->db->limit(1);     
      $query = $this->db->get('penjualan_header');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){       
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;     
      }
      else{       
       //jika kode belum ada      
       $kode = 1;     
      }
      $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);    
      $kodejadi = "PJ".$kodemax;     
      return $kodejadi;  
     }

     function kode_pesan()   {    
      $this->db->select('RIGHT(pesan.id_pesan,5) as kode', FALSE);
      $this->db->order_by('id_pesan','DESC');    
      $this->db->limit(1);     
      $query = $this->db->get('pesan');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){       
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;     
      }
      else{       
       //jika kode belum ada      
       $kode = 1;     
      }
      $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);    
      $kodepesan = "PS".$kodemax.'id';     
      return $kodepesan;  
     }

     function kode_kantin()   {    
      $this->db->select('RIGHT(kantin.id_kantin,5) as kode', FALSE);
      $this->db->order_by('id_kantin','DESC');    
      $this->db->limit(1);     
      $query = $this->db->get('kantin');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){       
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;     
      }
      else{       
       //jika kode belum ada      
       $kode = 1;     
      }
      $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);    
      $kodekantin = "kantin_".$kodemax;     
      return $kodekantin;  
     }

     function get_invoice()
     {
          return "INV".time().rand(1,9999);
      }

}
