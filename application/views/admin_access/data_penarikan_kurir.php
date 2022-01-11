<div class="table-responsive">
	<table class="table" id="dataTable">
		<thead align="center">
			<tr>
				<th>No</th>
				<th>Kode Penarikan</th>
				<th>Jumlah Penarikan</th>
				<th>Tanggal Penarikan</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php 
				$start = 0;
				$nis_kurir = $this->session->userdata('nis_kurir');
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
				function encrypt($message, $password) {
				    $iv = random_bytes(16);
				    $key = getKey($password);
				    $result = sign(openssl_encrypt($message,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv), $key);
				    return bin2hex($iv).bin2hex($result);
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
	            $sql = $this->db->query("SELECT * FROM penarikan_saldo");
	            foreach ($sql->result() as $row) {?>
	      		<?php if (decrypt($row->kode_penarikan, $password) == $nis_kurir): ?>
	      			<tr>
	      				<td><?php echo ++$start ?></td>
	      				<td><p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 150px"><?php echo $row->kode_penarikan ?></p></td>
	      				<td><?php echo 'Rp. '.number_format($row->jumlah_penarikan); ?></td>
	      				<td><?php echo $row->waktu; ?></td>
	      			</tr>
	      		<?php endif ?>
			<?php } ?>
		</tbody>
	</table>
</div>