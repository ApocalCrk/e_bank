<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('rekom/create'),'Tambah', 'class="btn btn-primary"'); ?>
        <a href="<?php echo site_url('rekom/konfir_rekom') ?>" class="btn btn-primary">Konfirmasi Rekomendasi</a>
    </div>
    <div class="col-md-4 text-center">
    	<div style="margin-top: 8px;" id="message">
    		<div style="margin-top: 8px" id="message">
                <?php 
                echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; 
                ?>
            </div>
    	</div>
    	<div class="col-md-1 text-right">
        </div>
    </div>
	<div class="col-md-3 text-right">
        <form action="<?php echo site_url('tabungan/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                   	<?php 
                        if ($q <> ''){
                     ?>
                     <a href="<?php echo site_url('tabungan'); ?>" class="btn btn-default">Reset</a>
                    <?php } ?>
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
        	<th>Kode Produk</th>
        	<th>Nama Produk</th>
        	<th>Tanggal Awal Rekomendasi</th>
        	<th>Tanggal Akhir Rekomendasi</th>
        	<th>Active</th>
        	<th>Action</th>
        </tr>
   	</thead>
    <tbody>
        <?php
        	foreach ($rekom_data as $rekom){
        ?>
        <tr>
        <?php if ($rekom->active=='1'){ ?>
        	<td width="80px"><?php echo ++$start ?></td>
        	<td><?php echo $rekom->kode_produk ?></td>
        	<?php 
        	$kd = $rekom->kode_produk;
        	$sql = $this->db->query("SELECT nama_barang FROM barang where kode_barang='$kd'"); 
        	foreach ($sql->result() as $rw) {
        	?>
        	<td><?php echo $rw->nama_barang ?></td>
        	<?php } ?>
        	<td><?php echo $rekom->tgl_awal_rekom ?></td>
        	<td><?php echo $rekom->tgl_akhir_rekom ?></td>
        	<td><?php echo $rekom->active ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('rekom/update/'.$rekom->id_produk),'Update'); 
                echo ' | '; 
                echo anchor(site_url('rekom/delete/'.$rekom->id_produk),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        <?php }else{} ?>
        </tr>
    </tbody>
                <?php
            }
            ?>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-primary">Total Record : <?php echo $this->db->query("SELECT * FROM rekomendasi WHERE active='1'")->num_rows() ?></div>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>