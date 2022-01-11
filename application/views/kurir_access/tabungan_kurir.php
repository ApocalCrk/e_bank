<div class="table-responsive">
<table class="table">
	<tr>
		<td>Saldo Tabungan Kurir</td>
		<td>
			<?php 
				$saldo = 0;
				$key = $this->session->userdata('nis_kurir');
				$query = $this->db->query("SELECT * FROM tabungan_kurir where nis_kurir='$key'");
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
				$key = $this->session->userdata('nis_kurir');
				$query = $this->db->query("SELECT * FROM tabungan_kurir where nis_kurir='$key'");
				foreach ($query->result() as $row) {
					echo $row->waktu;
				}
			?>
		</td>
	</tr>
	<tr>
		<td><br>Total Pendapatan Hari Ini</td>
		<td><br>
			<?php 
				$id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
			    $sql=$this->db->query("SELECT SUM(total_harga) as total_harga,SUM(ongkir) as ongkir From order_pesanan where nama_kurir='$id' and DAY(waktu)=DAY(CURDATE()) and MONTH(waktu)=MONTH(CURDATE()) and YEAR(waktu)=YEAR(CURDATE()) and status='Transaksi Selesai'");
			    foreach ($sql->result() as $row) {
			    	$total_harga = 0 + $row->total_harga+$row->ongkir;
			    	echo 'Rp. '.number_format($total_harga);
			    }			 
    		?>
		</td>
	</tr>
	<tr>
		<td>Total Pendapatan Bulan Ini</td>
		<td>
			<?php                           
			   	$id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
			    $sql=$this->db->query("SELECT SUM(total_harga) as total_harga,SUM(ongkir) as ongkir From order_pesanan where nama_kurir='$id' and MONTH(waktu)=MONTH(CURDATE()) and YEAR(waktu)=YEAR(CURDATE()) and status='Transaksi Selesai'");
			    foreach ($sql->result() as $row) {
			    	$total_harga = 0 + $row->total_harga+$row->ongkir;
			    	echo 'Rp. '.number_format($total_harga);
			    }
			?>
		</td>
	</tr>
	<tr>
		<td>Total Pendapatan Bulan Sebelumnya</td>
		<td>
			<?php 
				$id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
			    $sql=$this->db->query("SELECT SUM(total_harga) as total_harga,SUM(ongkir) as ongkir From order_pesanan where nama_kurir='$id' and MONTH(waktu)=MONTH(CURDATE())-1 and YEAR(waktu)=YEAR(CURDATE()) and status='Transaksi Selesai'");
			    foreach ($sql->result() as $row) {
			    	$total_harga = 0 + $row->total_harga+$row->ongkir;
			    	echo 'Rp. '.number_format($total_harga);
			    }
			 ?>
		</td>
	</tr>
</table>
</div>