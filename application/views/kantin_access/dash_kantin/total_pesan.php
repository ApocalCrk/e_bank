<?php 
                          $kode = $this->session->userdata('kode_kantin');
                          $sql = $this->db->query("SELECT * FROM pesan where to_nis='$kode' and baca='belum'");
                          echo $sql->num_rows();
                         ?>