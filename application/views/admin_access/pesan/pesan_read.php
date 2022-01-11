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
<table class="table">
	<tr><td>Kode Pesan</td><td><?php echo $kode_pesan; ?></td></tr>
	<tr><td>Pengirim</td><td><?php echo $pengirim; ?></td></tr>
	<tr><td>Ke NIS</td><td><?php echo $to_nis; ?></td></tr>
	<tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	<tr><td>Subjek Pesan</td><td><?php echo $subjek_pesan; ?></td></tr>
	<tr><td>Isi Pesan</td><td><?php echo $decrypt_str = decrypt($isi_pesan, $password); ?></td></tr>
	<tr><td>Read</td><td><?php echo $baca; ?></td></tr>
</table>