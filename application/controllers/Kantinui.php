<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Kantinui extends CI_Controller {
		public function index()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'kantin_ui',
				'jdl' => 'Dashboard',
			);
			$this->load->view('index_kantin', $data);
		}

		public function export_all_penjualan()
		{
			$this->load->view('export_all_penjualan');
		}

		public function export_bulan_penjualan($tanggal)
		{
			$data = array(
				'tanggal' => $tanggal,
			);
			$this->load->view('export_bulan_penjualan', $data);
		}

		public function export_tanggal_penjualan($tanggal)
		{
			$data = array(
				'tanggal' => $tanggal,
			);
			$this->load->view('export_tanggal_penjualan', $data);
		}

		public function export_all_stok()
		{
			$this->load->view('export_all_stok');
		}

		public function export_bulan_stok($tanggal)
		{
			$data = array(
				'tanggal' => $tanggal,
			);
			$this->load->view('export_bulan_stok', $data);
		}

		public function export_tanggal_stok($tanggal)
		{
			$data = array(
				'tanggal' => $tanggal,
			);
			$this->load->view('export_tanggal_stok', $data);
		}

		public function data_pen_har()
		{
			$this->load->view('dash_kantin/data_kantin_dashboard');
		}
		
		public function data_barang_dash()
		{
			$this->load->view('dash_kantin/data_barang');
		}

		public function data_total_pen()
		{
			$this->load->view('dash_kantin/total_pen_dashboard');
		}

		public function data_pesan_dash()
		{
			$this->load->view('dash_kantin/total_pesan');
		}

		public function data_kantin()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_kantin/data_kantin_read',
				'jdl' => 'Data Kantin',
			);
			$this->load->view('index_kantin', $data);
		}

		public function saldo_kantin()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'tabungan_kantin',
				'jdl' => 'Tabungan Kantin',
			);
			$this->load->view('index_kantin', $data);
		}

		public function data_penarikan_saldo()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penarikan_kantin',
				'jdl' => 'Penarikan Kantin',
			);
			$this->load->view('index_kantin', $data);
		}

		public function data_barang()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'kantin_data_barang/data_barang_list',
				'jdl' => 'Data Produk/Barang Kantin',
			);
			$this->load->view('index_kantin', $data);
		}

		public function create_barang()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$this->load->model('No_urut');
			$data = array(
				'button' => 'Create',
				'action' => site_url('Barang/create_action_kantin'),
			    'id_barang' => set_value('id_barang'),
			    'kode_barang' => $this->No_urut->buat_kode_barang(),
			    'nama_barang' => set_value('nama_barang'),
			    'satuan' => set_value('satuan'),
		        'stok' => set_value('stok'),
			    'kategori' => set_value('kategori'),
		        'harga_pokok' => set_value('harga_pokok'),
		        'harga_jual' => set_value('harga_jual'),
		        'foto_barang' => set_value('foto_barang'),
		        'qr_code' => set_value('qr_code'),
		        'key_barang' => set_value('key_barang'),
		        'konten' => 'kantin_data_barang/barang_form',
		        'jdl' => 'Data Produk/Barang Kantin',
			);
			$this->load->view('index_kantin', $data);
		}

		public function update($id) 
	    {
	    	$this->load->model('Barang_model');
	    	$kode = $this->session->userdata('kode_kantin');
	        $row = $this->db->query("SELECT * FROM barang where key_barang='$kode' and id_barang='$id'")->row();

	        if ($row) {
	            $data = array(
	                'button' => 'Update',
	                'action' => site_url('barang/update_action_kantin'),
			'id_barang' => set_value('id_barang', $row->id_barang),
			'kode_barang' => set_value('kode_barang', $row->kode_barang),
			'nama_barang' => set_value('nama_barang', $row->nama_barang),
			'satuan' => set_value('satuan', $row->satuan),
	        'stok' => set_value('stok', $row->stok),
			'kategori' => set_value('kategori', $row->kategori),
	        'harga_pokok' => set_value('harga_pokok', $row->harga_pokok),
	        'harga_jual' => set_value('harga_jual', $row->harga_jual),
	        'foto_barang' => set_value('foto_barang', $row->foto_barang),
	        'key_barang'=> set_value('key_barang', $row->key_barang),
	        'konten' => 'kantin_data_barang/barang_form',
	            'jdl' => 'Data Produk/Barang Kantin',
		    );
	            $this->load->view('index_kantin', $data);
	        }else {
	            $this->session->set_flashdata('message', 
                '<script>
                    Swal.fire({
                        type: "warning",
                        title: "Record Not Found",
                        showConfirmButton: False,
                        timer: 1500,
                        })
                </script>');
	            redirect(site_url('Kantinui/data_barang'));
	        }
	    }

	    public function all_data_penjualan()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/all_data_pen',
				'jdl' => 'Data Penjualan Kantin',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function all_data_penjualan_stok()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/all_data_pen_stok',
				'jdl' => 'Data Stok Penjualan Kantin',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function perbulan_data_penjualan()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/bulan_data_pen',
				'jdl' => 'Data Penjualan Kantin',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function perbulan_data_penjualan_stok()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/bulan_data_pen_stok',
				'jdl' => 'Data Stok Penjualan Kantin',
			);
			$this->load->vieW('index_kantin', $data);
	    }
	    public function perbulan_data_laba()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/bulan_data_laba',
				'jdl' => 'Data Laba',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function pertanggal_data_penjualan()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/tanggal_data_pen',
				'jdl' => 'Data Penjualan Kantin',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function pertanggal_data_penjualan_stok()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/tanggal_data_pen_stok',
				'jdl' => 'Data Stok Penjualan Kantin',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function pertanggal_data_laba()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'data_penjualan_kantin/tanggal_data_laba',
				'jdl' => 'Data Laba',
			);
			$this->load->vieW('index_kantin', $data);
	    }

	    public function read_data_pen($id)
	    {
	    	$kode = $this->session->userdata('kode_kantin');
	    	$row = $this->db->query("SELECT * FROM penjualan_header where key_barang='$kode' and id_penjualan='$id'")->row();
	    	if ($row) {
	    		$data = array(
	    			'kode_penjualan' => $row->kode_penjualan,
	    			'nis_pembeli' => $row->nis,
	    			'total_harga' => $row->total_harga,
	    			'key_barang' => $row->key_barang,
	    			'tgl_penjualan' => $row->tgl_penjualan,
	    			'konten' => 'data_penjualan_kantin/data_pen_read',
	    			'jdl' => 'Detail Penjualan',
	    		);
	    		$this->load->view('index_kantin', $data);
	    	}else{
	    		redirect('Kantinui/all_data_penjualan');
	    	}
	    }

	    public function detail_barang($id){
	    	$kode = $this->session->userdata('kode_kantin');
	    	$row = $this->db->query("SELECT * FROM barang where key_barang='$kode' and id_barang='$id'")->row();
	    	if ($row) {
	    		$data = array(
	    			'id_barang' => $row->id_barang,
					'kode_barang' => $row->kode_barang,
			        'nama_barang' => $row->nama_barang,
					'satuan' => $row->satuan,
			        'stok' => $row->stok,
					'kategori' => $row->kategori,
			        'harga_pokok' => $row->harga_pokok,
			        'harga_jual' => $row->harga_jual,
			        'key_barang' => $row->key_barang,
			        'foto_barang' => $row->foto_barang,
			        'konten' => 'kantin_data_barang/produk_read_kantin',
			        'jdl' => 'Detail Produk/Barang'
	    		);
	    		$this->load->view('index_kantin', $data);
	    	}
	    }

	    public function list_rekom_kantin()
	    {
	    	if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'rekom_kantin/list_rekom',
				'jdl' => 'Data Rekomendasi',
			);
			$this->load->view('index_kantin', $data);
	    }

	    public function create_rekom()
		{
			$data = array(
				'button' => 'Create',
				'action' => site_url('Rekom/create_action_kantin'),
				'id_produk' => set_value('id_produk'),
				'kode_produk' => set_value('kode_produk'),
				'foto' => set_value('foto'),
				'tgl_awal_rekom' => set_value('tgl_awal_rekom'),
				'tgl_akhir_rekom' => set_value('tgl_akhir_rekom'),
				'active' => set_value('active'),
				'konten' => 'rekom_kantin/rekom_form',
				'jdl' => 'Data Rekomendasi',
			);
			$this->load->view('index_kantin', $data);
		}

		public function box_pesan()
		{
			if ($this->session->userdata('level') == "") {
				redirect('kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'pesan_kantin/box_pesan',
				'jdl' => 'Box Pesan',
			);
			$this->load->view('index_kantin', $data);
		}

		public function pesan_read($id)
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$kode_kantin = $this->session->userdata('kode_kantin');
			$row = $this->db->query("SELECT * FROM pesan WHERE to_nis='$kode_kantin' and id_pesan='$id'")->row();
			if ($row) {
	            $data = array(
	            	'id_pesan' => $row->id_pesan,
			'kode_pesan' => $row->kode_pesan,
			'pengirim' => $row->pengirim,
			'to_nis' => $row->to_nis,
			'tanggal' => $row->tanggal,
			'subjek_pesan' => $row->subjek_pesan,
			'isi_pesan' => $row->isi_pesan,
			'baca' => $row->baca,
	        'konten' => 'pesan_kantin/pesan_read_by_kantin',
	            'jdl' => 'Pesan Masuk',
		    );
	            $this->load->view('index_kantin', $data);
			}else{
				redirect('Kantinui/box_pesan');
			}
		}

		public function ubahpassword_kantin()
		{
			if ($this->session->userdata('level') == "") {
	           redirect('Kantinui/login_kantin');
	        } 
			$data = array(
				'konten' => 'ubahpassword_kantin',
				'jdl' => 'Ubah Password',
			);
			$this->load->view('index_kantin',$data);
		}

		public function aksi_ubahpassword_kantin()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$username = $this->input->post('username');
			$pswlama = md5($this->input->post('pswlama'));
			$pswbaru = md5($this->input->post('pswbaru'));
			$kode = $this->input->post('kode_kantin');

			$cekpsw = $this->db->query("SELECT * FROM kantin where password ='$pswlama'");
			if ($cekpsw->num_rows() == 1) {
				$this->db->where('kode_kantin', $kode);
				$this->db->update('kantin', array('password'=>$pswbaru));
				$this->session->set_flashdata('message_berhasil',
				'<script>
					Swal.fire({
						type: "success",
						text: "Password kamu berhasil diganti",
						showConfirmButton: false,
						timer: 1000,
					})
				</script>');
				$this->logoutkantin();
			} else {
				?>
				<script type="text/javascript">
					window.location="<?php echo base_url() ?>Kantinui/ubahpassword_kantin";
				</script>
				<?php
				$this->session->set_flashdata('message_ubah',
					'<script>
						Swal.fire({
							type: "error",
							text: "Password kamu salah !",
							showConfirmButton: false,
							timer: 2000
							})
					</script>');
			}		
		}

		public function edit_data_kantin()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$kode = $this->session->userdata('kode_kantin');
			$row = $this->db->query("SELECT * FROM kantin where kode_kantin='$kode'")->row();
			if($row){
				$data = array(
					'action' => site_url('kantinui/action_edit_data'),
	    			'id_kantin' => set_value('id_kantin', $row->id_kantin),
	    			'kode_kantin' => set_value('kode_kantin', $row->kode_kantin),
	    			'nama_kantin' => set_value('nama_kantin', $row->nama_kantin),
	    			'no_hp_kantin' => set_value('no_hp_kantin', $row->no_hp_kantin),
	    			'email' => set_value('email', $row->email),
	   				'pengurus_kantin' => set_value('pengurus_kantin', $row->pengurus_kantin),
	   				'foto_kantin' => set_value('foto_kantin', $row->foto_kantin),
	   				'username' => set_value('username', $row->username),
	   				'password' => set_value('password', $row->password),
	    			'level' => set_value('level', $row->level),
				    'konten' => 'data_kantin/edit_data_kantin',
			        'jdl' => 'Data Kantin',
				);
				$this->load->view('index_kantin', $data);
			}
		}

		public function action_edit_data(){
			$id_kantin = $this->session->userdata('id_kantin');
			$this->load->model('Kantin_model');
			if ($_FILES['foto_kantin']['name'] == '') {
    				$data = array(
    					'nama_kantin' => $this->input->post('nama_kantin', TRUE),
                        'no_hp_kantin' => $this->input->post('no_hp_kantin', TRUE),
    					'email' => $this->input->post('email', TRUE),
    					'pengurus_kantin' => $this->input->post('pengurus_kantin', TRUE),
    					'username' => $this->input->post('username', TRUE),
    				);
    				$this->Kantin_model->update($id_kantin, $data);
    				$this->session->set_flashdata('message_berhasil', 
                	'<script>
                		Swal.fire({
                			type: "success",
                			title: "Data Berhasil Di Update",
                			showConfirmButton: false,
                			timer: 1500,
                			})
                	</script>');
    				redirect(site_url('kantinui/data_kantin'));
    			}else{
    				$nmfile = 'kantin_'.time();
	                $config['upload_path'] = './image/kantin/';
	                $config['allowed_types'] = 'jpg|png';
	                $config['max_size'] = '20000';
	                $config['file_name'] = $nmfile;
	                // load library upload
	                $this->load->library('upload', $config);
	                // upload gambar 1
	                $this->upload->do_upload('foto_kantin');
	                $result1 = $this->upload->data();
	                $result = array('gambar'=>$result1);
	                $dfile = $result['gambar']['file_name'];

	                $data = array(
    					'nama_kantin' => $this->input->post('nama_kantin', TRUE),
                        'no_hp_kantin' => $this->input->post('no_hp_kantin', TRUE),
    					'email' => $this->input->post('email', TRUE),
    					'pengurus_kantin' => $this->input->post('pengurus_kantin', TRUE),
    					'foto_kantin' => $dfile,
    					'username' => $this->input->post('username', TRUE),
    				);
    				$this->Kantin_model->update($id_kantin,$data);
	                $this->session->set_flashdata('message_berhasil', 
                	'<script>
                		Swal.fire({
                			type: "success",
                			title: "Data Berhasil Di Update",
                			showConfirmButton: false,
                			timer: 1500,
                			})
                	</script>');
	                redirect(site_url('kantinui/data_kantin'));
    			}
		}

		public function cetak_qr($id)
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$kode = $this->session->userdata('kode_kantin');
			$row = $this->db->query("SELECT qr_code FROM barang WHERE id_barang='$id' and key_barang='$kode'")->row();
			if ($row) {
				$data = array(
				'qr_code' => $row->qr_code,
				);
			}
			$this->load->view('cetak_qrcode', $data);
		}

		public function export_barang_kantin()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'kode_kantin' => $this->session->userdata('kode_kantin'),
			);
			$this->load->view('export_barang_kantin', $data);
		}

		public function support_app()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'support_kantin_app',
				'jdl' => 'Bantuan eS-Pay',
			);
			$this->load->view('index_kantin', $data);
		}

		public function pengaturan_web()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'pengaturan_web_kantin',
				'jdl' => 'Pengaturan Web',
			);
			$this->load->view('index_kantin', $data);
		}

		public function support_web()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'support_web_kantin',
				'jdl' => 'Support',
			);
			$this->load->view('index_kantin', $data);
		}

		public function masalah_akun()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'masalah_akun_kantin',
				'jdl' => 'Masalah Akun',
			);
			$this->load->view('index_kantin', $data);
		}

		public function bantuan_akun()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'help_support_kantin',
				'jdl' => 'Bantuan Akun',
			);
			$this->load->view('index_kantin', $data);
		}

		public function kirim_keluhan()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$data = array(
				'konten' => 'keluhan_kantin',
				'jdl' => 'Kirim Keluhan',
			);
			$this->load->view('index_kantin', $data);
		}

		public function aksi_kirim_keluhan()
		{
			$from = $this->input->post('from');
			$nama = $this->session->userdata('username');
	 		$to = $this->input->post('to');
			$subjek = $this->input->post('subjek');
			$isi_pesan = $this->input->post('isi_pesan');
			$config['mailtype'] = 'text';
	          $config['protocol'] = 'smtp';
	          $config['smtp_host'] = 'smtp.mailtrap.io';
	          $config['smtp_user'] = '059e66de63eb62';
	          $config['smtp_pass'] = '843693b5a9b654';
	          $config['smtp_port'] = '2525';
	          $config['newline'] = "\r\n";

	          $this->load->library('email', $config);

	          $this->email->from($from, $nama);
	          $this->email->to($to);
	          $this->email->subject($subjek);
	          $this->email->message($isi_pesan);

	          if($this->email->send()) {
	               $this->session->set_flashdata('message',
					'<script>
						Swal.fire({
							type: "success",
							text: "Behasil mengirim keluhan",
							showConfirmButton: false,
							timer: 1000,
							});
					</script>');
					redirect('Kantinui/support_web');
	          }else {
	               $this->session->set_flashdata('message',
					'<script>
						Swal.fire({
							type: "error",
							text: "Gagal Mengirim Keluhan",
							showConfirmButton: false,
							timer: 1000,
							});
					</script>');
					redirect('Kantinui/support_web');
	          }
		}

		public function beta_dark_mode()
		{
			if ($this->session->userdata('level') == "") {
				redirect('Kantinui/login_kantin');
			}
			$this->load->view('beta_dark_mode');
		}

		public function login_kantin()
		{
			if ($this->input->post() == NULL) {
				$this->load->view('login_kantin');
			}else{
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

				$cek_user = $this->db->query("SELECT * FROM kantin WHERE username='$username'");
				if ($cek_user->num_rows() == 1) {
					$vr = $cek_user->row_array();
					if ($password == $vr['password']) {
						if ($captcha == $answer) {
						foreach($cek_user->result() as $row){
							$sess_data['id_kantin'] = $row->id_kantin;
							$sess_data['kode_kantin'] = $row->kode_kantin;
							$sess_data['nama_kantin'] = $row->nama_kantin;
							$sess_data['no_hp_kantin'] = $row->no_hp_kantin;
							$sess_data['email'] = $row->email;
							$sess_data['pengurus_kantin'] = $row->pengurus_kantin;
							$sess_data['foto_kantin'] = $row->foto_kantin;
							$sess_data['username'] = $row->username;
							$sess_data['level'] = $row->level;
							$this->session->set_userdata($sess_data);
						}
						redirect('Kantinui');
						}else{
							$ip = $_SERVER["REMOTE_ADDR"];
							$this->db->query("INSERT INTO `ip_captcha` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
							?>
							<script type="text/javascript">
								window.location="<?php echo base_url("Kantinui/login_kantin"); ?>";
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
						window.location="<?php echo base_url("Kantinui/login_kantin"); ?>";
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
				}else {
					$ip = $_SERVER["REMOTE_ADDR"];
					$this->db->query("INSERT INTO `ip_captcha` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
					?>
					<script type="text/javascript">
						window.location="<?php echo base_url("Kantinui/login_kantin"); ?>";
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


		function logoutkantin()
		{
			$this->session->unset_userdata('id_kantin');
			$this->session->unset_userdata('kode_kantin');
			$this->session->unset_userdata('nama_kantin');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('no_hp_kantin');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('pengurus_kantin');
			$this->session->unset_userdata('foto_kantin');
			$this->session->unset_userdata('level');
			redirect('Kantinui/login_kantin');
		}
	}
?>