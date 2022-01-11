  <?php 
    $id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
    $sql = $this->db->query("SELECT * FROM order_pesanan WHERE nama_kurir='$id' and status!='Transaksi Selesai' and status!='Kurir Menolak' LIMIT 1");
    foreach ($sql->result() as $row) {
  ?>
    <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('Kurirui/read_orderan/'.$row->invoice_order) ?>">
      <div class="mr-3">
        <div class="icon-circle bg-primary">
          <i class="fas fa-sticky-note text-white"></i>
        </div>
      </div>
    <div>
    <div class="small text-gray-500"><?php echo $row->waktu ?></div>
        <span class="font-weight-bold">Anda Memiliki Orderan Baru</span>
    </div>
  </a>
<?php } ?>