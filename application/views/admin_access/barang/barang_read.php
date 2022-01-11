<table class="table">
	<tr><td>Kode Produk/Barang</td><td><?php echo $kode_barang; ?></td></tr>
    <tr><td>Nama Produk/Barang</td><td><?php echo $nama_barang; ?></td></tr>
    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
    <tr><td>Kategori</td><td><?php echo $kategori; ?></td></tr>
	<tr><td>Foto Produk/Barang</td><td><img src="image/barang_view/<?php echo $foto_barang ?>" width="120px"></td></tr>
    <tr><td>Harga</td><td><?php echo 'Rp. '.number_format($harga_jual); ?></td></tr>
	<tr><td>Pemilik</td><td><?php echo $key_barang; ?></td></tr>
	<tr><td></td><td><a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a></td></tr>
</table>