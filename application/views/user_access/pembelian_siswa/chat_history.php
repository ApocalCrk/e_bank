<?php 
	$sql = $this->db->query("SELECT * FROM chat_message");
	$ex = explode('-', $id);
	$query = $this->db->query("SELECT * FROM chat_message WHERE penerima='$ex[1]'");
	if($query->num_rows() > 0){
		foreach($sql->result() as $row){
			if ($row->pengirim == $ex[0]) {
				$id_chat = $row->chat_id;
				$cht = $this->db->query("SELECT * FROM chat_message WHERE chat_id='$id_chat' and penerima='$ex[1]'");
				foreach ($cht->result() as $qr) {?>
<div class="chat_user" style="background-color: #ccc;width: auto;height: auto;border-radius: 10px;padding-right: 5px;float: right">&nbsp;<?php echo $qr->message ?><time style="font-size: 8px;float: left;margin-left: 5px;"><?php echo $row->timestamp ?></time> </div><br><br>
<?php } ?>
<?php }
if($row->penerima == $ex[0]){
	$id_chat = $row->chat_id;
	$cht = $this->db->query("SELECT * FROM chat_message WHERE chat_id='$id_chat' and pengirim='$ex[1]'");
	foreach ($cht->result() as $qr) {
 ?>
<div class="chat_kurir mt-1" style="background-color: #fff;width: auto;height: auto;border-radius: 10px;padding-left: 5px;float: left"><?php echo $qr->message ?>&nbsp; <time style="font-size: 8px;float: right;margin-right: 5px;"><?php echo $qr->timestamp ?></time> </div><br><br>
<?php } } } }else{} ?>