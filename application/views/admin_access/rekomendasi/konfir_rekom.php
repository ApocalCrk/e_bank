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
            $query = $this->db->query("SELECT * FROM rekomendasi where kode_rekom!='administrator' and active='0'");
        	foreach ($query->result() as $rekom){
        ?>
        <tr>
            <?php if ($rekom->tgl_awal_rekom >= date('Y-m-d')){?>
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
                <a href="<?php echo site_url('rekom/konfirmasi/'.$rekom->id_produk) ?>">Konfirmasi</a>
                |
                <a href="<?php echo site_url('rekom/tolak/'.$rekom->id_produk) ?>">Tolak</a>
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
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

<script>
  $(function () {
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      
    });
  });
</script>