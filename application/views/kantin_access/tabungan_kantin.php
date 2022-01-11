<div class="table-responsive">
<table class="table">
	<tr>
		<td>Saldo Tabungan Kantin</td>
		<td>
			<?php 
				$saldo = 0;
				$key = $this->session->userdata('kode_kantin');
				$query = $this->db->query("SELECT * FROM tabungan_kantin where kode_kantin='$key'");
				foreach ($query->result() as $row) {
					$saldo = $saldo + $row->total_saldo;
				}
				echo 'Rp. '.number_format($saldo);
			 ?>
		</td>
	</tr>
	<tr>
		<td>Update Terakhir</td>
		<td>
			<?php 
				$key = $this->session->userdata('kode_kantin');
				$query = $this->db->query("SELECT * FROM tabungan_kantin where kode_kantin='$key'");
				foreach ($query->result() as $row) {
					echo $row->waktu;
				}
			?>
		</td>
	</tr>
	<tr>
		<td><br>Total Penjualan Hari Ini</td>
		<td><br>
			<?php 
				$total_pen = 0;
				$query = $this->db->query("SELECT * FROM penjualan_header where key_barang='$key' and DAY(tgl_penjualan)=DAY(CURDATE()) and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
				foreach ($query->result() as $row) {
					$total_pen = $total_pen+$row->total_harga;
				}
				echo 'Rp. '.number_format($total_pen);
			 ?>
		</td>
	</tr>
	<tr>
		<td>Total Penjualan Bulan Ini</td>
		<td>
			<?php 
				$total_pen = 0;
				$query = $this->db->query("SELECT * FROM penjualan_header where key_barang='$key' and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
				foreach ($query->result() as $row) {
					$total_pen = $total_pen+$row->total_harga;
				}
				echo 'Rp. '.number_format($total_pen);
			 ?>
		</td>
	</tr>
	<tr>
		<td>Total Penjualan Bulan Sebelumnya</td>
		<td>
			<?php 
				$total_pen = 0;
				$query = $this->db->query("SELECT * FROM penjualan_header where key_barang='$key' and MONTH(tgl_penjualan)=MONTH(CURDATE())-1 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
				foreach ($query->result() as $row) {
					$total_pen = $total_pen+$row->total_harga;
				}
				echo 'Rp. '.number_format($total_pen);
			 ?>
		</td>
	</tr>
</table>
</div>