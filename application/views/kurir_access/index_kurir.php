<?php date_default_timezone_set('Asia/Jakarta');  ?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	  <base href="<?php echo base_url() ?>">
	<title>eS-Pay - Kurir</title>
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
	<?php include 'sidebar_kurir.php'; ?>
	<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
	<?php include 'header_kurir.php'; ?>

	<?php include $konten.'.php'; ?>

	<!-- end content -->
	<?php include 'footer_kurir.php'; ?>
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


<!-- ajax dashboard -->
<script src="assets/js/ajax_random/kurirpage_script.js"></script>

<script type="text/javascript">
     var auto_refresh = setInterval(
        function ()
        {
           $('#chat').load('<?php echo base_url()."Kurirui/chat_history/".$id ?>').fadeIn("slow");
        }, -9000); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
  var d = $('#chat');
d.animate({ scrollTop: d.prop('scrollHeight') }, 1000);
</script>
</body>
</html>