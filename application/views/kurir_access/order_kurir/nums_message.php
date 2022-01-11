<?php 
	$id = $this->session->userdata('id_kurir');
	$sql = $this->db->query("SELECT * FROM chat_message WHERE penerima='$id' and read_status='Belum'");
	if ($sql->num_rows() > 0) {
		echo $sql->num_rows();
	}else{}
 ?>