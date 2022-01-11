<table class="table">
	<thead>
	 	<tr align="center">
	 		<td>NIS</td>
	 		<td>Saldo Tambahan</td>
	 		<td>Waktu</td>
	 	</tr>
	 </thead>
	 <tbody>
	<?php 
		$nis = $this->session->userdata('nis');
		$sql = $this->db->query("SELECT * FROM detail_tambahan where nis='$nis'");
		foreach ($sql->result() as $rw) {
	 ?>
	<tr align="center">
		<td><?php echo $rw->nis ?></td>
		<td>Rp. <?php echo number_format($rw->saldo_tambahan) ?></td>
		<td><?php echo $rw->waktu ?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>