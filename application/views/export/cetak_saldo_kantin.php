<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Saldo Kantin</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h2>Saldo Kantin</h2>
	</center>
	<?php 
	$rs = $data->row();
	 ?>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>KODE Kantin</th>
					<th>:</th>
					<td><?php echo $rs->kode_kantin; ?></td>

					<th>SALDO SEBELUMNYA</th>
					<th>:</th>
					<td><!-- <?php
					function sign($message, $key) {
						return hash_hmac('sha256', $message, $key) . $message;
					}
					function verify($bundle, $key) {
						return hash_equals(
							hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
							mb_substr($bundle, 0, 64, '8bit')
							);
					}
					function getKey($password, $keysize = 16) {
						 return hash_pbkdf2('sha256',$password,'some_token',100000,$keysize,true);
					}
					function decrypt($hash, $password) {
						$iv = hex2bin(substr($hash, 0, 32));
						$data = hex2bin(substr($hash, 32));
						$key = getKey($password);
						if (!verify($data, $key)) {
							 return null;
						}
						return openssl_decrypt(mb_substr($data, 64, null, '8bit'),'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv);
					} 
					$password = 'password';
					$sql = $this->db->query("SELECT * FROM penarikan_saldo, penjualan_header");
					foreach ($sql->result() as $sql) {
						$decrypt = decrypt($sql->kode_penarikan, $password);
						if ($decrypt == $rs->kode_kantin and $sql->key_barang ==  $rs->kode_kantin) {
							$saldo_sblm = $rs->total_saldo + $sql->jumlah_penarikan - $sql->total_harga;
							echo $saldo_sblm;
						}
					}
					 ?> -->Error</td>
				</tr>
				<tr>
					<th>NAMA Kantin</th>
					<th>:</th>
					<td><?php echo $rs->nama_kantin; ?></td>

					<th>LAST UPDATE</th>
					<th>:</th>
					<td><?php
					echo $rs->waktu;
					 ?></td>
				</tr>
				<tr>
					<th>SALDO SEKARANG</th>
					<th>:</th>
					<td><h3><?php
					echo 'Rp. '. number_format($rs->total_saldo);
					 ?></h3></td>
					 <th></th>
					 <th></th>
					 <td></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>