<?php 
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
 ?>
<div class="col-md-4 container">
	<form action="" class="form-inline" method="GET">
	<input type="text" name="q" placeholder="Cari Pesan" class="ps" 
	style="
	padding: 10px;
	width: 100%;
	outline-color: none;
	outline: none;
	border: none;
	border-radius: 10px;
	border: 1px solid #eee;
	box-shadow: 1px 1px 1px 1px #eee">

	<a href="Siswaui/profile_saya">
		<?php 
			$id_siswa = $this->session->userdata("id_siswa");
			$nis = $this->session->userdata("nis");
			$sql = $this->db->query("SELECT * FROM user WHERE id_siswa='$id_siswa' and nis='$nis'")->row(); 
		?>
		<img class="rounded-circle ft-siswa position-absolute" style="right: 26px;top: 2.5px;width: 42px;height: 42px;" src="image/siswa/<?php echo $sql->foto; ?>"></a>
	</form>
	<?php 
		$query = urldecode($this->input->get('q'));
		if ($query) {
			$q = urlencode($query);
	 ?>

	 	<div class="ps_readmore">
		<?php include 'Siswaui.php';

           	$nis = $this->session->userdata('nis');
           	$sql = $this->db->query("SELECT * from pesan where to_nis='$nis' and subjek_pesan like '%$q%'");
           	foreach ($sql->result() as $rw) {
        ?>
		<a class="align-items-center box-mes" href="<?php echo site_url('Siswaui/pesan_read/'.$rw->id_pesan) ?>" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		top: 20px;
		margin-bottom: 10px;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 10px;"
		>
			<img class="rounded-circle img-profile" 
			style="width: 18%;margin-left: 10px;"
			src="image/user/default.png">
			<!-- <?php 
			$date = new datetime($rw->tanggal);
			echo '<p style="">'.$date->format('d F').'</p>' 
			?> -->
			<?php 
				if($rw->baca == 'belum'){
			 ?>
			 <b style="position: relative;top: 12px;left: 20px;width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			 <?php echo $rw->pengirim; ?><br>
			 <?php echo $rw->subjek_pesan; ?><br>
			 <?php echo '<p style="font-weight:normal;">'.$decrypt_str = decrypt($rw->isi_pesan, $password).'</p>'; ?>
			</b>
			<?php }else{ ?>
			<p style="position: relative;top: 12px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			<?php echo $rw->pengirim; ?><br>
			<?php echo $rw->subjek_pesan; ?><br>
			<?php echo $decrypt_str = decrypt($rw->isi_pesan, $password);; ?>
			</p>
			<?php } ?>
		</a>
	<?php } ?>
	</div>




<?php }else{ ?>



	<div class="ps_readmore">
		<?php include 'Siswaui.php';

           	$nis = $this->session->userdata(nis);
           	$sql = $this->db->query("SELECT * from pesan where to_nis='$nis' ORDER BY id_pesan DESC");
           	foreach ($sql->result() as $rw) {
        ?>
		<a class="align-items-center box-mes" href="<?php echo site_url('Siswaui/pesan_read/'.$rw->id_pesan) ?>" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		top: 20px;
		margin-bottom: 10px;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 10px;"
		>
			<img class="rounded-circle img-profile" 
			style="width: 18%;margin-left: 10px;"
			src="image/user/default.png">
			<!-- <?php 
			$date = new datetime($rw->tanggal);
			echo '<p style="">'.$date->format('d F').'</p>' 
			?> -->
			<?php 
				if($rw->baca == 'belum'){
			 ?>
			 <b style="position: relative;top: 12px;left: 20px;width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			 <?php echo $rw->pengirim; ?><br>
			 <?php echo $rw->subjek_pesan; ?><br>
			 <?php echo '<p style="font-weight:normal;">'.$decrypt_str = decrypt($rw->isi_pesan, $password).'</p>'; ?>
			</b>
			<?php }else{ ?>
			<p style="position: relative;top: 12px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			<?php echo $rw->pengirim; ?><br>
			<?php echo $rw->subjek_pesan; ?><br>
			<?php echo $decrypt_str = decrypt($rw->isi_pesan, $password);; ?>
			</p>
			<?php } ?>
		</a>
	<?php } ?>
	</div>
</div>
<?php } ?>