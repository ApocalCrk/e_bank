<?php
	$nis_kurir = $this->session->userdata('nis_kurir');
	$sql = $this->db->query("SELECT * FROM tabungan_kurir WHERE nis_kurir='$nis_kurir'")->row();
	echo number_format($sql->total_saldo);
 ?>