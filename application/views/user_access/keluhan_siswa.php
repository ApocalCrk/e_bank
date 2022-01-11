<div class="col-md-4">
	<form action="<?php echo site_url('Siswaui/aksi_kirim_keluhan') ?>" method="POST">
		<?php 
			$id_siswa = $this->session->userdata("id_siswa");
			$nis = $this->session->userdata("nis");
			$sql = $this->db->query("SELECT * FROM user WHERE id_siswa='$id_siswa' and nis='$nis'")->row(); 
		?>
		<div class="form-group">
			<label>From</label>
			<input type="text" name="from" id="from" class="form-control" value="<?php echo $sql->email ?>" readonly>
		</div>
		<div class="form-group" style="display: none">
			<label>To</label>
			<input type="text" name="to" id="to" class="form-control" value="ferdyfirmansyah3026@gmail.com" readonly>
		</div>
		<div class="form-group">
			<label>Subjek Pesan</label>
			<input type="text" name="subjek" id="subjek" class="form-control" value="<?php echo $subjek ?>" required>
		</div>
		<div class="form-group">
			<label>Isi Pesan</label>
			<textarea name="isi_pesan" id="isi_pesan" class="form-control" value="<?php echo $isi_pesan ?>" required></textarea>
		</div>
		<button class="btn btn-primary" onclick="return alert_confirm()">Kirim</button>
	</form>
</div>

<script type="text/javascript">
	function alert_confirm(){
		return confirm('Are you sure?')
	}
</script>