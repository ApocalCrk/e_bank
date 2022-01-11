 <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="transition: .4s;">

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
        <a class="nav-link" id="sc" style="cursor: pointer">
          <i class="fas fa-qrcode"></i>
          <span>Scan Qrcode</span>
        </a>
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
            <a class="collapse-item" href="Siswaui/cari_kantin">Cari Kantin</a>
            <a class="collapse-item" href="">Order</a>
            <!-- <a class="collapse-item" href="Siswaui/tambah_transaksi">Cart</a> -->
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