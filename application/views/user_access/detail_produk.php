<style>
	.sticky-footer{
		position: absolute;
		bottom: 0;
	}
	body{
		overflow: hidden;
	}
	.sticky-kr{
		animation: kr 0.8s;
		bottom: 30px;
	}
	@keyframes kr{
		0% {
			bottom: -70px;
		}
		100%{
			bottom: 30px;
		}
	}
</style>
<div class="container">
	<?php echo $this->session->flashdata('message_like') ?>
	<?php echo $this->session->flashdata('message_cart') ?>
	<div class="row">
		<div class="col-md-4" style="height: 170px">
			<img src="image/barang_view/<?php echo $foto_barang ?>" class="img-fluid d-inline" style="width: 150px;height: 150px">
			<h5 class="position-relative" style="top: -155px;left: 160px"><?php echo $nama_barang; ?></h5>
			<?php $row = $this->db->query("SELECT * FROM kantin WHERE kode_kantin='$key_barang'")->row(); ?>
			<p class="position-relative" style="left: 160px;top: -160px;margin: 0px;">Tempat : <?php echo anchor(site_url('Siswaui/detail_kantin/'.$row->id_kantin),$row->nama_kantin,'style="color:inherit;text-decoration:none;"'); ?></p>
			<p class="position-relative" style="left: 160px;top: -160px;margin: 0px">Stok : <?php echo $stok; ?></p>
			<p class="position-relative" style="left: 160px;top: -160px;margin: 0px">Kategori : <?php echo $kategori; ?></p>
			<p class="position-relative" style="left: 160px;top: -160px;margin: 0px;">IDR : <?php echo number_format($harga_jual);?></p>
			<?php 
				$nis = $this->session->userdata('nis');
				$query = $this->db->query("SELECT * FROM like_produk where nis='$nis' and kode_barang='$kode_barang'");
				if ($query->num_rows() > 0) {?>
					<a href="<?php echo site_url('Siswaui/like_produk/'.$id_barang) ?>" class="d-inline position-absolute" style="left: 175px;top: 120px;font-size: 20px;"><i class="fa fa-thumbs-up"></i></a>
				<?php }else{?>
					<a href="<?php echo site_url('Siswaui/like_produk/'.$id_barang) ?>" class="d-inline position-absolute" style="left: 175px;top: 120px;font-size: 20px;color: inherit;"><i class="fa fa-thumbs-up"></i></a>
				<?php } ?>
		</div>
	</div>
		<!-- <a href="javascript:history.go(-1)" class="btn btn-secondary mt-3"><i class="fa fa-angle-left"></i></a>
		<a href="" class="btn btn-primary mt-3">Order</a> -->
</div>
	<div class="col-xl-11 sticky-kr" style="z-index: 2;position: fixed;">
		<span class="bg-gradient-primary w-100" style="height: 50px;display: block;padding: 10px;text-align: center;border-radius: 5px;">
			<a href="<?php echo site_url('Siswaui/order_psn/'.$kode_barang) ?>" style="color: #fff;text-decoration: none;font-weight: bold;font-size: 19px">Masukkan Keranjang</a>
		</span>
		<span class="bg-secondary" style="width: 50px;height: 50px;display: block;z-index: 3;border-radius: 5px 0 0 5px;position: absolute;top: 0">
			<a href="javascript:history.back()" class="fa fa-angle-left" style="font-size: 39px;margin: 6px 13px;color: #fff;text-decoration: none"></a>
		</span>
	</div>