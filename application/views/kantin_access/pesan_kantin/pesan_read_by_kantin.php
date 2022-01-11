<style type="text/css">
	.ft-img{
		width: 15%;
		height: 15%;
	}
</style>
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
<div class="ft-admin col-md-4">
	<h3 style="display: inline-block;"><?php echo $subjek_pesan ?></h3>
	<span style="position:absolute;display: inline-block;width: 120px;height:25px;background: #eee;border-radius: 10px;text-align: center;align-items: center;justify-content: center;top: 5px;margin-left: 5px;">
		<p style="color: #000">Pesan Masuk</p>
	</span>
	<br>
	<img src="image/user/default.png" class="rounded-circle ft-img">
	&nbsp;&nbsp;&nbsp;&nbsp;
	<b class="pengirim" style="position: relative;display: inline-block;top:-12px;">
		<?php echo $pengirim ?>
	</b>
	<p style="position: relative;display: inline-block;left: -105px;top: 8px;font-size: 13px;">
		To <?php echo $to_nis ?>
		<i class="fa fa-chevron-down" id="rot" onclick="moreInfo()" style="position: relative;left: 10px;color: #000;cursor: pointer;transition: all 0.5s ease-in-out;"></i>
	</p>
</div>

<!-- modal function -->

<div id="showMore" 
style="
display: none;
border: 1px solid #aaa;
width: 300px;
height: 90px;
position: relative;
left: 65px;
border-radius: 7px;
box-shadow: 1px 1px 1px 1px #ddd;
">
  <p style="font-size: 14px;margin-left: 2px;">
  	Dari
  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
  	<?php echo $pengirim; ?><br>
  	Ke
  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  	<?php echo $to_nis; ?> &nbsp;•&nbsp; <?php echo $this->session->userdata('nama_kantin') ?><br>
  	Tanggal 
  	&nbsp;&nbsp;&nbsp; 
  	<?php 
  	$date = new datetime($tanggal);
  	echo $date->format('d F, Y, H:i').' WIB' 
  	?><br>
  	<i class="fa fa-lock"></i>
  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  	Standard encryption (TSL).
  </p>
</div><br>
<div class="col-md-4">
<p style="font-size: 15px;position: relative;">
	<?php
	$decrypt_str = decrypt($isi_pesan, $password);
	echo $decrypt_str;
	?></p>
	<br>
<a href="<?php echo site_url('Kantinui/box_pesan') ?>" class="btn btn-primary">Back</a>

<?php 
	$data = array(
    'baca' => 'sudah'
	);

	$this->db->where('id_pesan', $id_pesan);
	$this->db->update('pesan', $data); 
 ?>


<script type="text/javascript">
function moreInfo() {
  var x = document.getElementById("showMore");
  var fa = document.getElementById("rot");
  if (x.style.display === "none") {
    x.style.display = "block";
    fa.style.transform = "rotate(180deg)"
  } else {
    x.style.display = "none";
    fa.style.transform = "rotate(0deg)"
  }
} 
</script>