<div class="table-responsive">
	<?php echo $this->session->flashdata('message_berhasil'); ?>
<table class="table col-md-4" id="dataTable">
	<thead>
		<tr align="center" style="font-size: 13px">
			<td>Kode Pembelian</td>
			<td>Total Harga</td>
			<td>Tanggal Pembelian</td>
			<td>Aksi</td>
		</tr>
	</thead>
	<tbody>
	<?php 
		$nis = $this->session->userdata('nis');
		$sql = $this->db->query("SELECT * FROM penjualan_header Where nis='$nis'");
		foreach ($sql->result() as $rw) {
	 ?>

	 <tr align="center" style="font-size: 13px">
	 	<td><?php echo $rw->kode_penjualan ?></td>
	 	<td>Rp.<?php echo number_format($rw->total_harga) ?></td>
	 	<td><?php echo $rw->tgl_penjualan ?></td>
	 	<td><a href="<?php echo site_url('Siswaui/read_data_pen_siswa/'.$rw->id_penjualan) ?>" class="btn btn-info">Detail</a></td>
	 </tr>

	<?php } ?>
</tbody>
</table>
</div>