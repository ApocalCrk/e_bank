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
			<a href="<?php echo site_url('kantinui/export_bulan_penjualan/'.$tanggal_ei) ?>" class="btn btn-info" id='ch'>Export</a>
			<a href="<?php echo site_url('kantinui/export_bulan_penjualan/'.$tanggal) ?>" class="btn btn-info" id='non-chrome'>Export</a>
		</div>
	</div>
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
		$bulan = $this->input->post('bulan');
		$bulan_ei = $this->input->post('bulan_ei');
		$tahun = $this->input->post('tahun');
		$kode = $this->session->userdata('kode_kantin');
		if($bulan != "" and $tahun != ""){
		$sql = $this->db->query("SELECT * FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)='$bulan' and YEAR(tgl_penjualan)='$tahun'");
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
	<?php }else{
		$data_bulan = explode('-',$bulan_ei);
		$sql = $this->db->query("SELECT * FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)='$data_bulan[1]' and YEAR(tgl_penjualan)='$data_bulan[0]'");
		foreach ($sql->result() as $row){?>
		<tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $row->kode_penjualan ?></td>
		<td><?php echo 'Rp. '.number_format($row->total_harga) ?></td>
		<td><?php echo $row->tgl_penjualan ?></td>
		<td><a href="<?php echo site_url('kantinui/read_data_pen/'.$row->id_penjualan) ?>" class="btn btn-info">Detail</a></td>
		</tr>
	<?php } ?>
	<?php } ?>
	</tbody>
</table>
</div>
</div>