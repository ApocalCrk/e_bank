<footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
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
          <a class="btn btn-primary" href="Kurirui/logoutkurir">Logout</a>
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