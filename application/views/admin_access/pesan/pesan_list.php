<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4">
		<?php echo anchor(site_url('pesan/create'),'Kirim Pesan', 'class="btn btn-primary"') ?>
	</div>
	<div class="col-md-4 text-center">
		<div style="margin-top: 8px" id="message">
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
		</div>
	</div>
	<div class="col-md-1 text-right">
	</div>
	<div class="col-md-3 text-right">
		<form action="<?php echo site_url('pesan/index'); ?>" class="form-inline" method="get">
			<div class="input-group">
				<input type="text" name="q" class="form-control" value="<?php echo $q ?>">
				<span class="input-group-btn">
					<?php 
						if ($q <> '') {
					 ?>
					 <a href="<?php echo site_url('pesan'); ?>" class="btn btn-default">Reset</a>
					<?php } ?>
					<button class="btn btn-primary" type="submit">
						Search
					</button>
				</span>
			</div>
		</form>
	</div>	
</div>

<div class="table-responsive">
	<table class="table table-bordered" id="example1" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
        <th>Kode Pesan</th>
        <th>Pengirim</th>
        <th>Kepada</th>
        <th>Tanggal</th>
        <th>Subjek Pesan</th>
        <th>Isi Pesan</th>
        <th>Read</th>
        <th>Action</th>
            </tr></thead>
            <tbody><?php
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
              
            foreach ($pesan_data as $pesan)
            {
                ?>
                <tr>
            <td width="25px"><?php echo ++$start ?></td>
            <td><?php echo $pesan->kode_pesan ?></td>
            <td><?php echo $pesan->pengirim ?></td>
            <td><?php echo $pesan->to_nis ?></td>
            <td><?php echo $pesan->tanggal ?></td>
            <td><?php echo $pesan->subjek_pesan ?></td>
            <td><p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 200px;color: inherit;"><?php echo $decrypt_str = decrypt($pesan->isi_pesan, $password); ?></p></td>
            <td><?php echo $pesan->baca ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('pesan/read/'.$pesan->id_pesan),'Detail'); 
                echo ' | '; 
                echo anchor(site_url('pesan/update/'.$pesan->id_pesan),'Update'); 
                echo ' | '; 
                echo anchor(site_url('pesan/delete/'.$pesan->id_pesan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </tbody>
        </table>
</div>
<div class="row">
        <div class="col-md-6">
            <div class="btn btn-primary">Total Record : <?php echo $total_rows ?></div>
    	</div>
    <div class="col-md-6 text-right">
    	<?php echo $pagination ?>
   	</div>
</div>