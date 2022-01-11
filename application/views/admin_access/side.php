<style type="text/css">
	::-webkit-scrollbar {
	  width: 4px;

	}

	/* Track */
	::-webkit-scrollbar-track {
	  background: #f1f1f1;
	}

	/* Handle */
	::-webkit-scrollbar-thumb {
	  background: #888;
	  border-radius: 10px;
	}

	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
	  background: #555;

	}
</style>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="image/user/<?php echo $this->session->userdata('foto') ?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $this->session->userdata('nama') ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">

		<?php 
		if ($this->session->userdata('level') == 'admin') {

		 ?>
		 	 
			<li><a href="app.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="siswa"><em class="fa fa-user">&nbsp;</em> Data Pengguna</a></li>
			<li><a href="kurir"><em class="fa fa-user">&nbsp;</em> Data Kurir</a></li>
			<li><a href="barang"><em class="fa fa-cube">&nbsp;</em> Data Barang</a></li>
			<li class="parent"><a href="#sub-item-tabungan" data-toggle="collapse">
				<em class="fa fa-suitcase">&nbsp;</em>Tabungan<span data-toggle="collapse" href="#sub-item-tabungan" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-tabungan">
					<li><a class="" href="tabungan">
						<span class="fa fa-user">&nbsp;</span> Tabungan Siswa
					</a></li>
					<li><a class="" href="app/tabungan_kurir">
						<span class="fa fa-user">&nbsp;</span> Tabungan Kurir
					</a></li>
					<li><a class="" href="app/tabungan_kantin">
						<span class="fa fa-building">&nbsp;</span> Tabungan Kantin
					</a></li>
					<li><a class="" href="app/tarik_saldo">
						<span class="fa fa-credit-card">&nbsp;</span> Tarik Saldo
					</a></li>
					<li><a class="" href="app/data_penarikan_saldo">
						<span class="fa fa-credit-card">&nbsp;</span> Data Penarikan
					</a></li>
				</ul>
			</li>
			<li><a href="pesan"><em class="fa fa-envelope">&nbsp;</em> Pesan</a></li>
			<li><a href="Rekom"><em class="fa fa-columns">&nbsp;</em> Rekomendasi</a></li>
			<!-- <li><a href="app/penjualan"><em class="fa fa-cart-plus">&nbsp;</em> Transaksi</a></li> -->
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-building-o">&nbsp;</em> Lap Penjualan <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					
					<li><a class="" href="app/cetak_stok" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Stok Barang
					</a></li>
					<li><a class="" href="app/cetak_terjual" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Barang Terjual
					</a></li>
					<li><a class="" href="app/cetak_laba" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Laba
					</a></li>
					<li><a class="" href="app/cetak_transaksi" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Transaksi
					</a></li>
				</ul>
			</li> -->

			<li><a href="kantin"><em class="fa fa-building">&nbsp;</em> Manajemen Kantin</a></li>
			<li><a href="admin"><em class="fa fa-users">&nbsp;</em> Manajemen User</a></li>			
			<!-- <li><a href="app/web_setting"><em class="fa fa-cog">&nbsp;</em> Pengaturan Web</a></li>			 -->
			<li><a href="app/logoutadmin"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		<?php } ?>
		</ul>
	</div>