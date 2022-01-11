<?php 
	$id_kurir = $this->session->userdata('id_kurir');
	$nis = $this->session->userdata('nis_kurir');
	$sql = $this->db->query("SELECT * FROM kurir WHERE id_kurir='$id_kurir' and nis_kurir='$nis'")->row();
?>	
<table class="table">
	<tr>
		<td>NIS Kurir</td>
		<td><?php echo $sql->nis_kurir ?></td>
	</tr>
	<tr>
		<td>Nama Kurir</td>
		<td><?php echo $sql->nama_kurir ?></td>
	</tr>
	<tr>
		<td>No Hp Kurir</td>
		<td><?php echo $sql->no_hp_kurir ?></td>
	</tr>
	<tr>
		<td>Email Kurir</td>
		<td><?php echo $sql->email_kurir ?></td>
	</tr>
	<tr>
		<td>Foto Kurir</td>
		<td><img id='ft_kurir' src="image/kurir/<?php echo $sql->foto_kurir?>" style="width: 50px;height: 50px;"></td>
	</tr>
	<tr>
		<td>QR Code</td>
		<td><img id="ft_qr" src="image/kurir_code/<?php echo $sql->id_qrcode ?>" style="width: 50px;height: 50px;"></td>
	</tr>
	<tr>
		<td>Tanggal Pembuatan</td>
		<td><?php echo $sql->tanggal_pembuatan ?></td>
	</tr>
</table>

<style type="text/css">
    #ft_kurir {
  cursor: pointer;
  transition: 0.3s;
}

#ft_kurir:hover {opacity: 0.7;}

/* The Modal (background) */
.modal_ft {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content_ft {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

#ft_kurir_full {
    width: 35%;
    height: 80%;
}

.modal-content_ft {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close_ft {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close_ft:hover,
.close_ft:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content_ft {
    width: 100%;
  }
  #ft_kurir_full{
    margin-top: 20px;
    width: 85%;
    height: 70%;
  }
}
</style>


<div id="myModal_ft" class="modal_ft">
  <span class="close_ft">&times;</span>
  <img class="modal-content_ft" id="ft_kurir_full">
</div>

<script type="text/javascript">
    var modal = document.getElementById("myModal_ft");
    var img = document.getElementById("ft_kurir");
    var modalImg = document.getElementById("ft_kurir_full");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
    }
    var span = document.getElementsByClassName("close_ft")[0];
    span.onclick = function() {
      modal.style.display = "none";
    } 
</script>

<style type="text/css">
    #ft_qr {
  cursor: pointer;
  transition: 0.3s;
}

#ft_qr:hover {opacity: 0.7;}

/* The Modal (background) */
.modal_ft_qr {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content_ft_qr {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

#ft_qr_full {
    width: 35%;
    height: 80%;
}

.modal-content_ft_qr {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close_ft_qr {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close_ft_qr:hover,
.close_ft_qr:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content_ft_qr {
    width: 100%;
  }
  #ft_qr_full{
    margin-top: 20px;
    width: 85%;
    height: 70%;
  }
}
</style>


<div id="myModal_ft_qr" class="modal_ft_qr">
  <span class="close_ft_qr">&times;</span>
  <img class="modal-content_ft_qr" id="ft_qr_full">
</div>

<script type="text/javascript">
    var modal = document.getElementById("myModal_ft_qr");
    var img = document.getElementById("ft_qr");
    var modalImg = document.getElementById("ft_qr_full");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
    }
    var span = document.getElementsByClassName("close_ft_qr")[0];
    span.onclick = function() {
      modal.style.display = "none";
    } 
</script>
