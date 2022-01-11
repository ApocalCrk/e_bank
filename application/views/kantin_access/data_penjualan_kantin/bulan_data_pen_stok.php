<style type="text/css">
	#bulan,#ch {
  		display: none;
	}
	#bulan:not(*:root),#ch { /* Supports only WebKit browsers */
 		display: block;
	}
	#bulan:not(*:root) ~ #bulan_moz,#tahun,#non-chrome { /* Supports only WebKit browsers */
 		display: none;
	}
</style>
<div class="body" style="padding-left: 10px;padding-right: 10px">
<form action="" method="POST">
	<div class="row col">
	<div class="form-group">
		<label>Bulan</label>
		<input type="month" name="bulan_ei" id="bulan" class="form-control">
		<select class="form-control" name="bulan" id="bulan_moz">
			<option value=""></option>
			<option value="1">Januari</option>
			<option value="2">Februari</option>
			<option value="3">Maret</option>
			<option value="4">April</option>
			<option value="5">Mei</option>
			<option value="6">Juni</option>
			<option value="7">Juli</option>
			<option value="8">Agustus</option>
			<option value="9">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
	</div>
	<div class="form-group ml-1" id="tahun">
		<label>Tahun</label>
		<select name="tahun" class="form-control">
			<option value=""></option>
			<?php for ($i=2000; $i <= 2100 ; $i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php } ?>
		</select>
	</div>
	</div>
	<div class="row col">
		<button type="submit" class="btn btn-primary">Submit</button>
		<?php $tanggal = $this->input->post('bulan').'-ex-'.$this->input->post('tahun'); ?>
		<?php 
			$bulan = $this->input->post('bulan_ei');
			$data_bulan = explode('-', $bulan);
			$tanggal_ei = $data_bulan[1].'-ex-'.$data_bulan[0]; 
		?>
		<div class="ml-1">
			<a href="<?php echo site_url('kantinui/export_bulan_stok/'.$tanggal_ei) ?>" class="btn btn-info" id='ch'>Export</a>
			<a href="<?php echo site_url('kantinui/export_bulan_stok/'.$tanggal) ?>" class="btn btn-info" id='non-chrome'>Export</a>
		</div>
	</div>
</form>

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
			$bulan = $this->input->post('bulan');
			$bulan_ei = $this->input->post('bulan_ei');
			$tahun = $this->input->post('tahun');
			if ($bulan != "" and $tahun != "") {
			$sql_kantin = $this->db->query("SELECT * FROM barang WHERE key_barang='$kode'");
			foreach ($sql_kantin->result() as $core) {
			$sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = '$core->kode_barang' and MONTH(tgl_penjualan)='$bulan' and YEAR(tgl_penjualan)='$tahun'");
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
			<?php }else{
				$sql_kantin = $this->db->query("SELECT * FROM barang WHERE key_barang='$kode'");
				$data_bulan = explode('-',$bulan_ei);
				foreach ($sql_kantin->result() as $core) {
			$sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = '$core->kode_barang' and MONTH(tgl_penjualan)='$data_bulan[1]' and YEAR(tgl_penjualan)='$data_bulan[0]'");
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
			<?php } ?>
		</tbody>
			<tr align="center">
				<td></td>
				<td></td>
				<td></td>
				<td>Total Seluruh Penjualan:</td>
				<td>
					<?php 
						if ($tahun != "") {
						$sql = $this->db->query("SELECT SUM(total_harga) as total_harga FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and MONTH(tgl_penjualan)='$bulan' and YEAR(tgl_penjualan)='$tahun'");
						foreach ($sql->result() as $row) {
							$total_harga = 0 + $row->total_harga;
							echo 'Rp. '.number_format($total_harga);
						}
						}else{
						$sql = $this->db->query("SELECT SUM(total_harga) as total_harga FROM penjualan_header join penjualan_detail where penjualan_header.key_barang='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and MONTH(tgl_penjualan)='$data_bulan[1]' and YEAR(tgl_penjualan)='$data_bulan[0]'");
						foreach ($sql->result() as $row) {
							$total_harga = 0 + $row->total_harga;
							echo 'Rp. '.number_format($total_harga);	
						}
						}
					?>
				</td>
			</tr>
	</table>
</div>

</div>