<?php date_default_timezone_set('Asia/Jakarta');  ?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	  <base href="<?php echo base_url() ?>">
	<title>eS-Pay - Kantin</title>
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
	<?php include 'sidebar_kantin.php'; ?>
	<div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
	<?php include 'header_kantin.php'; ?>

	<?php include $konten.'.php'; ?>

	<!-- end content -->
	<?php include 'footer_kantin.php'; ?>
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
  <script src="assets/Chart.min.js"></script>

<script type="text/javascript">
   var auto_refresh = setInterval(
      function ()
      {
         $('#pen_jul_har').load('<?php echo base_url()."kantinui/data_pen_har" ?>').fadeIn("slow");
      }, 1000); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
   var auto_refresh = setInterval(
      function ()
      {
         $('#tota_pen_har').load('<?php echo base_url()."kantinui/data_total_pen" ?>').fadeIn("slow");
      }, 1000); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
   var auto_refresh = setInterval(
      function ()
      {
         $('#tota_barang').load('<?php echo base_url()."kantinui/data_barang_dash" ?>').fadeIn("slow");
      }, 1000); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
   var auto_refresh = setInterval(
      function ()
      {
         $('#nw_pesan').load('<?php echo base_url()."kantinui/data_pesan_dash" ?>').fadeIn("slow");
      }, 1000); // refresh every 10000 milliseconds
</script>
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


























<!-- chart area kantin -->
<script type="text/javascript">
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"],
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=1 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;
        ?>
        , 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=2 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;
        ?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=3 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;
        ?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=4 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;
        ?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=5 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=6 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=7 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=8 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=9 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=10 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>, 
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=11 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>,
        <?php 
        $kode = $this->session->userdata('kode_kantin');
        $nilai = 0;
        $sql = $this->db->query("SELECT total_harga FROM penjualan_header where key_barang='$kode' and MONTH(tgl_penjualan)=12 and YEAR(tgl_penjualan)=YEAR(CURDATE())");
        foreach ($sql->result() as $row) {
          $nilai = $nilai + $row->total_harga;
        }
        echo $nilai;?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp. ' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>

<!-- chart pie kantin -->
<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Makanan", "Minuman", "Barang"],
      datasets: [{
        data: [
        <?php 
        $kode_kantin = $this->session->userdata('kode_kantin');
        $sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail,barang where penjualan_header.key_barang='$kode_kantin' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = barang.kode_barang and kategori = 'makanan' and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
          foreach ($sql->result() as $row) {
            echo $row->qty;
          }
        ?>, 
        <?php 
        $kode_kantin = $this->session->userdata('kode_kantin');
        $sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail,barang where penjualan_header.key_barang='$kode_kantin' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = barang.kode_barang and kategori = 'minuman' and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
          foreach ($sql->result() as $row) {
            echo $row->qty;
          }
        ?>, 
        <?php 
        $kode_kantin = $this->session->userdata('kode_kantin');
        $sql = $this->db->query("SELECT SUM(qty) as qty FROM penjualan_header join penjualan_detail,barang where penjualan_header.key_barang='$kode_kantin' and penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = barang.kode_barang and barang.kategori = 'barang' and MONTH(tgl_penjualan)=MONTH(CURDATE()) and YEAR(tgl_penjualan)=YEAR(CURDATE())");
          foreach ($sql->result() as $row) {
            echo $row->qty;
          }
        ?>],
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>



</body>
</html>