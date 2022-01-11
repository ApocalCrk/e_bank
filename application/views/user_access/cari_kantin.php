<div class="container col-md-4">
	<form action="" class="form-inline" method="GET">
		<input type="text" name="q" placeholder="Cari Kantin" class="ck" 
		style="
		padding: 10px;
		width: 100%;
		outline-color: none;
		outline: none;
		border: none;
		border-radius: 10px;
		border: 1px solid #eee;
		box-shadow: 1px 1px 1px 1px #eee">
		<i class="fa fa-times clear" style="border: none;border-color: #fff;background-color: inherit;position: absolute;right: 34px;margin-top: 2px;outline: none;font-size: 18px;cursor: pointer;display: none;"></i>
	</form>
	<?php 
		$query = urldecode($this->input->get('q'));
		if ($query) {
			$q = urlencode($query);
	 ?>
	 <div class="kantin_all">
		<?php
           	$sql = $this->db->query("SELECT * from kantin where nama_kantin like '%$q%'");
           	foreach ($sql->result() as $rw) {
        ?>
		<a class="align-items-center box-kantin" href="<?php echo site_url('Siswaui/detail_kantin/'.$rw->id_kantin) ?>" 
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
		border-radius: 10px;"
		>
			<img class="img-profile" 
			style="width: 100px;height: 75px;margin-left: 10px;border-radius: 10px"
			src="image/kantin/<?php echo $rw->foto_kantin ?>">
			<b style="position: relative;top: -8px;left: 5px;width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;color: inherit;line-height: 18px">
				<?php echo $rw->nama_kantin ?><br>
				<div>
					<i style="font-size: 13px">Food</i>
				</div>
			</b>	
		</a>
		<?php } ?>
	</div>
	<?php }else{ ?>
	<div class="kantin_all">
		<?php
           	$sql = $this->db->query("SELECT * from kantin");
           	foreach ($sql->result() as $rw) {
        ?>
		<a class="align-items-center box-kantin" href="<?php echo site_url('Siswaui/detail_kantin/'.$rw->id_kantin) ?>" 
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
		border-radius: 10px;"
		>
			<img class="img-profile" 
			style="width: 100px;height: 75px;margin-left: 10px;border-radius: 10px"
			src="image/kantin/<?php echo $rw->foto_kantin ?>">
			<b style="position: relative;top: -8px;left: 5px;width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;color: inherit;line-height: 18px">
				<?php echo $rw->nama_kantin ?><br>
				<div>
					<i style="font-size: 13px">Food</i>
				</div>
			</b>
		</a>
		<?php } ?>
	</div>
	<?php } ?>
</div>
