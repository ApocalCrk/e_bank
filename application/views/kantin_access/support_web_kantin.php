<div class="col-md-4 container">
	<?php echo $this->session->flashdata('message') ?>
	<form action="" class="form-inline" method="GET">
		<input type="text" name="q" placeholder="Cari Permasalahan Anda" class="sp" 
		style="
		padding: 10px;
		width: 100%;
		outline-color: none;
		outline: none;
		border: none;
		border-radius: 6px;
		border: 1px solid #eee;
		box-shadow: 1px 1px 1px 1px #eee">
	</form>

	<a class="align-items-center box-mes" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		top: 20px;
		margin-bottom: 10px;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 10px;" href="Kantinui/masalah_akun" 
		>
		<i class="rounded-circle fa fa-user" style="font-size: 200%;margin-left: 20px;border: 1px solid #ccc;padding: 10px;box-shadow: 1px 1px 1px 0px #ccc"></i>
		<p style="position: relative;top:8px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			Masalah Akun
		</p>
		<i class="fa fa-angle-right" style="font-size: 25px;margin-top: 2px;"></i>
	</a>

	<a class="align-items-center box-mes" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		top: 20px;
		margin-bottom: 10px;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 10px;" href="Kantinui/bantuan_akun" 
		>
		<i class="rounded-circle fa fa-question" style="font-size: 200%;margin-left: 20px;border: 1px solid #ccc;padding: 10px;box-shadow: 1px 1px 1px 0px #ccc"></i>
		<p style="position: relative;top:8px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			Bantuan 
		</p>
		<i class="fa fa-angle-right" style="font-size: 25px;margin-top: 2px;"></i>
	</a>

	<a class="align-items-center box-mes" 
		style=
		"width: 100%;
		height: 100px;
		background: rgba(255,255,255,100);
		display: inline-flex;
		top: 20px;
		margin-bottom: 10px;
		position: relative;
		text-decoration: none;
		color: inherit;
		border-radius: 10px;" href="Kantinui/kirim_keluhan" 
		>
		<i class="rounded-circle fa fa-paper-plane" style="font-size: 200%;margin-left: 20px;border: 1px solid #ccc;padding: 10px;box-shadow: 1px 1px 1px 0px #ccc"></i>
		<p style="position: relative;top:8px;left: 20px;width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
			Kirim Keluhan
		</p>
		<i class="fa fa-angle-right" style="font-size: 25px;margin-top: 2px;"></i>
	</a>
</div>