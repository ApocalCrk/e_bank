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
                  $kode_kantin = $this->session->userdata('kode_kantin');
                  $sql = $this->db->query("SELECT * FROM pesan where to_nis='$kode_kantin' and baca='belum'");
                  if ($sql->num_rows() > 0) {
                 ?>
                <span class="badge badge-danger badge-counter">
                  <?php 
                          $nis = $this->session->userdata(nis);
                          $sql = $this->db->query("SELECT * FROM pesan where to_nis='$kode_kantin' and baca='belum'");
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
                    include 'Kantinui.php';

                    $kode_kantin = $this->session->userdata('kode_kantin');
                    $sql = $this->db->query("SELECT * from pesan where to_nis='$kode_kantin' and baca='belum' LIMIT 3");
                    foreach ($sql->result() as $rw) {
                      ?>
                      <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('Kantinui/pesan_read/'.$rw->id_pesan) ?>">
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
                <a class="dropdown-item text-center small text-gray-500" href="Kantinui/box_pesan">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php 
                  $id_kantin = $this->session->userdata('id_kantin');
                  $kode_kantin = $this->session->userdata('kode_kantin');
                  $row = $this->db->query("SELECT * FROM kantin where id_kantin='$id_kantin' and kode_kantin='$kode_kantin'")->row();
                 ?>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row->nama_kantin ?></span>
                <img class="img-profile rounded-circle" src="image/kantin/<?php echo $row->foto_kantin ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="Kantinui/profile_saya">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a> -->
                <a class="dropdown-item" href="Kantinui/ubahpassword_kantin">
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