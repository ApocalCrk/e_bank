<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kurirui extends CI_Controller {
	public function index()
	{
		if ($this->session->userdata('level') == "") {
           redirect('Kurirui/login_kurir');
        } 
		$data = array(
			'konten' => 'kurir_ui',
			'jdl' => 'Dashboard',
		);
		$this->load->view('kurir_access/index_kurir',$data);
	}

	public function data_pen_har()
	{
		$this->load->view('kurir_access/order_kurir/data_pen_har');
	}

	public function data_pen_bun()
	{
		$this->load->view('kurir_access/order_kurir/data_pen_bul');
	}

	public function total_order()
	{
		$this->load->view('kurir_access/order_kurir/total_order');
	}

	public function data_tabungan()
	{
		$this->load->view('kurir_access/order_kurir/data_tabungan');
	}

	public function order_kurir_num()
	{
		$this->load->view('kurir_access/order_kurir/order_kurir');
	}

	public function nums_coun()
	{
		$this->load->view('kurir_access/order_kurir/nums_coun');
	}

	public function nums_message()
	{
		$this->load->view('kurir_access/order_kurir/nums_message');
	}

	public function data_kurir() {
		if ($this->session->userdata('level') == "") {
			redirect('Kurirui/login_kurir');
		}
		$data = array(
			'konten' => 'data_kurir/data_kurir_read',
			'jdl' => 'Data Saya',
		);
		$this->load->view('kurir_access/index_kurir', $data);
	}

	public function saldo_saya()
	{
		if ($this->session->userdata('level') == '') {
			redirect('Kurirui/login_kurir');
		}
		$data = array(
			'konten' => 'tabungan_kurir',
			'jdl' => 'Saldo Saya',
		);
		$this->load->view('kurir_access/index_kurir', $data);
	}

	public function data_penarikan_saldo()
	{
		if ($this->session->userdata('level') == '') {
			redirect('Kurirui/login_kurir');
		}
		$data = array(
			'konten' => 'data_penarikan_kurir',
			'jdl' => 'Penarikan Saldo',
		);
		$this->load->view('kurir_access/index_kurir', $data);
	}

	public function read_orderan($no_invoice)
	{
		if ($this->session->userdata('level') == "") {
           redirect('Kurirui/login_kurir');
        }
        $id = $this->session->userdata('nama_kurir').' - '.$this->session->userdata('id_kurir');
        $row = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$no_invoice' and nama_kurir='$id'")->row();
        if ($row) {
        	$data = array(
        		'id_order' => $row->id_order,
        		'invoice_order' => $row->invoice_order,
        		'nama_pembeli' => $row->nama_pembeli,
        		'nama_kurir' => $row->nama_kurir,
        		'pesanan' => $row->pesanan,
        		'kantin' => $row->kantin,
        		'total_harga' => $row->total_harga,
        		'ongkir' => $row->ongkir,
        		'tujuan' => $row->tujuan,
        		'status' => $row->status,
        		'note' => $row->note,
        		'metode_pembayaran' => $row->metode_pembayaran,
        		'waktu' => $row->waktu,
        		'konten' => 'read_orderan',
        		'jdl' => 'Orderan Baru',
        	);
        	$this->load->view('kurir_access/index_kurir', $data);
        }
	}

	public function orderan_masuk($no_invoice)
	{
		if ($this->session->userdata('level') == "") {
           redirect('Kurirui/login_kurir');
        }
        if (isset($_POST['terima'])) {
        	date_default_timezone_set('Asia/Jakarta');
        	$orderan = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$no_invoice'")->row();
        	if ($orderan->metode_pembayaran == 'COD' or 'eS-Pay Offline') {
        		$this->db->query("UPDATE order_pesanan SET status='Dikonfirmasi' WHERE invoice_order='$no_invoice'");
        		redirect('Kurirui/read_orderan/'.$no_invoice);
        	}else{
        		$this->db->query("UPDATE order_pesanan SET status='Dikonfirmasi' WHERE invoice_order='$no_invoice'");
	        	$sql = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$no_invoice'")->row();
	        	$waktu = date('Y-m-d H:i:s');
	        	$nis_kurir = $this->session->userdata('nis_kurir');
	        	$ex = explode('-', $sql->nama_pembeli);
	        	$total_harga = $orderan->total_harga + $orderan->ongkir;
	        	$this->db->query("UPDATE tabungan SET saldo=saldo-'$total_harga', pengeluaran=pengeluaran+'$total_harga' WHERE nis='$ex[1]'");
	        	$this->db->query("UPDATE tabungan_kurir SET total_saldo=total_saldo+'$total_harga', waktu='$waktu' WHERE nis_kurir='$nis_kurir'");
	        	redirect('Kurirui/read_orderan/'.$no_invoice);
        	}
        } elseif(isset($_POST['tolak'])) {
        	$this->db->query("UPDATE order_pesanan SET status='Kurir Menolak' WHERE invoice_order='$no_invoice'");
        	redirect('Kurirui/index');
        } elseif(isset($_POST['update'])) {
        	$stat = $this->input->post('status');
        	$this->db->query("UPDATE order_pesanan SET status='$stat' WHERE invoice_order='$no_invoice'");
        	if ($stat != 'Transaksi Selesai') {
        		redirect('Kurirui/read_orderan/'.$no_invoice);
        	}else{
        		$id = $this->session->userdata('id_kurir');
        		$sql = $this->db->query("SELECT * FROM order_pesanan WHERE invoice_order='$no_invoice'")->row();
        		$ex = explode('-', $sql->nama_pembeli);
        		$id_siswa = $this->db->query("SELECT * FROM user WHERE nama_siswa='$ex[0]' and nis='$ex[1]'")->row();
        		$this->db->query("UPDATE active_kurir SET order_pesanan='no' WHERE id_kurir='$id'");
				$this->db->query("DELETE FROM chat_message WHERE pengirim='$id' and penerima='$id_siswa->id_siswa'");
				$this->db->query("DELETE FROM chat_message WHERE penerima='$id' and pengirim='$id_siswa->id_siswa'");
        		$this->session->set_flashdata('message_transaksi',
        			'<script>
        				Swal.fire({
        					type: "success",
        					text: "Transaksi Telah Selesai",
        					showConfirmButton: false,
        					timer: 1500,
        					})
        			</script>'
        		);
        		redirect('Kurirui/index');
        	}
        }
        
	}

	public function chat_pembeli($id)
	{
		if ($this->session->userdata('level') == "") {
			redirect('Kurirui/login_kurir');
		}
		$data = array(
			'id' => $id,
			'konten' => 'chat_kurir/chat_pembeli',
			'jdl' => 'Chat Pembeli',
		);
		$this->load->view('kurir_access/index_kurir', $data);
	}

	public function chat_history($id)
	{	
		$data = array(
			'id' => $id,
		);
		$this->load->view('kurir_access/chat_kurir/chat_history', $data);
	}

	public function login_kurir()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('login_kurir');
		} else { 
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
		      function encrypt($message, $password) {
		          $iv = random_bytes(16);
		          $key = getKey($password);
		          $result = sign(openssl_encrypt($message,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv), $key);
		          return bin2hex($iv).bin2hex($result);
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
		      $password_encrypt = 'password';
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$captcha = $this->input->post('captcha_text');
			$answer = decrypt($this->input->post('answer'), $password_encrypt);
			
			$cek_siswa = $this->db->query("SELECT * FROM kurir WHERE username='$username'");
			if ($cek_siswa->num_rows() == 1) {
				$vr = $cek_siswa->row_array();
				if ($password == $vr['password']) {
					if ($captcha == $answer) {
				foreach ($cek_siswa->result() as $row) {
						$sess_data['id_kurir'] = $row->id_kurir;
						$sess_data['nis_kurir'] = $row->nis_kurir;
						$sess_data['nama_kurir'] = $row->nama_kurir;
						$sess_data['no_hp_kurir'] = $row->no_hp_kurir;
						$sess_data['email_kurir'] = $row->email_kurir;
						$sess_data['foto_kurir'] = $row->foto_kurir;
						$sess_data['id_qrcode'] = $row->id_qrcode;
						$sess_data['username'] = $row->username;
						$sess_data['tanggal_pembuatan'] = $row->tanggal_pembuatan;
						$sess_data['level'] = $row->level;
						$this->session->set_userdata($sess_data);
						$this->session->set_flashdata('message',
							'<script>
								const Toast = Swal.mixin({
								  toast: true,
								  position: "top-end",
								  showConfirmButton: false,
								  timer: 3000,
								  timerProgressBar: true,
								  onOpen: (toast) => {
								    toast.addEventListener("mouseenter", Swal.stopTimer)
								    toast.addEventListener("mouseleave", Swal.resumeTimer)
								  }
								})

								Toast.fire({
								  type: "success",
								  title: "Login Sukses"
								})
							</script>');

					}
					redirect('Kurirui');
					}else{
						$ip = $_SERVER["REMOTE_ADDR"];
						$this->db->query("INSERT INTO `ip_captcha` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
							?>
						<script type="text/javascript">
							window.location="<?php echo base_url("Kurirui/login_karir"); ?>";
						</script>

						<?php
						$this->session->set_flashdata('message_error','
							<script>
								Swal.fire({
								  type: "error",
								  text: "Captcha kamu salah !",
								  showConfirmButton: false,
								  timer: 2000
								})

							</script>');
					}
				}else{
					$ip = $_SERVER["REMOTE_ADDR"];
					$this->db->query("INSERT INTO `ip_captcha` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
						?>
					<script type="text/javascript">
						window.location="<?php echo base_url("Kurirui/login_kurir"); ?>";
					</script>

					<?php
					$this->session->set_flashdata('message_error','
						<script>
							Swal.fire({
							  type: "error",
							  text: "Password kamu salah !",
							  showConfirmButton: false,
							  timer: 2000
							})

						</script>');
					
				}
			} else {
					$ip = $_SERVER["REMOTE_ADDR"];
					$this->db->query("INSERT INTO `ip_captcha` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
						?>
					<script type="text/javascript">
						window.location="<?php echo base_url("Kurirui/login_kurir"); ?>";
					</script>

					<?php
					$this->session->set_flashdata('message_error','
						<script>
							Swal.fire({
							  type: "error",
							  text: "Akun tidak ditemukan !",
							  showConfirmButton: false,
							  timer: 2000
							})

						</script>');
					
			}

		}
	}


	
	function logoutkurir()
	{
		$this->session->unset_userdata('id_kurir');
		$this->session->unset_userdata('nis_kurir');
		$this->session->unset_userdata('nama_kurir');
		$this->session->unset_userdata('no_hp_kurir');
		$this->session->unset_userdata('email_kurir');
		$this->session->unset_userdata('foto_kurir');
		$this->session->unset_userdata('id_qrcode');
		$this->session->unset_userdata('tanggal_pembuatan');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->set_flashdata('logout', 
			'<script>
				const Toast = Swal.mixin({
					toast: true,
					position: "top-end",
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
				onOpen: (toast) => {
					toast.addEventListener("mouseenter", Swal.stopTimer)
					toast.addEventListener("mouseleave", Swal.resumeTimer)
					}		
				})

				Toast.fire({
					type: "success",
					title: "Anda telah Logout"
				})
			</script>');
		redirect('Kurirui/login_kurir');
	}
}
?>