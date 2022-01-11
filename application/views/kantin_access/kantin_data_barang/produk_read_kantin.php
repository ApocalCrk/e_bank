<table class="table">
<tr>
	<td>Kode Produk/Barang</td>
	<td><?php echo $kode_barang ?></td>
</tr>
<tr>
	<td>Nama Produk/Barang</td>
	<td><?php echo $nama_barang ?></td>
</tr>
<tr>
	<td>Satuan</td>
	<td><?php echo $satuan ?></td>
</tr>
<tr>
	<td>Stok</td>
	<td><?php echo $stok ?></td>
</tr>
<tr>
	<td>Kategori</td>
	<td><?php echo $kategori ?></td>
</tr>
<tr>
	<td>Harga Pokok</td>
	<td><?php echo 'Rp. '.number_format($harga_pokok) ?></td>
</tr>
<tr>
	<td>Harga Jual</td>
	<td><?php echo 'Rp. '.number_format($harga_jual)?></td>
</tr>
<tr>
	<td>Foto Produk/Barang</td>
	<td><img src="image/barang_view/<?php echo $foto_barang ?>" width="120px"></td>
</tr>
<tr>
	<td>
	<a href="Kantinui/data_barang" class="btn btn-secondary">Back</a>
	<?php echo anchor(site_url('Kantinui/cetak_qr/'.$id_barang),'Cetak Qr','class="btn btn-primary"') ?>
	</td>
</tr>
</table>