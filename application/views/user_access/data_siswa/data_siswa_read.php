<?php 
  $id_siswa = $this->session->userdata('id_siswa');
  $nis = $this->session->userdata('nis');
 ?>
<?php $sql = $this->db->query("SELECT * FROM user WHERE id_siswa='$id_siswa' and nis='$nis'")->row() ?>
<table class="table">
        <tr>
            <td>Nis</td>
            <td><?php echo $sql->nis ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?php echo $sql->nama_siswa ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?php echo $sql->alamat ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><?php echo $sql->tempat_lahir ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><?php echo $sql->tanggal_lahir ?></td>
        </tr>
        <tr>
            <td>No Hp</td>
            <td><?php echo $sql->no_hp ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $sql->email ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td><?php echo $sql->kelas ?></td>
        </tr>
        <tr>
            <td>Foto</td>
            <td><img id='ft_siswa' src="image/siswa/<?php echo $sql->foto?>" style="width: 50px;height: 50px;"></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td><?php echo $sql->jurusan ?></td>
        </tr>
</table>


<style type="text/css">
    #ft_siswa {
  cursor: pointer;
  transition: 0.3s;
}

#ft_siswa:hover {opacity: 0.7;}

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

#ft_siswa_full {
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
  #ft_siswa_full{
    margin-top: 20px;
    width: 85%;
    height: 70%;
  }
}
</style>


<div id="myModal_ft" class="modal_ft">
  <span class="close_ft">&times;</span>
  <img class="modal-content_ft" id="ft_siswa_full">
</div>

<script type="text/javascript">
    var modal = document.getElementById("myModal_ft");
    var img = document.getElementById("ft_siswa");
    var modalImg = document.getElementById("ft_siswa_full");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
    }
    var span = document.getElementsByClassName("close_ft")[0];
    span.onclick = function() {
      modal.style.display = "none";
    } 
</script>