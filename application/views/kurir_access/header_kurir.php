<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
         <h3 class="h4" style="margin-top: 8px"><?php echo $jdl; ?></h3>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <div id="nums_coun" style="margin-top: -18px">
                  
                </div>
              </a>
              <!-- Dropdown - Alerts -->
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Order
                </h6>
                <?php  ?>
                <div id="order_notif"></div>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <?php 
                  $nis = $this->session->userdata('nis');
                  $sql = $this->db->query("SELECT * FROM pesan where to_nis='$nis' and baca='belum'");
                  if ($sql->num_rows() > 0) {
                 ?>
                <span class="badge badge-danger badge-counter">
                  <?php 
                          $nis = $this->session->userdata('nis');
                          $sql = $this->db->query("SELECT * FROM pesan where to_nis='$nis' and baca='belum'");
                          echo $sql->num_rows();
                         ?>
                </span>
              <?php }else{ ?>
                  
              <?php } ?>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                
                <?php 
                    include 'Kurirui.php';

                    $nis = $this->session->userdata('nis');
                    $sql = $this->db->query("SELECT * from pesan where to_nis='$nis_kurir' and baca='belum' ORDER BY id_pesan DESC LIMIT 3");
                    foreach ($sql->result() as $rw) {
                      ?>
                      <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('Kurirui/pesan_read/'.$rw->id_pesan) ?>">
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
                <a class="dropdown-item text-center small text-gray-500" href="Kurirui/box_pesan">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('nama_kurir') ?></span>
                <?php 
                  $id_kurir = $this->session->userdata("id_kurir");
                  $nis_kurir = $this->session->userdata("nis_kurir");
                  $sql = $this->db->query("SELECT * FROM kurir WHERE id_kurir='$id_kurir' and nis_kurir='$nis_kurir'")->row(); 
                ?>
                <img class="img-profile rounded-circle" src="image/kurir/<?php echo $sql->foto_kurir ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="Kurirui/profile_saya">
                  <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile Setting
                </a>
                <a class="dropdown-item" href="Kurirui/ubahpassword_siswa">
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