<?php $sql=$this->db->get('barang') ?>
<?php echo $this->session->flashdata('message_saldo') ?>
<?php echo $this->session->flashdata('message_cart') ?>
<div class="col-md-4">
<a id="sc2" class="btn btn-primary" style="cursor: pointer;color: #fff">Scan QrCode</a>
</div>
<form action="Siswaui/simpan_cart" id="scan-qr" method="POST" style="margin-top: 60%;display: none;">
      <input type="hidden" name="qrcode_text" id="qrcode_text">
      <label class="qrcode-text-btn btn btn-primary" id="qrcode-text-btn" style="cursor: pointer;">
      Scan QRCode
            <input id="scan" type="file" accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" style="display: none;">
          </label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="submit" value="Submit" class="btn-primary btn align-center" id="submit" style="display: none;">
    </form>
<br>
<div class="row">
	<div class="col-md-12">
	<form action="Siswaui/aksi_pembelian" method="post">
        <table class="table table-responsive">
        	<tr align="center">
        		<th>No.</th>
        		<th><p style="width: 120px">Kode Produk</p></th>
        		<th><p style="width: 120px">Nama Produk</p></th>
        		<th>Jumlah</th>
        		<th><p style="width: 120px">Harga</p></th>
        		<th><p style="width: 120px">Subtotal</p></th>
                <th>Aksi</th>
        	</tr>
        	<tr>
        	<?php $i=1; $no=1;?>
            <?php foreach($this->cart->contents() as $items): ?>
                <?php $query = $this->db->query("SELECT * FROM barang where nama_barang='$items[name]'"); ?>
                <?php foreach ($query->result() as $row):?>
                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

        		<td align="center"><?php echo $no; ?></td>
                <td align="center"><?php echo $items['id']; ?></td>
                <td align="center"><?php echo $items['name']; ?></td>
                <td align="center">
                    <input type="number" name="<?php echo $i.'[qty]'?>" value="<?php echo number_format($items['qty']);?>" min="1" max="<?php echo $row->stok ?>" style="width: 50px">
                </td>
                <td align="center">Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                <td align="center">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                <td style="display: none"><input type="text" name="key_barang" value="<?php echo $row->key_barang ?>" readonly></td>
                <td align="center">
                    <a href="Siswaui/hapus_cart/<?php echo $items['rowid'] ?>" class="btn btn-warning btn-sm">X</a>
                </td>

        	</tr>
            </form>
        	<?php $i++; $no++;?>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <tr>
        		<th colspan="5">Total Harga</th>
        		<th colspan="2">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></th>
        	</tr>
        </table>
        <input type="hidden" name="nis" value="<?php echo $this->session->userdata('nis') ?>" readonly>
        <div class="form-group col-md-4">
        	<input type="hidden" name="total_harga" value="<?php echo $this->cart->total() ?>" readonly>
        	<input type="hidden" name="tgl_penjualan" value="<?php echo date('Y-m-d H:i:s') ?>" readonly>
            <input type="hidden" name="kode_pembelian" id="kode_pembelian" value="<?php echo $kodeurut; ?>" readonly/>
            <input type="submit" name="bayar" onclick="return alert_setuju()" class="btn btn-primary" value="Bayar">
            <input style="color: #fff;cursor: pointer;" type="submit" class="btn btn-warning" name="update" value="Update">
        </div>
	</form>
	</div>
</div>

<script type="text/javascript">
    function alert_setuju(){
        return confirm('Are you sure?');
    }
</script>