<div class="table-responsive mt-3" style="margin-bottom: 10px;padding: 0 10px;">
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table table-bordered" id="dataTable">
    <thead>
      	<tr>
          	<th>No</th>
        	<th>Kode Produk</th>
        	<th>Nama Produk</th>
        	<th>Tanggal Awal Rekomendasi</th>
        	<th>Tanggal Akhir Rekomendasi</th>
        	<th>Active</th>
        	<th>Aksi</th>
        </tr>
   	</thead>
    <tbody>
        <?php
            $kode_rekom = $this->session->userdata('nama_kantin');
        	$query = $this->db->query("SELECT * FROM rekomendasi where kode_rekom='$kode_rekom'");
            foreach ($query->result() as $rekom) {
        ?>
        <tr>
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
            <td style="text-align:center" width="80px">
                <a href="<?php echo site_url('rekom/delete_kantin/'.$rekom->id_produk) ?>" class="btn btn-danger" onclick="return alert_hapus()">Delete</a>
                <script type="text/javascript">
                    function alert_hapus(){
                        return confirm('Are you sure?');
                    }
                </script>
            </td>
        </tr>
    </tbody>
                <?php
            }
            ?>
        </table>
    </div>