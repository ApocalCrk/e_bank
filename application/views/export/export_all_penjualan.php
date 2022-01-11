<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=data_penjualan_".date('Y-m-d').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <h2>Data Penjualan</h2>
 <table>
 	<tr>
 		<th>No</th>
 		<th>Kode Penjualan</th>
 		<th>Total Harga</th>
 		<th>Pembeli</th>
 		<th>Waktu</th>
 	</tr>
 	<?php 
 		$start = 0;
 		$kode = $this->session->userdata('kode_kantin');
 		$sql = $this->db->query("SELECT * FROM penjualan_header,penjualan_detail WHERE penjualan_header.key_barang ='$kode' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan");
 		foreach ($sql->result() as $pen) {?>
 	<tr>
 		<td><?php echo ++$start ?></td>
 		<td><?php echo $pen->kode_penjualan ?></td>
 		<td><?php echo 'Rp. '.number_format($pen->total_harga)?></td>
 		<td><?php echo $pen->nis ?></td>
 		<td><?php echo $pen->tgl_penjualan ?></td>
 	</tr>
 	<?php } ?>
 </table>