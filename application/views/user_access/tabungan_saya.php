<table class="table">
	<?php 
		$nis = $this->session->userdata('nis');
		$sql = $this->db->query("SELECT * FROM tabungan where nis='$nis'");
		if ($sql->num_rows() == 0) {
			# kosong
			echo '<h4 class="text-center">Anda tidak memiliki tabungan.</h4>';
		}else{
		foreach ($sql->result() as $rw) {
	 ?>
	 <tr>
	 	<td>Saldo Sebelumnya</td>
	 	<td><?php echo 'Rp. '.number_format(abs($rw->saldo - $rw->saldo_tambahan)); ?></td>
	 </tr>
	 <tr>
	 	<td>Saldo Tambahan</td>
	 	<td><?php echo 'Rp. '.number_format($rw->saldo_tambahan); ?></td>
	 </tr>
	 <tr>
	 	<td><h5>Saldo Sekarang</h5></td>
	 	<td><h5><?php echo 'Rp. '.number_format($rw->saldo); ?></h5></td>
	 </tr>
	 <tr>
	 	<td>Update Terakhir</td>
	 	<td><?php echo $rw->waktu ?></td>
	 </tr>
	<?php } ?>
	<tr><td><a href="Siswaui/histori_tambahan">Histori Saldo Tambahan</a></td><td><a style="cursor: pointer;" onclick="alert_catatan()">*Catatan</a></td></tr>
</table>

<script type="text/javascript">
	function alert_catatan(){
	Swal.fire({
		type: 'info',
		showConfirmButton: false,
		timer: 5000,
		text: 'Row pada saldo sebelumnya berfungsi ketika adanya saldo tambahan yang masuk, jika row saldo sebelumnya error kemungkinan karena pembelian barang/produk.',
	});
}
</script>
<?php } ?>