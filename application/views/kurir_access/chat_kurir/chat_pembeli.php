<style type="text/css">
	body {
		overflow: hidden;
	}
</style>
<?php $ex=explode('-',$id); ?>
<div class="content" style="margin-top: -1.5rem;">
	<div style="height:500px;border: 0.5px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" id="chat">

	</div>
	<form class="form-group" action="" method="post" style="margin-top: -25px">
		<div class="">
			<textarea class="form-control" name="message" style="width: 84%"></textarea>
			<button class="btn btn-primary position-absolute" name="submit" type="submit" id="send_chat" style="right: 0;top: 570px;height: 62px">Send</button>
		</div>
	</form>
</div>
<?php 
if (isset($_POST['submit'])) {
	$ex = explode('-', $id);
		$data = array(
			'pengirim' => $this->session->userdata('id_kurir'),
			'penerima' => $ex[0],
			'message' => $this->input->post('message'),
			'timestamp' => date('Y-m-d H:i:s'),
			'read_status' => 'Belum',
		);
	$this->db->insert('chat_message', $data);
}
 ?>
 