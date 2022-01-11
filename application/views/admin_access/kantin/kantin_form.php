<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kode Kantin <?php echo form_error('kode_kantin') ?></label>
		<input type="text" name="kode_kantin" id="kode_kantin"class="form-control" value="<?php echo $kode_kantin ?>" readonly>
	</div>
	
	<div class="form-group">
		<label for="varchar">Nama Kantin <?php echo form_error('nama_kantin') ?></label>
		<input type="text" name="nama_kantin" class="form-control" placeholder="Nama Kantin" id="nama_kantin" value="<?php echo $nama_kantin ?>">
	</div>

	<div class="form-group">
		<label for="varchar">No Hp Kantin <?php echo form_error('no_hp_kantin') ?></label>
		<input type="text" name="no_hp_kantin" class="form-control" placeholder="No Hp Kantin" id="no_hp_kantin" value="<?php echo $no_hp_kantin ?>">
	</div>

	<div class="form-group">
		<label for="varchar">Email <?php echo form_error('email') ?></label>
		<input type="email" name="email" class="form-control" placeholder="Email" id="email" value="<?php echo $email ?>">
	</div>

	<div class="form-group">
		<label for="varchar">Nama Pengurus Kantin <?php echo form_error('pengurus_kantin') ?></label>
		<input type="text" name="pengurus_kantin" class="form-control" placeholder="Nama Pengurus Kantin" id="pengurus_kantin" value="<?php echo $pengurus_kantin ?>">
	</div>

	<div class="form-group">
		<label for="varchar">Foto Kantin <?php echo form_error('foto_kantin') ?></label>
		<input type="file" name="foto_kantin" class="form-control" placeholder="Foto Kantin" id="foto_kantin" value="<?php echo $foto_kantin ?>">
		<?php if ($foto_kantin !== '') {?>
			<div>
				*) Gambar Sebelumnya <br>
				<img src="image/kantin/<?php echo $foto_kantin ?>" style="width: 100px;height: 100px;">
			</div>
		<?php
			}else{

			}
		 ?>
	</div>

	<div class="form-group">
		<label for="varchar">Username <?php echo form_error('username') ?></label>
		<input type="text" name="username" class="form-control" placeholder="Username" id="username" value="<?php echo $username ?>">
	</div>

	<div class="form-group">
		<label for="varchar">Password <?php echo form_error('password') ?></label>
		<input type="password" class="form-control" name="password" id="password" onKeyUp="checkPasswordStrength();" placeholder="Password" minlength="6" value="<?php echo $password; ?>" />
        <div id="password-strength-status" style="font-weight: bold"></div>	
    </div>

	<div class="form-group">
		<label for="varchar">Level <?php echo form_error('level') ?></label>
		<input type="Level" name="level" class="form-control" placeholder="Level" id="level" value="kantin" readonly>
	</div>

	<input type="hidden" name="id_kantin" value="<?php echo $id_kantin; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('kantin') ?>" class="btn btn-default">Cancel</a>
	
</form>