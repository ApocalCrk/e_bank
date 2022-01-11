<form action="Kantinui/aksi_ubahpassword_kantin" method="post">
	<?php echo $this->session->flashdata('message_ubah') ?>
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Kantin</label>
			<input class="form-control" placeholder="Username" name="nama" value="<?php echo $this->session->userdata('nama_kantin'); ?>" type="text" readonly>
		</div>
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" placeholder="Username" name="username" value="<?php echo $this->session->userdata('username'); ?>" type="text" readonly>
		</div>
		<div class="form-group">
			<label>Password Lama</label>
			<input class="form-control" placeholder="Password Lama" name="pswlama"  type="password" autofocus required>
			<input type="hidden" name="kode_kantin" value="<?php echo $this->session->userdata('kode_kantin'); ?>">
		</div>
		<div class="form-group">
			<label>Password Baru</label>
			<input class="form-control" placeholder="Password Baru" name="pswbaru"  type="password" required>
		</div>
		<div class="form-group">
			<button class="btn btn-success" type="submit">Ubah</button>
		</div>
	</div>
</form>