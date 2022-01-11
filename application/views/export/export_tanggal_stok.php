<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=data_penjualan_stok_barang".date('Y-m-d').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

 $data_tanggal = explode('-', $tanggal);
 
?>

<h2>Data Penjualan Stok Bulan <?php echo $data_tanggal[0] ?></h2>
<table>
	<tr>
		<th>No</th>
		<th>Nama Barang</th>
		<th>Jumlah Terjual</th>
		<th>Harga Per Satuan</th>
		<th>Total Harga Terjual</th>
	</tr>
	<?php 
		$start = 0;
		$kode = $this->session->userdata('kode_kantin');
		$sql_kantin = $this->db->query("SELECT * FROM barang WHERE key_barang='$kode'");
		foreach ($sql_kantin->result() as $core) {
		$sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = '$core->kode_barang' and MONTH(penjualan_header.tgl_penjualan)='$data_tanggal[1]' and YEAR(penjualan_header.tgl_penjualan)='$data_tanggal[0]' and DAY(penjualan_header.tgl_penjualan)='$data_tanggal[2]'");
			?>
		<tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $core->nama_barang ?></td>
			<?php foreach ($sql->result() as $row) {
				$qty = 0 + $row->qty;?>
			<td><?php echo $qty ?></td>
			<td><?php echo number_format($core->harga_jual) ?></td>
			<td>
				<?php $total = $core->harga_jual * $row->qty; ?>
				<?php echo 'Rp. '.number_format($total); ?>
			</td>
			<?php } ?>
		</tr>
	<?php } ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>Total Seluruh Penjualan:</td>
			<td>
				<?php 
					$sql = $this->db->query("SELECT SUM(total_harga) as total_harga FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and MONTH(penjualan_header.tgl_penjualan)='$data_tanggal[1]' and YEAR(penjualan_header.tgl_penjualan)='$data_tanggal[0]' and DAY(penjualan_header.tgl_penjualan)='$data_tanggal[2]'");
					foreach ($sql->result() as $row) {
						$total_harga = 0 + $row->total_harga;
						echo 'Rp. '.number_format($total_harga);
					}
				?>
			</td>
		</tr>
</table>