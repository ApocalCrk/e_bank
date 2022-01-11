<?php 
                          $total_pen = 0;
                          $key = $this->session->userdata('kode_kantin');
                          $sql=$this->db->query("SELECT * From penjualan_header where key_barang='$key' and DAY(tgl_penjualan)=DAY(CURDATE()) and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
                          $total_pen = $total_pen+$sql->num_rows();
                            echo number_format($total_pen);
                         ?>