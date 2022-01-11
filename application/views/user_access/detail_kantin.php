<style type="text/css">
  @media only screen and (max-width: 500px) {
     .img-kantin{
        height: 280px;
    }
  }
  @media only screen and (max-width: 300px) {
     .img-kantin{
        height: auto;
    }
  }
  .scroll-to-top {
  	z-index: 3;
  	right: 0;
  	margin-right: 20px;
  }
</style>
<div style="margin-top: -1.5rem">
	<a href="Siswaui/cari_kantin" class="fa fa-angle-left" style="top: 75px;margin-left: 10px;color: #000000b8;font-size: 35px;text-decoration: none;position: absolute;"></a>
	<img src="image/kantin/<?php echo $foto_kantin ?>" class="w-100 img-kantin">
	<h3 class="position-absolute" style="color: #000000b8;font-weight: bold;margin-left:20px;margin-top: -80px;display: block"><?php echo $nama_kantin ?></h3>
	<div class="rating position-absolute" style="margin-left: 20px;margin-top: -40px;">
		<i class="fa fa-star" style="font-size: 19px;color: #EAB236"></i>
		<i class="fa fa-star" style="font-size: 19px;color: #EAB236"></i>
		<i class="fa fa-star" style="font-size: 19px;color: #EAB236"></i>
		<i class="fa fa-star" style="font-size: 19px;color: #EAB236"></i>
		<i class="fa fa-star" style="font-size: 19px;color: #EAB236"></i>
		<!-- <i style="font-size: 19px;color: #000000b8;font-weight: bold;">5 / 5</i> -->
	</div>
	<div class="col-xl-11" style="bottom: 0.8rem;z-index: 2;position: fixed;">
		<span class="bg-gradient-primary w-100" style="height: 50px;display: block;padding: 10px;text-align: center;border-radius: 5px">
			<a href="Siswaui/keranjang_order" style="color: #fff;font-weight: bold;text-decoration: none">Total Keranjang : <?php echo $this->cart->total_items() ?></a>
		</span>
	</div>
	<form action="" class="form-inline" method="GET">
		<input type="text" name="q" placeholder="Cari di <?php echo $nama_kantin ?>" class="ck" 
		style="
		padding: 10px;
		width: 100%;
		outline-color: none;
		outline: none;
		border: none;
		border: 1px solid #eee;
		margin-top: 1px;
		box-shadow: 1px 1px 1px 1px #eee">
		<i class="fa fa-times clear" style="border: none;border-color: #fff;background-color: inherit;position: absolute;right: 34px;margin-top: 2px;outline: none;font-size: 18px;cursor: pointer;display: none;"></i>
	</form>

	<?php 
		$query = urldecode($this->input->get('q'));
		if ($query) {
			$q = urlencode($query);
			$row = $this->db->query("SELECT * FROM barang WHERE key_barang='$kode_kantin' and nama_barang LIKE '%$q%'");
			if ($row->num_rows() > 0){
			foreach ($row->result() as $td) {
	?>
		<div class="card w-100 mt-2" style="border-radius: 0">
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
    <?php } ?>
    <?php }else{echo '<h5 class="text-center mt-2">Pencarian tidak tersedia</h5>';} ?>
	<?php }else{ ?>

	<!-- Makanan -->
	<h5 style="margin: 10px">Makanan<i class="fa fa-angle-up" id="rot_angle_makanan" onclick="menu_makanan()" style="margin-left: 13px;position: absolute;margin-top: 5px;"></i></h5>
	<div id="menu_makanan" style="-webkit-animation: fadeIn 0.8s linear;animation: fadeIn 0.8s linear;">
	<?php 
		$row = $this->db->query("SELECT * FROM barang where key_barang='$kode_kantin' and kategori='makanan'");
		if ($row->num_rows() > 0) {
		foreach ($row->result() as $td) {
	?>
	<div class="card w-100 mb-1" style="border-radius: 0">
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
    <?php } ?>
	<?php }else{ ?>
		<h5 class="text-center">Menu tidak tersedia.</h5>
	<?php } ?>
	</div>

	<!-- Minuman -->
	<h5 style="margin: 10px">Minuman<i class="fa fa-angle-up" id="rot_angle_minuman" onclick="menu_minuman()" style="margin-left: 10.5px;position: absolute;margin-top: 5px;"></i></h5>
	<div id="menu_minuman" style="-webkit-animation: fadeIn 0.8s linear;animation: fadeIn 0.8s linear;">
	<?php 
		$row = $this->db->query("SELECT * FROM barang where key_barang='$kode_kantin' and kategori='minuman'");
		if ($row->num_rows() > 0) {
		foreach ($row->result() as $td) {
	?>
	<div class="card w-100 mb-1" style="border-radius: 0">
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
    <?php } ?>
	<?php }else{ ?>
		<h5 class="text-center">Menu tidak tersedia.</h5>
	<?php } ?>
	</div>

	<!-- Barang -->
	<h5 style="margin: 10px">Barang<i class="fa fa-angle-up" id="rot_angle_barang" onclick="menu_barang()" style="margin-left: 28px;position: absolute;margin-top: 5px;"></i></h5>
	<div id="menu_barang" style="-webkit-animation: fadeIn 0.8s linear;animation: fadeIn 0.8s linear;">
	<?php 
		$row = $this->db->query("SELECT * FROM barang where key_barang='$kode_kantin' and kategori='barang'");
		if ($row->num_rows() > 0) {
		foreach ($row->result() as $td) {
	?>
	<div class="card w-100 mb-1" style="border-radius: 0">
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
    <?php } ?>
	<?php }else{ ?>
		<h5 class="text-center">Menu tidak tersedia.</h5>
	<?php } ?>
	</div>
<?php } ?>
</div>
















<script type="text/javascript">
function menu_makanan(){
	var rot = document.getElementById('rot_angle_makanan');
	var menu = document.getElementById('menu_makanan');
	if (menu.style.display === "block") {
    menu.style.display = "none";
    rot.style.transform = "rotate(180deg)";
  	} else {
   	menu.style.display = "block";
    rot.style.transform = "rotate(0deg)";
  	}
}
function menu_minuman(){
	var rot = document.getElementById('rot_angle_minuman');
	var menu = document.getElementById('menu_minuman');
	if (menu.style.display === "block") {
    menu.style.display = "none";
    rot.style.transform = "rotate(180deg)";
  	} else {
   	menu.style.display = "block";
    rot.style.transform = "rotate(0deg)";
  	}
}
function menu_barang(){
	var rot = document.getElementById('rot_angle_barang');
	var menu = document.getElementById('menu_barang');
	if (menu.style.display === "block") {
    menu.style.display = "none";
    rot.style.transform = "rotate(180deg)";
  	} else {
   	menu.style.display = "block";
    rot.style.transform = "rotate(0deg)";
  	}
}
</script>