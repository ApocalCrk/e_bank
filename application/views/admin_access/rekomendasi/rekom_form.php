<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="varchar">Kode Produk <?php echo form_error('kode_produk') ?></label><br>
		<select name="kode_produk" id="kode_produk" class="selectpicker" data-live-search="true" autofocus>
			<option value="<?php echo $kode_produk ?>"><?php echo $kode_produk ?></option>
			<?php 
				$query = $this->db->get('barang');
				foreach ($query->result() as $rw) {
			 ?>
			<option value="<?php echo $rw->kode_barang ?>"><?php echo $rw->kode_barang.' - '.$rw->nama_barang ?></option>
		<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label for="varchar">Foto Produk/Barang <?php echo form_error('foto') ?></label>
		<input type="file" name="foto" placeholder="Foto" id="foto" value="<?php echo $foto ?>" class="form-control"/>
		<?php 
			if ($foto !== '') {
				?>
				<div>
					*) Gambar Sebelumnya <br>
					<img src="image/all/<?php echo $foto; ?>" style="width: 100px;height: 100px;">
				</div>
				<?php
			}else{

			}
		?>
	</div>
	
	<div class="form-group">
		<label for="varchar">Tanggal Awal Rekomendasi <?php echo form_error('tgl_awal_rekom') ?></label>
		<input type="date" id="tgl_awal_rekom" name="tgl_awal_rekom" class="form-control" value="<?php echo $tgl_awal_rekom ?>">
	</div>

	<div class="form-group">
		<label for="varchar">Tanggal Akhir Rekomendasi <?php echo form_error('tgl_akhir_rekom') ?></label>
		<input type="date" id="tgl_akhir_rekom" name="tgl_akhir_rekom" class="form-control" value="<?php echo $tgl_akhir_rekom ?>">
	</div>

	<div class="form-group">
		<label>Active Rekomendasi <?php echo form_error('active') ?></label>
		<select name="active" class="form-control" id="active">
			<option value="<?php echo $active ?>"><?php echo $active ?></option>
			<option value="1">Active</option>
			<option value="0">Non-Active</option>
		</select>
	</div>

	<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
	<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	<a href="<?php echo site_url('rekom') ?>" class="btn btn-secondary">Cancel</a>
</form>