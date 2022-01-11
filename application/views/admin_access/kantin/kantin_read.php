
        <table class="table">
	    <tr><td>Kode Kantin</td><td><?php echo $kode_kantin; ?></td></tr>
	    <tr><td>Nama Kantin</td><td><?php echo $nama_kantin; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp_kantin; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Nama Pengurus Kantin</td><td><?php echo $pengurus_kantin; ?></td></tr>
        <tr><td>Foto</td><td><img src="image/kantin/<?php echo $foto_kantin; ?>" style="width: 50px;height: 50px;"></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kantin') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>