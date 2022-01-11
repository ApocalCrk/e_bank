<html>
<head>
	<base href="<?php echo base_url() ?>">
	<meta name="viewport" content="width=device-width; height=device-height;">
	<link rel="stylesheet" href="resource://content-accessible/ImageDocument.css">
	<link rel="stylesheet" href="resource://content-accessible/TopLevelImageDocument.css">
	<link rel="stylesheet" href="chrome://global/skin/media/TopLevelImageDocument.css">
	<title>Cetak QrCode</title>
	<script src="moz-extension://f2e96bef-9f64-48cc-bb68-0f0608ae7264/assets/prompt.js"></script>
</head>
<body onload="print()">
	<img src="image/barang/<?php echo $qr_code ?>" alt="">
</body>
</html>