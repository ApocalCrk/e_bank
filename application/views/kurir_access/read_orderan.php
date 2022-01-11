<form method="post" action="<?php echo site_url('Kurirui/orderan_masuk/'.$invoice_order) ?>">
<div class="col-xl-11">
	<label style="position: absolute;top: -24px;font-size: 12px">Tanggal: <?php echo $waktu ?></label>
<table style="border:none;padding:0px;font-size:inherit;">
	<tbody>
		<tr>
			<td>No Invoice</td>
			<td>:</td>
			<td><?php echo $invoice_order ?></td>
		</tr>
		<tr>
			<td>Pembeli</td>
			<td>:</td>
			<td><?php echo $nama_pembeli ?></td>
		</tr>
		<tr>
			<td>Pembayaran</td>
			<td>:</td>
			<td><?php echo $metode_pembayaran ?></td>
		</tr>
		<tr>
			<td>Tujuan</td>
			<td>:</td>
			<td><?php echo $tujuan ?></td>
		</tr>
		<tr>
			<td>Status Order</td>
			<td>:</td>
			<td>
				<?php if($status == 'Menunggu Konfirmasi Kurir'){echo $status;}else{?>
					<select name="status" class="form-control">
						<option><?php echo $status ?></option>
						<option>Sedang Dipesan</option>
						<option>Sedang Dikemas</option>
						<option>Dalam Perjalanan</option>
						<option>Sudah Sampai di Tujuan</option>
						<option>Transaksi Selesai</option>
					</select>
				<?php } ?>	 	
			</td>
		</tr>
		<tr>
			<td>Kantin</td>
			<td>:</td>
			<td>
				<?php echo $kantin ?>
			</td>
		</tr>
	</tbody>
</table>

<label>Pesanan <i class="fa fa-angle-up" id="pesanan_drop" onclick="pesanan_show()" style="position: absolute;margin-top: 7px;margin-left: 5px;cursor: pointer;"></i></label><br>
<p style="border:2px solid #ccc;-webkit-animation: fadeIn 0.8s linear;animation: fadeIn 0.8s linear;" id="pesanan"><?php echo $pesanan ?></p>
<label style="line-height: 5px">Total Harga Pesanan</label><br>
<b><?php echo 'Rp. '.number_format($total_harga) ?></b>
<br>
<label style="line-height: 5px">Ongkir</label><br>
<b><?php echo 'Rp. '.number_format($ongkir) ?></b>

<?php if ($status != 'Menunggu Konfirmasi Kurir') {?>
	<div style="position: absolute;right: 38px;top: 230px">
	<label>Note</label>&nbsp;&nbsp;
	<?php if ($note == ''){ ?>
		<a class="fa fa-sticky-note"></a>
	<?php }else{ ?>
		<a href="#" data-toggle="modal" data-target="#noteModal" class="fa fa-sticky-note text-primary" style="cursor: pointer;"></a>
	<?php } ?>
	</div>
<?php } ?>

<div style="float: right;margin-top: -24px">
<label style="line-height: 5px">Total Semua</label><br>
<b><?php echo 'Rp. '.number_format($total_harga+$ongkir) ?></b>
</div>

<?php if($status == 'Menunggu Konfirmasi Kurir'){ ?>
<div class="mt-4">
	<button type="submit" name="tolak" class="btn btn-danger">Tolak Order</button>
	<button type="submit" name="terima" class="btn btn-success" style="float: right">Terima Order</button>
</div>
<?php }else{?>
<div class="mt-4">
	<button type="submit" name="update" class="btn btn-warning">Update</button>
	<?php 
	$ex = explode('-', $nama_pembeli);
	$sql = $this->db->query("SELECT * FROM user WHERE nama_siswa='$ex[0]' and nis='$ex[1]'")->row();
	?>
	<a href="<?php echo site_url('Kurirui/chat_pembeli/'.$sql->id_siswa.'-'.$this->session->userdata('id_kurir')) ?>" class="btn btn-success" style="float: right">Chat <span class="badge badge-danger badge-counter" id="nums_message"></span></a>
</div>
<?php } ?>

</div>
</form>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Note</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<label>Note/Pesan</label>
        	<textarea class="form-control" readonly=""><?php echo $note ?></textarea>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
		function pesanan_show() {
		  var x = document.getElementById("pesanan_drop");
		  var p = document.getElementById("pesanan");
		  if (p.style.display === "block") {
		    x.style.transform = "rotate(180deg)";
		    p.style.display = "none"
		  	} else {
		    x.style.transform = "rotate(0deg)";
		    p.style.display = "block";
		  }
		} 
</script>