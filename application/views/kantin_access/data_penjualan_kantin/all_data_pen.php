<div class="col-md-4">
	<a href="Kantinui/export_all_penjualan" class="btn btn-info">Export</a>
</div>
<div class="table-responsive mt-3">
	<table class="table" id="dataTable">
		<thead align="center">
			<tr>
			<th>No</th>
			<th>Kode Penjualan</th>
			<th>Total Harga Penjualan</th>
			<th>Tanggal Penjualan</th>
			<th>Aksi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php 
			$start = 0;
			$kode = $this->session->userdata('kode_kantin');
			$sql = $this->db->query("SELECT * FROM penjualan_header where key_barang='$kode'");
			foreach ($sql->result() as $row) {
			?>
			<tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $row->kode_penjualan ?></td>
			<td><?php echo 'Rp. '.number_format($row->total_harga) ?></td>
			<td><?php echo $row->tgl_penjualan ?></td>
			<td><a href="<?php echo site_url('Kantinui/read_data_pen/'.$row->id_penjualan) ?>" class="btn btn-info">Detail</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>