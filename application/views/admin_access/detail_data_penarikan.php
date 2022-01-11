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
	$decrypt = decrypt($kode_penarikan, $password);
?>

<table class="table">
	<tr><td>Kode Penarikan:</td><td><p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 300px"><?php echo $kode_penarikan ?></p></td></tr>
	<tr><td>Nis/Kode Kantin Penarik:</td><td><?php echo $decrypt ?></td></tr>
	<tr><td>Nama Penarik:</td>
		<td>
			<?php 
				$sql = $this->db->query("SELECT * FROM user,kantin")->row();
				if ($sql->nis == $decrypt) {
					echo $sql->nama_siswa;
				}elseif ($sql->kode_kantin == $decrypt) {
					echo $sql->nama_kantin;
				}else{}
			?>	
		</td>
	</tr>
	<tr><td>Jumlah Penarikan:</td><td><?php echo 'Rp. '.number_format($jumlah_penarikan) ?></td></tr>
	<tr><td>Waktu:</td><td><?php echo $waktu ?></td></tr>
	<tr><td></td><td><a href="app/data_penarikan_saldo" class="btn btn-default">Cancel</a></td></tr>
</table>