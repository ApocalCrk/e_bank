<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<base href="<?php echo base_url() ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>eS-Pay - Login Kantin</title>
	
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
    <script src="assets/js/sweetalert2.min.js"></script>
</head>
<?php 
  $ip = $_SERVER["REMOTE_ADDR"];
  $res = $this->db->query("SELECT * FROM `ip_captcha` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 30 minute)")->row();
  $res_num = $this->db->query("SELECT * FROM `ip_captcha` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 30 minute)");
  if ($res_num->num_rows() > 10) {?>
    <div>
      <?php 
      date_default_timezone_set('Asia/Jakarta');
      $start = $res->timestamp;
      $new_start = new DateTime($start);
      $end_start = new DateTime('');
      $interval = $end_start->diff($new_start);
      $time = 30 - $interval->format('%i');

      echo "<script>
            var time = '{$time}';
            Swal.fire({
              type: 'warning',
              title: 'Your IP has been blocked',
              text: 'You can access again after '+ time + ' minutes',
              showConfirmButton: false,
              });
          </script>";
      ?>
    </div>
 <?php }else{?>
<body class="bg-gradient-primary">
<?php echo $this->session->flashdata('message_error') ?>
<?php echo $this->session->flashdata('message_berhasil') ?>
  <div class="container mt-4">
    <?php 
      function sign($message, $key) {
          return hash_hmac('sha256', $message, $key) . $message;
      }
      function verify($bundle, $key) {
          return hash_equals(
            hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
            mb_substr($bundle, 0, 64, '8bit')
          );
      }
      function getKey($password, $keysize = 16) {
          return hash_pbkdf2('sha256',$password,'some_token',100000,$keysize,true);
      }
      function encrypt($message, $password) {
          $iv = random_bytes(16);
          $key = getKey($password);
          $result = sign(openssl_encrypt($message,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv), $key);
          return bin2hex($iv).bin2hex($result);
      }
      function decrypt($hash, $password) {
          $iv = hex2bin(substr($hash, 0, 32));
          $data = hex2bin(substr($hash, 32));
          $key = getKey($password);
          if (!verify($data, $key)) {
            return null;
          }
          return openssl_decrypt(mb_substr($data, 64, null, '8bit'),'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv);
      }
      $password = 'password';
    ?>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Kantin</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="username" name="username" class="form-control form-control-user" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    </div>

                    <!-- This Captcha for login -->
                    <?php 
                      $ip = $_SERVER["REMOTE_ADDR"];
                        $res = $this->db->query("SELECT * FROM `ip_captcha` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 10 minute)");
                     ?>
                    <?php if ($res->num_rows() > 5) {?>
                    <div class="form-group">
                      <input type="text" name="captcha_text" class="form-control form-control-user" placeholder="Enter Captcha" style="float: left;width: 47.5%" required>
                      <div><?php include 'image/captcha/captcha.php';printf('<img src="data:image/jpeg;base64,%s"/>', 
                      base64_encode(ob_get_clean())); ?></div>
                      <?php $encrypt = encrypt($captcha_code, $password); ?>
                      <input type="hidden" name="answer" value="<?php echo $encrypt; ?>" readonly>
                    </div>
                    <?php }else{?>
                      <div class="form-group" style="display: none;">
                        <div><?php include 'image/captcha/captcha.php';printf('<img src="data:image/jpeg;base64,%s"/>', 
                      base64_encode(ob_get_clean())); ?></div>
                        <input type="hidden" name="captcha_text" value="<?php echo $captcha ?>" class="form-control form-control-user" placeholder="Enter Captcha" style="float: left;width: 47.5%" readonly>
                        <?php $encrypt = encrypt($captcha_code, $password); ?>
                        <input type="hidden" name="answer" value="<?php echo $encrypt ?>" class="form-control form-control-user" placeholder="Enter Captcha" style="float: left;width: 47.5%" readonly>
                      </div>
                    <?php } ?>
                    <!-- End Captcha -->

                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login">
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" onclick="pesanadmin()" style="color: blue;cursor: pointer;">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>



  <?php echo $this->session->flashdata('logout') ?>
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/js/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
    function pesanadmin() {
      Swal.fire({
        type: 'info',
        text: 'Jika anda lupa password, silahkan hubungi admin ex.0895401144676'
      })
    }
  </script>

</body>
<?php } ?>
</html>