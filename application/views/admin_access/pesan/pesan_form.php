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
<form action="<?php echo $action; ?>" method="post">
	
	<div class="form-group">
		<label for="varchar">Kode Pesan <?php echo form_error('id_pesan') ?></label>
		<input type="text" name="kode_pesan" class="form-control" value="<?php echo $kode_pesan ?>" readonly>
	</div>

	<div class="form-group">
		<label for="varchar">Pengirim <?php echo form_error('pengirim') ?></label>
		<input type="text" name="pengirim" class="form-control" value="<?php echo $this->session->userdata('nama') ?>" readonly>
	</div>

	<div class="form-group">
		<label for="varchar">Ke <?php echo form_error('to_nis') ?></label>
		<!-- <input type="text" name="to_nis" class="form-control" value="<?php echo $to_nis ?>" readonly> -->
		<select name='to_nis' class="selectpicker" class="form-control" data-live-search="true" autofocus>
			<option value="<?php echo $to_nis; ?>"><?php echo $to_nis; ?></option>
			<?php 
				$this->db->order_by('nis','desc');
				$sql = $this->db->get('user');
				foreach ($sql->result() as $row) {
			?>
			<option value="<?php echo $nis; ?>"><?php echo $nis; ?></option>
			<option value="<?php echo $row->nis; ?>"><?php echo $row->nis.' - '.$row->nama_siswa; ?></option>
		<?php } ?>
		<?php 
				$this->db->order_by('nis_kurir','desc');
				$sql = $this->db->get('kurir');
				foreach ($sql->result() as $row) {
			?>
			<option value="<?php echo $nis_kurir; ?>"><?php echo $nis_kurir; ?></option>
			<option value="<?php echo $row->nis_kurir; ?>"><?php echo $row->nis_kurir.' - '.$row->nama_kurir.' - '.'Kurir'; ?></option>
		<?php } ?>
		<?php 
				$this->db->order_by('kode_kantin','desc');
				$sql = $this->db->get('kantin');
				foreach ($sql->result() as $row) {
			?>
			<option value="<?php echo $kode_kantin; ?>"><?php echo $kode_kantin; ?></option>
			<option value="<?php echo $row->kode_kantin; ?>"><?php echo $row->kode_kantin.' - '.$row->nama_kantin; ?></option>
		<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="varchar">Tanggal <?php echo form_error('tanggal') ?></label>
		<input type="text" name="tanggal" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y/m/d H:i:s'); ?>" readonly>
	</div>

	<div class="form-group">
		<label for="varchar">Subjek Pesan <?php echo form_error('subjek_pesan') ?></label>
		<input type="text" name="subjek_pesan" class="form-control" value="<?php echo $subjek_pesan ?>" minlength="5">
	</div>

	<div class="form-group">
		<label for="varchar">Isi Pesan <?php echo form_error('isi_pesan') ?></label>
		<textarea type="text" name="isi_pesan" class="form-control"><?php echo $decrypt_str = decrypt($isi_pesan, $password); ?></textarea>
	</div>

	<input type="hidden" name="id_pesan" value="<?php echo $id_pesan; ?>" /> 
	<button type="submit" class="btn btn-primary"><?php echo $button; ?></button>
	<a href="<?php echo site_url('pesan') ?>" class="btn btn-default">Cancel</a>

</form>