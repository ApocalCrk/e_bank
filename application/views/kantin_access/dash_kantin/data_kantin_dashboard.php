						<?php 
                          
                          $pen_jul = 0;
                          $key = $this->session->userdata('kode_kantin');
                          $sql=$this->db->query("SELECT * From penjualan_header where key_barang='$key' and DAY(tgl_penjualan)=DAY(CURDATE()) and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
                          foreach ($sql->result() as $rw) {
                            $pen_jul = $pen_jul+$rw->total_harga;
                          }
                          echo number_format($pen_jul);


                         ?>