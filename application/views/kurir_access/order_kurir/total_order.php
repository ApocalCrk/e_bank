<?php 
    $id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
    $sql = $this->db->query("SELECT * FROM order_pesanan WHERE nama_kurir='$id' and DAY(waktu)=DAY(CURDATE()) and status='Transaksi Selesai'");
    echo $sql->num_rows();
?>