<style type="text/css">
  @media only screen and (max-width: 500px) {
     .carousel .carousel-inner .carousel-item img.item{
        height: 280px;
    }
  }
  @media only screen and (max-width: 300px) {
     .carousel .carousel-inner .carousel-item img.item{
        height: auto;
    }
  }
  @media (max-width: 360px){
    #list-tab .list-group-item {
      padding: .50rem .75rem;
    }
  }
</style>
<?php 
  $img = $this->db->query("SELECT * FROM rekomendasi WHERE active='1'");
  if ($img->num_rows() > 0) {
 ?>
<div id="carouselIndicators" class="carousel slide" data-ride="carousel" style="margin-top: -1.5rem">
  <ol class="carousel-indicators">
    <?php 
        $query = $this->db->query("SELECT * FROM rekomendasi WHERE active='1' LIMIT 4");
        $num = $query->num_rows() - 1;
        for ($i=0; $i <= $num ; $i++) { 

     ?>
    <li data-target="#carouselIndicators" data-slide-to="<?php echo $i ?>" class="awal"></li>
  <?php } ?>
  </ol>
  <div class="carousel-inner">
    <?php 
      $query = $this->db->query("SELECT * FROM rekomendasi WHERE active='0' LIMIT 4");
      foreach ($query->result() as $row){
        if ($row->tgl_awal_rekom == date('Y-m-d')) {
          $data = array(
            'active' => '1',
          );
          $this->db->where('id_produk', $row->id_produk);
          $this->db->update('rekomendasi', $data);
        }
      }
     ?>
    <?php 
      $query = $this->db->query("SELECT * FROM rekomendasi WHERE active='1'");

      foreach ($query->result() as $row){
        if ($row->tgl_akhir_rekom == date('Y-m-d') || $row->tgl_akhir_rekom < date('Y-m-d')) {
          $data = array(
            'active' => '0',
          );
          $this->db->where('id_produk', $row->id_produk);
          $this->db->update('rekomendasi', $data);
        }
        $sql = $this->db->query("SELECT * FROM barang WHERE kode_barang='$row->kode_produk'")->row();
    ?>
    <div class="carousel-item">

      <a href="<?php echo site_url('Siswaui/detail_produk/'.$sql->id_barang); ?>"><img class="d-block w-100 item" src="image/all/<?php echo $row->foto ?>"></a>
      <!-- <div class="carousel-caption d-md-block">
        <h2>Hello world</h2>
        <p>...</p>
      </div> -->
    </div>
  <?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php 
  }else{

  }
?>

<div class="container mt-2 position-relative">
  <h5 class="text-center">Kategori</h5>
  <div class="row justify-content-center mt-3">
    <div class="list-group d-inline" id="list-tab" role="tablist" style="z-index: 1">
      <a class="list-group-item d-inline list-group-item-action active rounded" style="font-size: 11px" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Semua</a>
      <a class="list-group-item d-inline list-group-item-action rounded" style="font-size: 11px" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Makanan</a>
      <a class="list-group-item d-inline list-group-item-action rounded" id="list-messages-list" style="font-size: 11px" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Minuman</a>
      <a class="list-group-item d-inline list-group-item-action rounded" id="list-settings-list" style="font-size: 11px" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Barang</a>
  </div>
  <div class="col-12 mt-4">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <?php 
          $brg = $this->db->query("SELECT * FROM barang ORDER BY RAND()");
          foreach ($brg->result() as $td) {
         ?>
         <?php if ($td->stok > 0){ ?>
        <div class="card w-100 mb-3">
          <div class="card-body">
            <img src="image/barang_view/<?php echo $td->foto_barang ?>" class="img-fluid" style="width: 90px;height: 90px;">
            <h6 class="d-inline position-relative" style="top: -30px;">
              <a href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="color: inherit;"><?php echo $td->nama_barang ?></a>
            </h6>
            <p class="position-absolute" style="left: 115px;top:45px;font-size: 14px;">
            Stok : <?php echo $td->stok; ?>
          </p>
          <p class="position-absolute" style="left: 115px;font-size: 14.5px;top: 70px">
            IDR <?php echo number_format($td->harga_jual); ?>
          </p>
          <span style="position: absolute;right: 15px;font-size:13px;color: #EAB236;top: 22px">
            <?php 
              $query_like = $this->db->query("SELECT * FROM like_produk where kode_barang='$td->kode_barang'");
              if ($query_like->num_rows() >= 100) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 80) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-half-empty"></i>
           <?php }elseif ($query_like->num_rows() >= 55) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 30) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 10) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 1){?>
             <i class="fa fa-star"></i>
           <?php }else{} ?>
          </span>
          <a class="btn position-absolute btn-primary" href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="right: 10px;top: 80px;">
            Detail
          </a>
          </div>
        </div>
      <?php }} ?>
      </div>

      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
        <?php 
          $brg = $this->db->query("SELECT * FROM barang WHERE kategori='makanan' ORDER BY RAND()");
          foreach ($brg->result() as $td) {
         ?>
         <?php if ($td->stok > 0){ ?>
        <div class="card w-100 mb-3">
          <div class="card-body">
            <img src="image/barang_view/<?php echo $td->foto_barang ?>" class="img-fluid" style="width: 90px;height: 90px;">
            <h6 class="d-inline position-relative" style="top: -30px;">
              <a href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="color: inherit;"><?php echo $td->nama_barang ?></a>
            </h6>
            <p class="position-absolute" style="left: 115px;top:45px;font-size: 14px;">
            Stok : <?php echo $td->stok; ?>
          </p>
          <p class="position-absolute" style="left: 115px;font-size: 14.5px;top: 70px">
            IDR <?php echo number_format($td->harga_jual); ?>
          </p>
          <span style="position: absolute;right: 15px;font-size:13px;color: #EAB236;top: 22px">
            <?php 
              $query_like = $this->db->query("SELECT * FROM like_produk where kode_barang='$td->kode_barang'");
              if ($query_like->num_rows() >= 100) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 80) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-half-empty"></i>
           <?php }elseif ($query_like->num_rows() >= 55) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 30) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 10) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 1){?>
             <i class="fa fa-star"></i>
           <?php }else{} ?>
          </span>
          <a class="btn position-absolute btn-primary" href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="right: 10px;top: 80px;">
            Detail
          </a>
          </div>
        </div>
      <?php }} ?>
      </div>

      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
        <?php 
          $brg = $this->db->query("SELECT * FROM barang WHERE kategori='minuman' ORDER BY RAND()");
          foreach ($brg->result() as $td) {
         ?>
         <?php if ($td->stok > 0){ ?>
        <div class="card w-100 mb-3">
          <div class="card-body">
            <img src="image/barang_view/<?php echo $td->foto_barang ?>" class="img-fluid" style="width: 90px;height: 90px;">
            <h6 class="d-inline position-relative" style="top: -30px;">
              <a href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="color: inherit;"><?php echo $td->nama_barang ?></a>
            </h6>
            <p class="position-absolute" style="left: 115px;top:45px;font-size: 14px;">
            Stok : <?php echo $td->stok; ?>
          </p>
          <p class="position-absolute" style="left: 115px;font-size: 14.5px;top: 70px">
            IDR <?php echo number_format($td->harga_jual); ?>
          </p>
          <span style="position: absolute;right: 15px;font-size:13px;color: #EAB236;top: 22px">
            <?php 
              $query_like = $this->db->query("SELECT * FROM like_produk where kode_barang='$td->kode_barang'");
              if ($query_like->num_rows() >= 100) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 80) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-half-empty"></i>
           <?php }elseif ($query_like->num_rows() >= 55) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 30) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 10) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 1){?>
             <i class="fa fa-star"></i>
           <?php }else{} ?>
          </span>
          <a class="btn position-absolute btn-primary" href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="right: 10px;top: 80px;">
            Detail
          </a>
          </div>
        </div>
      <?php }} ?>
      </div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <?php 
          $brg = $this->db->query("SELECT * FROM barang WHERE kategori='barang' ORDER BY RAND()");
          foreach ($brg->result() as $td) {
         ?>
         <?php if ($td->stok > 0){ ?>
        <div class="card w-100 mb-3">
          <div class="card-body">
            <img src="image/barang_view/<?php echo $td->foto_barang ?>" class="img-fluid" style="width: 90px;height: 90px;">
            <h6 class="d-inline position-relative" style="top: -30px;">
              <a href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="color: inherit;"><?php echo $td->nama_barang ?></a>
            </h6>
            <p class="position-absolute" style="left: 115px;top:45px;font-size: 14px;">
            Stok : <?php echo $td->stok; ?>
          </p>
          <p class="position-absolute" style="left: 115px;font-size: 14.5px;top: 70px">
            IDR <?php echo number_format($td->harga_jual); ?>
          </p>
          <span style="position: absolute;right: 15px;font-size:13px;color: #EAB236;top: 22px">
            <?php 
              $query_like = $this->db->query("SELECT * FROM like_produk where kode_barang='$td->kode_barang'");
              if ($query_like->num_rows() >= 100) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 80) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-half-empty"></i>
           <?php }elseif ($query_like->num_rows() >= 55) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
           <?php }elseif ($query_like->num_rows() >= 30) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 10) {?>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
         <?php }elseif ($query_like->num_rows() >= 1){?>
             <i class="fa fa-star"></i>
           <?php }else{} ?>
          </span>
          <a class="btn position-absolute btn-primary" href="<?php echo site_url('Siswaui/detail_produk/'.$td->id_barang) ?>" style="right: 10px;top: 80px;">
            Detail
          </a>
          </div>
        </div>
      <?php }} ?>
      </div>
    </div>
  </div>
</div>
</div>