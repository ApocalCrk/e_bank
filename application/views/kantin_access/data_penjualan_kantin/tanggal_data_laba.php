<div class="body" style="padding-left: 10px;padding-right: 10px">
<form action="" method="POST">
	<div class="form-group">
		<label>Tanggal</label>
		<input type="date" name="tanggal" class="form-control">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
<!-- 	<a href="<?php echo site_url('Kantinui/export_tanggal_penjualan/'.$this->input->post('tanggal')) ?>" class="btn btn-info">Export</a>
 --></form>

<div class="table-responsive mt-3">
<table class="table" id="dataTable">
	<thead align="center">
		<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Kode Penjualan</th>
		<th>Nama Produk/Barang</th>
		<th>Satuan</th>
		<th>Harga Pokok</th>
		<th>Harga Jual</th>
		<th>Keuntungan Per Unit</th>
		<th>Jumlah Terjual</th>
		<th>Untung Bersih</th>
		</tr>
	</thead>
	<tbody align="center">
	<?php 
		$start = 0;
		$tanggal = $this->input->post('tanggal');
		$kode = $this->session->userdata('kode_kantin');
		$data_tgl = explode('-',$tanggal);
		$sql = $this->db->query("SELECT * FROM penjualan_header,barang,penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_detail.kode_penjualan=penjualan_header.kode_penjualan and barang.kode_barang=penjualan_detail.kode_barang and DAY(tgl_penjualan)='$data_tgl[2]' and MONTH(tgl_penjualan)='$data_tgl[1]' and YEAR(tgl_penjualan)='$data_tgl[0]'");
		foreach ($sql->result() as $row){
	 ?>
		<tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $row->tgl_penjualan ?></td>
		<td><?php echo $row->kode_penjualan ?></td>
		<td><?php echo $row->nama_barang ?></td>
		<td><?php echo $row->satuan ?></td>
		<td><?php echo 'Rp. '.number_format($row->harga_pokok) ?></td>
		<td><?php echo 'Rp. '.number_format($row->harga_jual) ?></td>
		<td><?php echo 'Rp. '.number_format($row->harga_jual - $row->harga_pokok) ?></td>
		<td><?php echo $row->qty ?></td>
		<td><?php echo 'Rp. '.number_format(($row->harga_jual*$row->qty) - ($row->harga_pokok*$row->qty)) ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</div>
</div>