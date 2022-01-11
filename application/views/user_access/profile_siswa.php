<head>
	<style type="text/css">
		img.ubah-foto {
			width: 255px;
			height: 257px;
		}
		#foto{
			width: 255px;
			height: 257px;
		}
		.ubah-foto {
			transition: 0.5s;
			cursor: pointer;
		}
		.ubah-foto:hover ~ .edit-foto{
			display: block;
		}
		.edit-foto {
			background-color: rgba(0,0,0,.45);
			transition: 0.8s;
			width: 255px;
			height: 257px;
			display: none;
			border-radius: 50%;
			top: 0;
		}
		.fa-camera {
			font-size: 24px;
			position: absolute;
			left: 4.8em;
			top: 5em;
			cursor: pointer;
			color: #000;
		}
	</style>
</head>
<div class="container col">
	<?php echo $this->session->flashdata("message_berhasil") ?>
	<?php 
		$id_siswa = $this->session->userdata("id_siswa");
		$nis = $this->session->userdata("nis");
		$sql = $this->db->query("SELECT * FROM user WHERE id_siswa='$id_siswa' and nis='$nis'")->row(); 
	?>
	<div class="d-flex justify-content-center">
		<img src="image/siswa/<?php echo $sql->foto ?>" class="rounded-circle position-relative" id="foto">
		<img src="image/siswa/<?php echo $sql->foto ?>" class="rounded-circle ubah-foto position-relative" id="update_foto" style="display: none">
		<span class="edit-foto position-absolute" onclick="edit_foto()">
			<h3 class="h5 text-center text-white" style="position: relative;top: 9em;">Edit Foto</h3>
			<span class="fas fa-camera"></span>
		</span>
	</div>
	<div class="text-center mt-4">
		<h3><?php echo $this->session->userdata('nama_siswa') ?></h3>
		<h6 id="nis"><?php echo $sql->nis ?></h6>
		<a class="btn btn-light" onclick="more_edit()" style="border: 1px solid #ccc">Edit Profile</a>
	</div>
	<form action="Siswaui/ubah_profile_saya" id="form-update" method="post" class="mx-auto mt-3" style="width: 300px;display: none;-webkit-animation: fadeIn 0.8s linear;animation: fadeIn 0.8s linear;" enctype="multipart/form-data">
		<div class="form-group">
			<input type="file" name="foto" id="update" class="form-control" style="display: none;">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>NIS</label>
			<input type="text" name="nis" class="form-control" value="<?php echo $sql->nis ?>" readonly>
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Username</label>
			<input type="text" name="username" class="form-control" value="<?php echo $sql->username ?>">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Alamat</label>
			<textarea name="alamat" class="form-control"><?php echo $sql->alamat ?></textarea>
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Tempat Lahir</label>
			<input type="text" name="tempat_lahir" class="form-control" value="<?php echo $sql->tempat_lahir ?>">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Tanggal Lahir</label>
			<input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $sql->tanggal_lahir ?>">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>No Hp</label>
			<input type="text" name="no_hp" class="form-control" value="<?php echo $sql->no_hp ?>">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Email</label>
			<input type="email" name="email" class="form-control" value="<?php echo $sql->email ?>">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Kelas</label>
			<input type="text" name="kelas" class="form-control" value="<?php echo $sql->kelas ?>">
		</div>
		<div class="form-group" style="width: 300px;">
			<label>Jurusan</label>
			<input type="text" name="jurusan" class="form-control" value="<?php echo $sql->jurusan ?>">
		</div>
		<div class="text-right">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a onclick="more_edit()" style="color: #fff;" class="btn btn-secondary">Cancel</a>
		</div>
	</form>











	<script type="text/javascript">
		function edit_foto(){
			document.getElementById('update').click();
		}
		function more_edit() {
		  var x = document.getElementById("form-update");
		  var f = document.getElementById("foto");
		  var uf = document.getElementById("update_foto");
		  var ns = document.getElementById("nis");
		  if (x.style.display === "none") {
		    x.style.display = "block";
		    f.style.display = "none";
		    uf.style.display = "block";
		    ns.style.display = "none";
		  } else {
		    x.style.display = "none";
		    f.style.display = "block";
		    uf.style.display = "none";
		    ns.style.display = "block";
		  }
		} 
	</script>
</div>