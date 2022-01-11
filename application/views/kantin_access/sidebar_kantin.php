 <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar" style="transition: .4s;">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Kantinui">
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
        <a class="nav-link" href="Kantinui">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="Kantinui/data_kantin">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Kantin</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages3">
          <i class="fas fa-fw fa-suitcase"></i>
          <span>Tabungan Kantin</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="z-index: 2">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu</h6>
            <a class="collapse-item" href="Kantinui/saldo_kantin">Tabungan</a>
            <a class="collapse-item" href="Kantinui/data_penarikan_saldo">Data Penarikan Saldo</a>
          </div>
        </div>
      </li>
      
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="Kantinui/data_barang">
          <i class="fas fa-fw fa-box"></i>
          <span>Data Barang</span>
        </a>
      </li>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="Kantinui/data_barang">
          <i class="fas fa-qrcode"></i>
          <span>Pembelian</span>
        </a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
          <i class="fas fa-fw fa-columns"></i>
          <span>Rekomendasi</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="z-index: 2">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu</h6>
            <a class="collapse-item" href="Kantinui/list_rekom_kantin">Data Rekomendasi Kantin</a>
            <a class="collapse-item" href="Kantinui/create_rekom">Kirim Rekomendasi</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
          <i class="fas fa-fw fa-exchange-alt"></i>
          <span>Data Penjualan</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="z-index: 2">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Penjualan</h6>
            <a class="collapse-item" href="Kantinui/all_data_penjualan">Semua</a>
            <a class="collapse-item" href="Kantinui/perbulan_data_penjualan">Perbulan</a>
            <a class="collapse-item" href="Kantinui/pertanggal_data_penjualan">Pertanggal</a>
            <h6 class="collapse-header">Stok Yang Terjual</h6>
            <a class="collapse-item" href="Kantinui/all_data_penjualan_stok">Semua</a>
            <a class="collapse-item" href="Kantinui/perbulan_data_penjualan_stok">Perbulan</a>
            <a class="collapse-item" href="Kantinui/pertanggal_data_penjualan_stok">Pertanggal</a>
            <h6 class="collapse-header">Laba</h6>
            <a class="collapse-item" href="Kantinui/perbulan_data_laba">Perbulan</a>
            <a class="collapse-item" href="Kantinui/pertanggal_data_laba">Pertanggal</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Kantinui/support_app" style="cursor: pointer;">
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