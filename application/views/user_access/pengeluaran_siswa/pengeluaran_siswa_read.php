<div class="col ml-3">
	<p class="h6">Kode Penjualan: <?php echo $kode_penjualan ?></p>
</div>
<div class="col ml-3">
	<p class="h6">Pembeli: <?php echo $nis_pembeli.' - '.$this->session->userdata('nama_siswa') ?></p>
</div>
<div class="col ml-3">
	<p class="h6">Tanggal Pembelian: <?php echo $tgl_penjualan.' WIB' ?></p>
</div>
<div class="col ml-3">
	<p class="h6">
		Kantin: 
		<?php 
			$query = $this->db->query("SELECT nama_kantin FROM kantin where kode_kantin='$key_barang'");
			$hasil = $query->row_array();
			echo $hasil['nama_kantin'];
		?>
	</p>
</div>
<br>
<h5 class="col ml-3">Data Pembelian</h5>
<div class="table-responsive" style="padding-left: 25px;padding-right: 25px;">
	<table class="table">
		<thead align="center">
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Jumlah Beli</th>
				<th>Harga</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php 
			$sql = $this->db->query("SELECT * FROM penjualan_detail where kode_penjualan='$kode_penjualan'");
			$start = 0;
			foreach ($sql->result() as $rw){?>
			<tr>
				<td><?php echo ++$start ?></td>	
				<td>
					<?php 
						$barang = $this->db->query("SELECT * FROM barang where kode_barang='$rw->kode_barang'");
						foreach ($barang->result() as $brg) {
							echo $brg->nama_barang;
							?>
				</td>
				<td><?php echo $rw->qty?></td>
				<td><?php echo 'Rp. '.number_format($brg->harga_jual*$rw->qty) ?></td>
			</tr>
		<?php } ?>
			<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td>Total Harga : </td>
				<td><?php echo 'Rp. '.number_format($total_harga) ?></td>
			</tr>
		</tbody>
	</table>
</div>
<a href="javascript:history.go(-1)" class="btn btn-primary ml-3">Back</a>