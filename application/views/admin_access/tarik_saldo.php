<div class="text-center"><?php echo $this->session->flashdata('message') ?></div>
<form method="post" action="">
	<div class="form-group">
		<label>Kategori Level</label>
		<br>
		<select name="kategori" class="selectpicker">
			<option value=""></option>
			<option value="siswa">Siswa</option>
			<option value="kurir">Kurir</option>
			<option value="kantin">Kantin</option>
		</select>
		<button type="submit" class="btn btn-primary">Cari</button>
	</div>
</form>

<?php 
	$kategori = $this->input->post('kategori');

	if ($kategori == 'siswa') {
 ?>
<form action="<?php echo site_url('app/aksi_tarik_saldo_siswa') ?>" method="post">
	<div class="form-group">
		<label>NIS</label>
		<br>
		<select class="selectpicker" name="nis" data-live-search="true" autofocus required>
			<option value=""></option>
			<?php 
				$sql = $this->db->query("SELECT * FROM tabungan");
				foreach($sql->result() as $row){
					$sql_name = $this->db->query("SELECT * FROM user where nis='$row->nis'");
                	$name = $sql_name->row_array();
			 ?>
			 <option value="<?php echo $row->nis ?>"><?php echo $row->nis.' - '.$name['nama_siswa'] ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Jumlah Penarikan</label>
		<input type="number" class="form-control" min="1" name="jumlah_penarikan" required>
	</div>
	<input type="text" name="waktu"  value="<?php echo date('Y-m-d H:i:s') ?>" style="display: none;">
	<button type="submit" class="btn btn-primary">Tarik</button>
	<a href="app/tarik_saldo" class="btn btn-default">Cancel</a>
</form>
<?php }elseif ($kategori == 'kurir') {?>
 <form action="<?php echo site_url('app/aksi_tarik_saldo_kurir')?>" method="post">
	<div class="form-group">
		<label>NIS Kurir</label>
		<br>
		<select class="selectpicker" name="nis_kurir" data-live-search="true" autofocus required>
			<option value=""></option>
			<?php 
				$sql = $this->db->query("SELECT * FROM tabungan_kurir");
				foreach($sql->result() as $row){
					$sql_name = $this->db->query("SELECT * FROM kurir where nis_kurir='$row->nis_kurir'");
                	$name = $sql_name->row_array();
			 ?>
			 <option value="<?php echo $row->nis_kurir ?>"><?php echo $row->nis_kurir.' - '.$name['nama_kurir'] ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Jumlah Penarikan</label>
		<input type="number" class="form-control" min="1" name="jumlah_penarikan" required>
	</div>
	<input type="text" name="waktu"  value="<?php echo date('Y-m-d H:i:s') ?>" style="display: none;">
	<button type="submit" class="btn btn-primary">Tarik</button>
	<a href="app/tarik_saldo" class="btn btn-default">Cancel</a>
</form>
 <?php }elseif ($kategori == 'kantin') {?>
 <form action="<?php echo site_url('app/aksi_tarik_saldo_kantin')?>" method="post">
	<div class="form-group">
		<label>Kode Kantin</label>
		<br>
		<select class="selectpicker" name="kode_kantin" data-live-search="true" autofocus required>
			<option value=""></option>
			<?php 
				$sql = $this->db->query("SELECT * FROM tabungan_kantin");
				foreach($sql->result() as $row){
					$sql_name = $this->db->query("SELECT * FROM kantin where kode_kantin='$row->kode_kantin'");
                	$name = $sql_name->row_array();
			 ?>
			 <option value="<?php echo $row->kode_kantin ?>"><?php echo $row->kode_kantin.' - '.$name['nama_kantin'] ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Jumlah Penarikan</label>
		<input type="number" class="form-control" min="1" name="jumlah_penarikan" required>
	</div>
	<input type="text" name="waktu"  value="<?php echo date('Y-m-d H:i:s') ?>" style="display: none;">
	<button type="submit" class="btn btn-primary">Tarik</button>
	<a href="app/tarik_saldo" class="btn btn-default">Cancel</a>
</form>
<?php }else{} ?>