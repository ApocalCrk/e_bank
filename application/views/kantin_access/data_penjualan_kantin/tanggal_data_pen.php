<div class="body" style="padding-left: 10px;padding-right: 10px">
<form action="" method="POST">
	<div class="form-group">
		<label>Tanggal</label>
		<input type="date" name="tanggal" class="form-control">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a href="<?php echo site_url('Kantinui/export_tanggal_penjualan/'.$this->input->post('tanggal')) ?>" class="btn btn-info">Export</a>
</form>

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
		$tanggal = $this->input->post('tanggal');
		$kode = $this->session->userdata('kode_kantin');
		$data_tgl = explode('-',$tanggal);
		$sql = $this->db->query("SELECT * FROM penjualan_header where key_barang='$kode' and DAY(tgl_penjualan)='$data_tgl[2]' and MONTH(tgl_penjualan)='$data_tgl[1]' and YEAR(tgl_penjualan)='$data_tgl[0]'");
		foreach ($sql->result() as $row){
	 ?>
		<tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $row->kode_penjualan ?></td>
		<td><?php echo 'Rp. '.number_format($row->total_harga) ?></td>
		<td><?php echo $row->tgl_penjualan ?></td>
		<td><a href="<?php echo site_url('kantinui/read_data_pen/'.$row->id_penjualan) ?>" class="btn btn-info">Detail</a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</div>
</div>