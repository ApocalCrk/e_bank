<div class="row" style="padding: 30px">
	<?php echo $this->session->flashdata('message') ?>
	<div class="col-md-4">
	<a href="Kantinui/create_barang" class="btn btn-primary">Tambah Produk</a>
	<a href="Kantinui/export_barang_kantin" target="_blank" class="btn btn-info">Export</a>
	</div>
	<div class="table-responsive" style="margin-top: 10px;">
		<table class="table table-bordered" id="dataTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Produk/Barang</th>
					<th>Nama Produk/Barang</th>
					<th>Satuan</th>
					<th>Stok</th>
					<th>Kategori</th>
					<th>Harga Pokok</th>
					<th>Harga Jual</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$key = $this->session->userdata('kode_kantin');
				$start = 0;
				$query = $this->db->query("SELECT * FROM barang where key_barang='$key'");
				foreach ($query->result() as $row){
			 ?>
			 <tr>
				<td><?php echo ++$start ?></td>
				<td><?php echo $row->kode_barang ?></td>
				<td><?php echo $row->nama_barang ?></td>
				<td><?php echo $row->satuan ?></td>
				<td>
					<?php 
						if ($row->stok <= 0) {
							echo "<p class='font-weight-bold text-danger'>Stok Habis</p>";
						}else{
							echo $row->stok;
						}
					?>
				</td>
				<td><?php echo $row->kategori ?></td>
				<td><?php echo 'Rp. '.number_format($row->harga_pokok) ?></td>
				<td><?php echo 'Rp. '.number_format($row->harga_jual) ?></td>
				<td width="220px">
					<?php 
						echo anchor(site_url('Kantinui/detail_barang/'.$row->id_barang),'Detail','class="btn btn-primary"');
						echo ' ';
		                echo anchor(site_url('Kantinui/update/'.$row->id_barang),'Edit','class="btn btn-warning"'); 
		                echo ' ';
	                ?>
	                <a href="<?php echo site_url('barang/delete_for_kantin/'.$row->id_barang) ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-danger">Hapus</a>
				</td>
			</tr>
		<?php } ?>
			</tbody>
		</table>
		
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>