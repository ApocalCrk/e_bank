<form action="kantinui/action_edit_data" method="post" enctype="multipart/form-data" class="col">
	<div class="form-group">
		<label>Kode Kantin</label>
		<input type="text" name="kode_kantin" class="form-control" value="<?php echo $kode_kantin ?>" readonly>
	</div>
	<div class="form-group">
		<label>Nama Kantin</label>
		<input type="text" name="nama_kantin" class="form-control" value="<?php echo $nama_kantin ?>">
	</div>
	<div class="form-group">
		<label>No Hp kantin</label>
		<input type="text" name="no_hp_kantin" class="form-control" value="<?php echo $no_hp_kantin ?>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" value="<?php echo $email ?>">
	</div>
	<div class="form-group">
		<label>Pengurus Kantin</label>
		<input type="text" name="pengurus_kantin" class="form-control" value="<?php echo $pengurus_kantin ?>">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" class="form-control" value="<?php echo $username ?>">
	</div>
	<div class="form-group">
		<label>Foto Kantin</label>
		<input type="file" name="foto_kantin" class="form-control" value="<?php echo $foto_kantin ?>">
		<?php 
            if ($foto_barang !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/kantin/<?php echo $foto_kantin ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
        ?>
	</div>
	<button type="submit" class="btn btn-warning">Update</button>
	<a href="kantinui/data_kantin" class="btn btn-secondary">Cancel</a>
</form>