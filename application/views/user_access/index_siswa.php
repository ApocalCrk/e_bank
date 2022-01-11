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
	<?php include 'sidebar_siswa.php'; ?>
	<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
	<?php include 'header_siswa.php'; ?>

	<?php include $konten.'.php'; ?>

	<!-- end content -->
	<?php include 'footer_siswa.php'; ?>
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

<script type="text/javascript">
$(".form-inline").each(function() {
  
  var $inp = $(this).find("input:text"),
      $cle = $(this).find(".clear");

  $inp.on("input", function(){
    $cle.toggle(!!this.value);
  });
  
  $cle.on("touchstart click", function(e) {
    e.preventDefault();
    $inp.val("").trigger("input");
  });
  
});
</script>

<script type="text/javascript">
  $(".decreaseVal").click(function() {
  var input_el=$(this).next('input');
  var v= input_el.val()-1;
  if(v>=input_el.attr('min'))
  input_el.val(v)
});


$(".increaseVal").click(function() {
  var input_el=$(this).prev('input');
  var v= input_el.val()*1+1;
  if(v<=input_el.attr('max'))
  input_el.val(v)
});
</script>

<script type="text/javascript">
  $('select').change(function(){
     if($('select option:selected').text() == "Other"){
        $('input').show();
        $('select').hide();
     }
     else{
        $('input').hide();
        $('select').show();
     }
 });
</script>

<!-- <script type="text/javascript">
  document.addEventListener('contextmenu', function(e) {
  e.preventDefault();
});
</script> -->

<script type="text/javascript">
     var auto_refresh = setInterval(
        function ()
        {
           $('#ajax_loader').load('<?php echo base_url()."Siswaui/ajax_kurir" ?>').fadeIn("slow");
        }, 5000); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
     var auto_refresh = setInterval(
        function ()
        {
           $('#chat').load('<?php echo base_url()."Siswaui/chat_history/".$id ?>').fadeIn("slow");
        }, -9000); // refresh every 10000 milliseconds
</script>
<script type="text/javascript">
  var d = $('#chat');
d.animate({ scrollTop: d.prop('scrollHeight') });
</script>
</body>
</html>