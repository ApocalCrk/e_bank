<?php                           
                          $barang = 0;
                          $kode = $this->session->userdata('kode_kantin');
                          $sql=$this->db->query("SELECT * FROM barang where key_barang='$kode'");
                            $barang = $barang+$sql->num_rows();
                          echo number_format($barang);
                         ?>