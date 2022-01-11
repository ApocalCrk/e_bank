<div class="col-md-4">
	<a href="Kantinui/export_all_stok" class="btn btn-info">Export</a>
</div>
<div class="table-responsive mt-3">
	<table class="table" id="dataTable">
		<thead align="center">
			<tr>
				<th>No</th>
				<th>Nama Produk/Barang</th>
				<th>Jumlah Terjual</th>
				<th>Harga Per Satuan</th>
				<th>Total Pejualan</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php 
			$start = 0;
			$kode = $this->session->userdata('kode_kantin');
			$sql_kantin = $this->db->query("SELECT * FROM barang WHERE key_barang='$kode'");
			foreach ($sql_kantin->result() as $core) {
			$sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = '$core->kode_barang'");
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
		</tbody>
			<tr align="center">
				<td></td>
				<td></td>
				<td></td>
				<td>Total Seluruh Penjualan:</td>
				<td>
					<?php 
						$sql = $this->db->query("SELECT SUM(total_harga) as total_harga FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan");
						foreach ($sql->result() as $row) {
							$total_harga = 0 + $row->total_harga;
							echo 'Rp. '.number_format($total_harga);
						}
					?>
				</td>
			</tr>
	</table>
</div>