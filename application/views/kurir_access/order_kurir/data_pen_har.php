<?php                           
    $id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
    $sql=$this->db->query("SELECT SUM(total_harga) as total_harga,SUM(ongkir) as ongkir From order_pesanan where nama_kurir='$id' and DAY(waktu)=DAY(CURDATE()) and MONTH(waktu)=MONTH(CURDATE()) and YEAR(waktu)=YEAR(CURDATE()) and status='Transaksi Selesai'");
    foreach ($sql->result() as $row) {
    	$total_harga = 0 + $row->total_harga+$row->ongkir;
    	echo number_format($total_harga);
    }
?>