<style type="text/css">
  .qtyplus, .qtyminus {
    width: 30px;
    height: 30px;
    background-color: #e0e0e0;
    cursor: pointer;
    padding-left: 5px;
    border-radius: 5px;
    margin-left: 5px;
    margin-right: 5px;
    border: none;
    outline: none;
  }
  #qty {
    border-radius: 5px;
  }
</style>
<?php 
  $nis = $this->session->userdata('nis');
  $cek_order = $this->db->query("SELECT * FROM user WHERE nis='$nis'")->row();
  $cek_nama = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$cek_order->last_order' and status!='Transaksi Selesai' and status!='Kurir Menolak'")->row();
  if ($cek_nama) {
    $this->session->set_flashdata('message_transaksi',
      '<script>
        Swal.fire({
          type: "warning",
          text: "Anda harus menyelesaikan tansaksi terlebih dahulu!",
          showConfirmButton: false,
          timer: 1000,
          });
      </script>'
      );
    ?>
    <script type="text/javascript">
        window.location="<?php echo base_url() ?>Siswaui/cari_kurir";
      </script>
  <?php }else{?>
<form style="margin-top: -1.4rem" method="post" action="Siswaui/order_pesanan">
  <?php echo $this->session->flashdata('message_tujuan') ?>
  <?php echo $this->session->flashdata('message_tolak') ?>
  <?php echo $this->session->flashdata('message_tabungan') ?>
<?php 
  $items = array();
  $i = 1;
  foreach($this->cart->contents() as $item) {
   $sql = $this->db->query("SELECT * FROM barang WHERE kode_barang='$item[id]'")->row();
   $kantin = $this->db->query("SELECT * FROM kantin WHERE kode_kantin='$sql->key_barang'")->row();
   $items[] = $i++.'. '.$item['name'].' Jumlah '.$item['qty'].'<br>';
   $nama_kantin = $item['options']['nama_kantin'];
  }
?>
<input type="hidden" name="pesanan" value="<?php foreach($items as $i){echo $i;} ?>" readonly style="display: none">
<input type="hidden" name="nama_kantin" value="<?php echo $nama_kantin ?>" readonly style="display: none">
<?php 
  $i = 1;
  $no = 1;
  if ($this->cart->total_items() > 0){
  foreach ($this->cart->contents() as $items) {
    $query = $this->db->query("SELECT * FROM barang where kode_barang='$items[id]'");
    foreach ($query->result() as $row){
    echo form_hidden($i.'[rowid]', $items['rowid']);
?>
<div class="card w-100 mb-2" style="border-radius: 0;">
  <div class="card-body">
    <img src="image/barang_view/<?php echo $row->foto_barang ?>" class="img-fluid" style="width: 90px;height: 90px;">
        <h6 class="d-inline position-relative" style="top: -30px;">
          <a href="" style="color: inherit;"><?php echo $items['name'] ?></a>
        </h6>
        <p class="position-absolute" style="left: 115px;top:45px;font-size: 14px;">
            Stok : <?php echo $row->stok ?>
        </p>
        <p class="position-absolute" style="left: 115px;font-size: 14.5px;top: 65px">
           Harga : IDR <?php echo $this->cart->format_number($items['price']); ?>
        </p>
        <p class="position-absolute" style="left: 115px;font-size: 14.5px;top: 85px">
           Subtotal :  IDR <?php echo $this->cart->format_number($items['subtotal']); ?>
        </p>
        <div class="row position-absolute" style="right: 15px;top: 20px">
          <input type="submit" name="update" class="decreaseVal qtyminus" id="value-minus" onclick="down(<?php echo '1' ?>)" value='-'>
          <input type="text" name="<?php echo $i.'[qty]'?>" class="form-control" value="<?php echo number_format($items['qty']);?>" class="qty-set" min="1" max="<?php echo $row->stok ?>" id="<?php echo $i.'[qty]' ?>" style ="width: 45px;height: 30px" readonly>
          <input type="submit" name="update" class="increaseVal qtyplus" id="value-plus" onclick="up(<?php echo $row->stok ?>)" value='+'>
        </div>
        <a href="Siswaui/hapus_cart/<?php echo $items['rowid'] ?>" class="btn btn-danger btn-sm" style="position: absolute;top: 60px;right: 35px">Hapus</a>
  </div>
</div>
<?php $i++; $no++;?>
<?php 
  } 
}?>
<div class="col">
  <label>Lainnya
    <?php if ($tujuan != '' or $tn != '') {?>
    <p style="font-size: 12px;color:#fff;text-align: center;border-radius: 7px;background-color: #4e73df;position: absolute;left: 70px;top: 0;width: auto;height: auto;padding: 2px 5px">
      <?php 
        if (
          $tujuan != 'TKR 1'  
          and $tujuan != 'TKR 2'  
          and $tujuan != 'TKR Praktek'  
          and $tujuan != 'TSM 1'  
          and $tujuan != 'TSM 2' 
          and $tujuan != 'TSM Praktek' 
          and $tujuan != 'Keperawatan 1' 
          and $tujuan != 'Keperawatan 2' 
          and $tujuan != 'Keperawatan Praktek' 
          and $tujuan != 'Akuntansi 1' 
          and $tujuan != 'Akuntansi 2'
          and $tujuan != 'Akuntansi Praktek'
          and $tn != 'TKR 1'  
          and $tn != 'TKR 2'  
          and $tn != 'TKR Praktek'  
          and $tn != 'TSM 1'  
          and $tn != 'TSM 2' 
          and $tn != 'TSM Praktek' 
          and $tn != 'Keperawatan 1' 
          and $tn != 'Keperawatan 2' 
          and $tn != 'Keperawatan Praktek' 
          and $tn != 'Akuntansi 1' 
          and $tn != 'Akuntansi 2'
          and $tn != 'Akuntansi Praktek'
         ) {
        $ongkir = 2000;
        if ($this->cart->total_items() >= 5) {
          echo 'Rp. '.number_format($ongkir+3000);
        }else{
          echo 'Rp. '.number_format($ongkir);
        }
      }else{
        $ongkir = 1000;
        if ($this->cart->total_items() >= 5) {
          echo 'Rp. '.number_format($ongkir+3000);
        } else {
          echo 'Rp. '.number_format($ongkir);
        }
      }
      ?>
    </p>
  </label>
  <?php }else{} ?>
  <?php if ($tujuan != '' or $tn != '') {?>
    <p style="font-size: 12px;color:#fff;text-align: center;border-radius: 7px;background-color: #4e73df;position: absolute;right: 40px;top: 0;width: auto;height: auto;padding: 2px 5px;">
    <?php if ($tujuan != '') {
      echo $tujuan;
    }else{
      echo $tn;
    } ?>
    </p>
  <input type="hidden" name="ongkir" value="<?php echo $ongkir ?>" style="display: none;position: absolute;">
  <input type="hidden" name="tujuan" value="<?php if ($tujuan != '') {echo $tujuan;}else{echo $tn;} ?>" style="display: none;position: absolute;">
  <textarea name="note" style="display: none"><?php echo $note ?></textarea>
  <?php }else{} ?>
  <input type="hidden" name="metode_pembayaran" value="<?php echo $metode_pembayaran ?>" style="display: none;position: absolute;">
  <a href="#" data-toggle="modal" data-target="#lainnyaModal" class="fa fa-ellipsis-v" style="transform: rotate(90deg);position: absolute;right: 20px"></a>
</div>
<div class="col-xl-11" style="bottom: 0.8rem;z-index: 2;position: fixed;">
    <span class="bg-gradient-primary w-100" style="height: 50px;display: block;padding-top: 13px;text-align: center;border-radius: 5px">
      <p style="color: #fff;font-weight: bold;text-decoration: none">Total: <?php echo 'Rp. '.$this->cart->format_number($this->cart->total()+$ongkir); ?></p>
      <span class="bg-gradient-warning w-25" style="position: absolute;top: 0;right: 12px;height: 50px;padding-top: 13px;border-radius: 0 5px 5px 0;z-index: 4">
        <button type="submit" name="checkout" style="color: #fff;font-weight: bold;text-decoration: none;border: none;background: none;outline: none;">Checkout</button>
      </span>
    </span>
</div>
<?php }else{?>

<div class="justify-content-center d-flex">
  <i class="fa fa-shopping-cart" style="font-size: 100px;margin-top: 80px;color: #4e73df"></i>
</div>
<div class="text-center" style="line-height: 15px">
  <h6 class="text-center mt-3">Keranjang anda masih kosong</h6>
  <br>
  <a href="Siswaui/produk" style="border: 1px solid #000;padding: 10px;color: inherit;text-decoration: none;border-radius: 4px">Belanja Sekarang</a>
</div>
<?php } ?>
</form>

<div class="modal fade" id="lainnyaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Lainnya</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post" action="Siswaui/Keranjang_order">
        <div class="modal-body">
          <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" style="position: absolute;right: 20px;top: 8px;" class="form-control w-50">
              <option value=""></option>
              <option value="COD">COD</option>
              <option value="eS-Pay Online">eS-Pay Online</option>
              <option value="eS-Pay Offline">eS-Pay Offline</option>
            </select>
            <br>
          <label>Tujuan</label>
            <select name="tujuan" style="position: absolute;right: 20px;top: 50px;" class="form-control w-50">
              <option value=""></option>
              <option value="RPL 1">RPL 1</option>
              <option value="RPL 2">RPL 2</option>
              <option value="MM Teori">MM Teori</option>
              <option value="MM Praktek">MM Praktek</option>
              <option value="TKJ 1">TKJ 1</option>
              <option value="TKJ 2">TKJ 2</option>
              <option value="TKR 1">TKR 1</option>
              <option value="TKR 2">TKR 2</option>
              <option value="TSM 1">TSM 1</option>
              <option value="TSM 2">TSM 2</option>
              <option value="Keperawatan 1">Keperawatan 1</option>
              <option value="Keperawatan 2">Keperawatan 2</option>
              <option value="Akuntansi 1">Akuntansi 1</option>
              <option value="Akuntansi 2">Akuntansi 2</option>
              <option value="">Other</option>
            </select>
            <input type="text" name="tn" class="form-control w-50" style="position: absolute;right: 20px;top: 10px;display: none">
            <br> 
            <label>Note</label>
            <textarea name="note" style="width: 100%" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
</div>
<?php } ?>