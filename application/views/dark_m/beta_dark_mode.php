<?php date_default_timezone_set('Asia/Jakarta');  ?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	  <base href="<?php echo base_url() ?>">
	<title>eS-Pay - Siswa</title>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Custom fonts for this template-->
  <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <script src="assets/js/sweetalert2.min.js"></script>


 
</head>
<body class="page-top sidebar-toggled">
	<!-- end header -->
  <?php echo $this->session->flashdata('message'); ?>
	 <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <style type="text/css">
      .bg-gradient-dark-m{
        background-color: #293145 !important;

      }
    </style>
    <ul class="navbar-nav bg-gradient-dark-m sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="transition: .4s;border-right: 1px solid rgba(255,255,255,0.05);">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Siswaui">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <i class="fas fa-wallet"></i>
        </div>
        <div class="sidebar-brand-text mx-3">eS-Pay</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="Siswaui">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="Siswaui/data_siswa">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Saya</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
          <i class="fas fa-fw fa-suitcase"></i>
          <span>Tabungan Saya</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="z-index: 2">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu</h6>
            <a class="collapse-item" href="Siswaui/saldo_saya">Tabungan</a>
            <a class="collapse-item" href="Siswaui/data_penarikan_saldo">Data Penarikan Saldo</a>
          </div>
        </div> 
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-exchange-alt"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="z-index: 2">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu</h6>
            <a class="collapse-item" href="Siswaui/produk">Rekomendasi</a>
            <a class="collapse-item" href="Siswaui/cari_barang">Cari Stok</a>
            <a class="collapse-item" id="sc" style="cursor: pointer;">Scan Qrcode</a>
            <a class="collapse-item" href="Siswaui/tambah_transaksi">Cart</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePagespengeluaran" aria-expanded="true" aria-controls="collapsePagespengeluaran">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Pengeluaran</span>
        </a>
          <div id="collapsePagespengeluaran" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="z-index: 2">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Menu</h6>
              <a class="collapse-item" href="Siswaui/pengeluaran_siswa">Pengeluaran</a>
              <a class="collapse-item" href="Siswaui/pengeluaran_perbulan_siswa">Perbulan</a>
              <a class="collapse-item" href="Siswaui/pengeluaran_perhari_siswa">Pertanggal</a>
            </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Siswaui/support_app">
          <i class="fas fa-fw fa-headset"></i>
          <span>Support</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>


            <form action="Siswaui/simpan_cart" id="scan-qr" method="POST" style="margin-top: 60%;display: none;">
      <input type="hidden" name="qrcode_text" id="qrcode_text">
      <label class="qrcode-text-btn btn btn-primary" id="qrcode-text-btn" style="cursor: pointer;">
      Scan QRCode
            <input id="scan" type="file" accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" style="display: none;">
          </label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="submit" value="Submit" class="btn-primary btn align-center" id="submit" style="display: none;">
    </form>


    <script type="text/javascript">
      function alertbeta(){
        Swal.fire({
          type: 'warning',
          title: 'Oops...',
          text: 'Aplikasi masih dalam tahap beta, menu belum tersedia.',
          timer: 2000,
          showConfirmButton: false
        })
      }
    </script>
	<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="background: #293145">
	<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background: #293145;border-bottom: 1px solid rgba(255,255,255,0.05);">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
         <h3 class="h4 text-white" style="margin-top: 8px">Pengaturan Web</h3>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->

            <!-- Nav Item - Alerts -->
            <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i> -->
                <!-- Counter - Alerts -->
                <!-- <span class="badge badge-danger badge-counter"></span>
              </a> -->
              <!-- Dropdown - Alerts -->
             <!--  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> -->

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <?php 
                  $nis = $this->session->userdata(nis);
                  $sql = $this->db->query("SELECT * FROM pesan where to_nis='$nis' and baca='belum'");
                  if ($sql->num_rows() > 0) {
                 ?>
                <span class="badge badge-danger badge-counter">
                  <?php 
                          $nis = $this->session->userdata(nis);
                          $sql = $this->db->query("SELECT * FROM pesan where to_nis='$nis' and baca='belum'");
                          echo $sql->num_rows();
                         ?>
                </span>
              <?php }else{ ?>
                  
              <?php } ?>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header" style="background-color: #4f5155;border-color: #4f5155">
                  Message Center
                </h6>
                
                <?php 
                    include 'Siswaui.php';

                    $nis = $this->session->userdata(nis);
                    $sql = $this->db->query("SELECT * from pesan where to_nis='$nis' and baca='belum' ORDER BY id_pesan DESC LIMIT 3");
                    foreach ($sql->result() as $rw) {
                      ?>
                      <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('Siswaui/pesan_read/'.$rw->id_pesan) ?>">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?php echo base_url('image/user/default.png') ?>" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate"><?php echo $rw->subjek_pesan ?></div>
                    <div class="small text-gray-500"><?php echo $rw->pengirim ?> · <?php echo $rw->tanggal ?></div>
                  </div>
                </a>
                    <?php }?>
                <a class="dropdown-item text-center small text-gray-500" href="Siswaui/box_pesan">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small"><?php echo $this->session->userdata('nama_siswa') ?></span>
                <?php 
                  $id_siswa = $this->session->userdata("id_siswa");
                  $nis = $this->session->userdata("nis");
                  $sql = $this->db->query("SELECT * FROM user WHERE id_siswa='$id_siswa' and nis='$nis'")->row(); 
                ?>
                <img class="img-profile rounded-circle" src="image/siswa/<?php echo $sql->foto ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="Siswaui/profile_saya">
                  <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile Setting
                </a>
                <a class="dropdown-item" href="Siswaui/ubahpassword_siswa">
                  <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>

	 <style type="text/css">
      .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
    .blink {
      animation: blinker 1.5s linear infinite;
    }
    @keyframes blinker {  
      50% { opacity: 0; }
    }
    </style>
    <div class="d-flex justify-content-center">
      <table class="table" style="width: 90%">
      <tr>
        <td class="text-white" style="border-top: 1px solid rgba(255,255,255,0.15)">Dark Mode&nbsp;&nbsp;<span class="badge badge-danger badge-counter"><i class="blink">Beta!</i></span>
          <label class="switch" style="float: right;">
              <input type="checkbox" id="dark" onclick="dark_mode()" checked="true">
              <span class="slider round"></span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="text-center text-white" style="border-top: 1px solid rgba(255,255,255,0.15)">Coming Soon!</td>
      </tr>
    </table>
    </div>

    <script type="text/javascript">
      function dark_mode(){
        var cek = document.getElementById("dark");
        if (cek.checked == false) {
          location.href = "Siswaui/pengaturan_web";
        }else{

        }
      }
    </script>

	<!-- end content -->
	<footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto text-white">
            <span>Copyright&copy; eS-Pay <?php echo Date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <style type="text/css">
    html {
      scroll-behavior: smooth;
    }
  </style>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" onclick="scrollToTop()" style="color: #fff">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="Siswaui/logoutsiswa">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Message</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
          <img class="rounded-circle" src="<?php echo base_url('image/user/default.png') ?>" alt="" style="width: 50px;"> <?php echo $rw->pengirim ?><br><hr>
          <h4><?php echo $rw->subjek_pesan ?></h4>
        <?php echo $rw->isi_pesan ?>
      </div>
         
        </div>
      </div>
    </div>
  </div> -->
</div></div>



   <!-- Bootstrap core JavaScript-->

	 <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/qr.js"></script>
  <script src="assets/js/qrcode.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/js/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap4.min.js"></script>

<!-- table histori penggunaan -->
<script type="text/javascript">
  $(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>

<!-- smooth scroll -->
<script type="text/javascript">
  function scrollToTop() { 
            $(window).scrollTop(0); 
        } 
</script>

<!-- carousel php -->
<script type="text/javascript">
  $(document).ready(function () {
  $('#carouselIndicators').find('.carousel-item').first().addClass('active');
});
</script>

<script type="text/javascript">
  $(document).ready(function () {
  $('#carouselIndicators').find('.awal').first().addClass('active');
});
</script>

<script type="text/javascript">
  $('#sc').click(function(){
    $('#qrcode-text-btn').click();
  });
</script>

<script type="text/javascript">
  $('#sc2').click(function(){
    $('#qrcode-text-btn').click();
  });
</script>

</body>
</html>