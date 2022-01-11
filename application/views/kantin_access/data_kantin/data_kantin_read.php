<table class="table">
  <?php echo $this->session->flashdata('message_berhasil') ?>
  <?php $id_kantin = $this->session->userdata('id_kantin'); ?>
  <?php $kode = $this->session->userdata('kode_kantin'); ?>
  <?php 
  $sql = $this->db->query("SELECT * FROM kantin WHERE id_kantin='$id_kantin' and kode_kantin='$kode'")->row();
  ?>
        <tr>
            <td>Kode Kantin</td>
            <td><?php echo $sql->kode_kantin ?></td>
        </tr>
        <tr>
            <td>Nama Kantin</td>
            <td><?php echo $sql->nama_kantin ?></td>
        </tr>
        <tr>
            <td>No Hp</td>
            <td><?php echo $sql->no_hp_kantin ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $sql->email ?></td>
        </tr>
        <tr>
            <td>Pengurus Kantin</td>
            <td><?php echo $sql->pengurus_kantin ?></td>
        </tr>
        <tr>
            <td>Foto Kantin</td>
            <td><img id='ft_kantin' src="image/kantin/<?php echo $sql->foto_kantin?>" style="width: 100px;height: 100px;"></td>
        </tr>
        <tr>
          <td><a href="kantinui/edit_data_kantin" class="btn btn-primary">Edit</a></td>
        </tr>
</table>


<style type="text/css">
    #ft_kantin {
  cursor: pointer;
  transition: 0.3s;
}

#ft_kantin:hover {opacity: 0.7;}

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

#ft_kantin_full {
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
@media only screen and (max-width: 500px){
  .modal-content_ft {
    width: 100%;
  }
  #ft_kantin_full{
    margin-top: 20px;
    width: 85%;
    height: 70%;
  }
}
</style>


<div id="myModal_ft" class="modal_ft">
  <span class="close_ft">&times;</span>
  <img class="modal-content_ft" id="ft_kantin_full">
</div>

<script type="text/javascript">
    var modal = document.getElementById("myModal_ft");
    var img = document.getElementById("ft_kantin");
    var modalImg = document.getElementById("ft_kantin_full");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
    }
    var span = document.getElementsByClassName("close_ft")[0];
    span.onclick = function() {
      modal.style.display = "none";
    } 
</script>