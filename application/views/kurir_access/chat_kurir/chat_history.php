<?php 
	$sql = $this->db->query("SELECT * FROM chat_message");
	$ex = explode('-', $id);
	$this->db->query("UPDATE chat_message SET read_status='Sudah' WHERE pengirim='$ex[0]' and penerima='$ex[1]'");
	$query1 = $this->db->query("SELECT * FROM chat_message WHERE penerima='$ex[0]' and pengirim='$ex[1]'");
	$query2 = $this->db->query("SELECT * FROM chat_message WHERE penerima='$ex[1]' and pengirim='$ex[0]'");
	if($query1->num_rows() > 0 or $query2->num_rows() > 0){
		foreach($sql->result() as $row){
			if ($row->pengirim == $ex[1]) {
				$id_chat = $row->chat_id;
				$cht = $this->db->query("SELECT * FROM chat_message WHERE chat_id='$id_chat' and penerima='$ex[0]'");
				foreach ($cht->result() as $qr) {?>
<div class="chat_user" style="background-color: #ccc;width: auto;height: auto;border-radius: 10px;padding-right: 5px;float: right">&nbsp;<?php echo $qr->message ?><time style="font-size: 8px;float: left;margin-left: 5px;"><?php echo $row->timestamp ?></time> </div><br><br>
<?php } ?>
<?php }
elseif($row->penerima == $ex[1]){
	$id_chat = $row->chat_id;
	$cht = $this->db->query("SELECT * FROM chat_message WHERE chat_id='$id_chat' and pengirim='$ex[0]'");
	foreach ($cht->result() as $qr) {
 ?>
<div class="chat_kurir mt-1" style="background-color: #fff;width: auto;height: auto;border-radius: 10px;padding-left: 5px;float: left"><?php echo $qr->message ?>&nbsp; <time style="font-size: 8px;float: right;margin-right: 5px;"><?php echo $qr->timestamp ?></time> </div><br><br>
<?php } } } }else{} ?>