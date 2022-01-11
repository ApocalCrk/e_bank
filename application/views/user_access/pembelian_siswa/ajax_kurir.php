<?php 
	$nis = $this->session->userdata('nis');
	$cek_order = $this->db->query("SELECT * FROM user WHERE nis='$nis'")->row();
	$sql = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$cek_order->last_order'")->row();
	 if ($sql->status == 'Menunggu Konfirmasi Kurir') {?>
	 	<img src="image/Maintenance/ajax-loader.gif">
	<?php } elseif ($sql->status == 'Transaksi Selesai') {
		$this->session->unset_userdata('no_invoice');
		$this->cart->destroy();
		$sl = explode('-', $sql->nama_kurir);
		$user_id = $this->session->userdata('id_siswa');
		$this->db->query("UPDATE active_kurir SET order_pesanan='no' WHERE id_kurir='$sl[1]'");
		$this->db->query("DELETE FROM chat_message WHERE pengirim='$user_id' and penerima='$sl[1]'");
		$this->db->query("DELETE FROM chat_message WHERE penerima='$user_id' and pengirim='$sl[1]'");
		?>
		<script type="text/javascript">
			window.location="<?php echo base_url() ?>siswaui/keranjang_order";
		</script>
	<?php }elseif($sql->status == 'Kurir Menolak'){
		$this->db->query("DELETE FROM order_pesanan WHERE invoice_order='$no_invoice'");
		$this->session->unset_userdata('no_invoice');
		$this->session->set_flashdata('message_tolak',
			'<script>
				Swal.fire({
					type: "info",
					text: "Orderan Ditolak",
					showConfirmButton: false,
					timer: 1500,
					});
			</script>'
		)
		?>
		<script type="text/javascript">
			window.location="<?php echo base_url() ?>siswaui/keranjang_order";
		</script>
	<?php }else{
			$no_invoice = $this->session->userdata('invoice_order');
			$orderan = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$no_invoice'")->row();
			$sl = explode('-', $sql->nama_kurir);
			$this->db->query("UPDATE active_kurir SET order_pesanan='yes' WHERE id_kurir='$sl[1]'");
			$kurir = $this->db->query("SELECT * FROM kurir WHERE id_kurir='$sl[1]' and nama_kurir='$sl[0]'")->row();
		?> 
		<div class="text-center">
			<img src="image/kurir/default.png" class="rounded-circle">
			<h4 class="mt-1"><?php echo $kurir->nama_kurir ?></h4>
			<img src="image/Maintenance/kurir.gif" style="width: 20%">
			<h6>Status Pemesanan<br><?php echo $sql->status ?></h6>
		</div>
		<div class="row">
			<?php $user_id = $this->session->userdata('id_siswa') ?>
			<a href="<?php echo site_url('Siswaui/chat_kurir/'.$this->session->userdata('id_siswa').'-'.$kurir->id_kurir) ?>" class="btn btn-success position-absolute" style="bottom: 10px;left: 10px;z-index: 1">Chat</a>
			<a href="" class="btn btn-warning position-absolute" style="right: 10px;bottom: 10px">Lihat Pesanan</a>
		</div>
	<?php }?>