<?php 

 $id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
 $sql = $this->db->query("SELECT * FROM order_pesanan WHERE nama_kurir='$id' and status!='Transaksi Selesai' and status!='Kurir Menolak' LIMIT 1");
 if ($sql->num_rows() > 0) {?>
 	<span class="badge badge-danger badge-counter">
  		<?php echo $sql->num_rows();?>
	</span>
<?php }else{} ?>