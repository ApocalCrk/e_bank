<?php date_default_timezone_set('Asia/Jakarta');  ?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<base href="<?php echo base_url() ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>eS-Pay</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
	<link href="assets/bootstrap-select.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/chart-data.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/bootstrap-select.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="assets/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
				$('#example').DataTable();
			} );
	</script>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	<?php include 'header.php'; ?>

	<?php include 'side.php'; ?>
	<!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="app.html">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active"><?php echo $jdl; ?></li>
			</ol>
		</div><!--/.row-->
		
		<br>
		<div class="row">
			<div class="col-lg-12">
				
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $jdl; ?></div>
					<div class="panel-body">
						<?php include $konten.'.php'; ?>
					</div>
				</div>

			</div><!-- /.col-->
			<div class="col-sm-12">
				<p class="back-link">eS-Pay <?php echo Date('2019'); ?></p>
			</div>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      
    });
  });
</script>
<script type="text/javascript">
function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-z])/;
	var capital = /([A-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if($('#password').val().length<6) {
	$('#password-strength-status').removeClass();
	$('#password-strength-status').addClass('weak-password');
	$('#password-strength-status').html("Weak (should be atleast 6 characters.)");
	} else {  	
	if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters) && $('#password').val().match(capital)) {            
	$('#password-strength-status').removeClass();
	$('#password-strength-status').addClass('strong-password');
	$('#password-strength-status').html("<i class='fa fa-check text-success'></i> Strong");
	} else {
	$('#password-strength-status').removeClass();
	$('#password-strength-status').addClass('medium-password');
	$('#password-strength-status').html("Medium (should include alphabets, capital, numbers and special characters.)");
}}}
</script>
</body>
</html>
