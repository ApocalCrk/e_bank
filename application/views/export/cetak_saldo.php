<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Saldo Siswa</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h2>Saldo Siswa</h2>
	</center>
	<?php 
	$rs = $data->row();
	 ?>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>NIS Siswa</th>
					<th>:</th>
					<td><?php echo $rs->nis; ?></td>

					<th>SALDO SEBELUMNYA</th>
					<th>:</th>
					<td><?php
					$sblm = $rs->saldo - $rs->saldo_tambahan;
					echo 'Rp. '. number_format($sblm);
					 ?></td>
				</tr>
				<tr>
					<th>NAMA Siswa</th>
					<th>:</th>
					<td><?php echo $rs->nama_siswa; ?></td>

					<th>SALDO TAMBAHAN</th>
					<th>:</th>
					<td><?php
					echo 'Rp. '. number_format($rs->saldo_tambahan);
					 ?></td>
				</tr>
				<tr>
					<th>SALDO SEKARANG</th>
					<th>:</th>
					<td><h3><?php
					echo 'Rp. '. number_format($rs->saldo);
					 ?></h3></td>

					<th>LAST UPDATE</th>
					<th>:</th>
					<td><?php
					echo $rs->waktu;
					 ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>