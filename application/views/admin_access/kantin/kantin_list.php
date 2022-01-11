<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-4">
		<?php echo anchor(site_url('kantin/create'),'Tambah Kantin','class="btn btn-primary"') ?>
	</div>
	<div class="col-md-4 text-center">
		<div style="margin-top: 8px;" id="message">
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
		</div>
	</div>
	<div class="col-md-1 text-right">
	</div>
	<div class="col-md-3 text-right">
		<form action="<?php echo site_url('kantin/index'); ?>" class="form-inline" method="get">
			<div class="input-group">
				<input type="text" name="q" class="form-control" value="<?php echo $q; ?>">
				<span class="input-group-btn">
					<?php 
						if ($q <> '') {
							?>
							<a href="<?php echo site_url('kantin'); ?>" class="btn btn-default">Reset</a>
					<?php
						}
					 ?>
					 <button class="btn btn-primary" type="submit">Search</button>
				</span>
			</div>
		</form>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-bordered" id="example1" style="margin-bottom: 10px">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Kantin</th>
				<th>Nama Kantin</th>
				<th>No Hp</th>
				<th>Email</th>
				<th>Pengurus Kantin</th>
				<th>Foto Kantin</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kantin_data as $kantin) {?>
				<tr>
				<td width="80px"><?php echo ++$start ?></td>
				<td><?php echo $kantin->kode_kantin ?></td>
				<td><?php echo $kantin->nama_kantin ?></td>
				<td><?php echo $kantin->no_hp_kantin ?></td>
				<td><?php echo $kantin->email ?></td>
				<td><?php echo $kantin->pengurus_kantin ?></td>
				<td><img src="image/kantin/<?php echo $kantin->foto_kantin ?>" style="width: 50px;height:50px;"></td>
				<td style="text-align: center;" width="200px">
					<?php 
		                echo anchor(site_url('kantin/read/'.$kantin->id_kantin),'Detail'); 
		                echo ' | '; 
		                echo anchor(site_url('kantin/update/'.$kantin->id_kantin),'Update'); 
		                echo ' | '; 
		                echo anchor(site_url('kantin/delete/'.$kantin->id_kantin),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
	                ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="btn btn-primary">Total Record : <?php echo $total_rows ?></div>
        <a href="app/export_kantin" target="_blank" class="btn btn-info">Export</a>
   	</div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>