<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswaui extends CI_Controller {
	public function index()
	{
		if ($this->session->userdata('level') == "") {
           redirect('Siswaui/login_user');
        } 
		$data = array(
			'konten' => 'siswa_ui',
			'jdl' => 'Dashboard',
		);
		$this->load->view('user_access/index_siswa',$data);
	}

	public function data_siswa() {
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'data_siswa/data_siswa_read',
			'jdl' => 'Data Saya',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function profile_saya() {
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'profile_siswa',
			'jdl' => 'Profile Saya',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function ubah_profile_saya()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}else{
			$id_siswa = $this->session->userdata('id_siswa');
			$this->load->model('Siswa_model');
			if($_FILES['foto']['name'] == ''){
                $data = array(
            'id_siswa' => $id_siswa,
    		'username' => $this->input->post('username',TRUE),
    		'alamat' => $this->input->post('alamat',TRUE),
    		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
    		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'email' => $this->input->post('email',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'jurusan' => $this->input->post('jurusan',TRUE),
    	    );

                $this->Siswa_model->update($id_siswa, $data);
                $this->session->set_flashdata('message_berhasil', 
                	'<script>
                		Swal.fire({
                			type: "success",
                			title: "Data Berhasil Di Update",
                			showConfirmButton: false,
                			timer: 1500,
                			})
                	</script>');
                redirect(site_url('Siswaui/profile_saya'));
            }else{
                $nmfile = "siswa_".time();
                $config['upload_path'] = './image/siswa/';
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];

                $data = array(
            'id_siswa' => $id_siswa,
            'username' => $this->input->post('username',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'email' => $this->input->post('email',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'foto' => $dfile,
            'jurusan' => $this->input->post('jurusan',TRUE),
            );
                $this->Siswa_model->update($id_siswa, $data);
                $this->session->set_flashdata('message_berhasil', 
                	'<script>
                		Swal.fire({
                			type: "success",
                			title: "Data Berhasil Di Update",
                			showConfirmButton: false,
                			timer: 1500,
                			})
                	</script>');
                redirect(site_url('Siswaui/profile_saya'));
            }
		}
	}

	public function produk()
	{
		if ($this->session->userdata('level') == "") {
           redirect('siswaui/login_user');
        } 
		$data = array(
			'konten' => 'produk_barang',
			'jdl' => 'Rekomendasi',
		);
		$this->load->view('user_access/index_siswa',$data);
	}

	public function cari_barang(){
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$this->load->model('Barang_model');
		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Siswaui/cari_barang.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Siswaui/cari_barang.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Siswaui/cari_barang.html';
            $config['first_url'] = base_url() . 'Siswaui/cari_barang.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($q);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
		$data = array(
			'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'konten' => 'cari_stok',
			'jdl' => 'Cari Stok Barang',
		);
		$this->load->view('user_access/index_siswa',$data);
	}

	public function cari_kantin()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'cari_kantin',
			'jdl' => 'Cari Kantin'
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function detail_kantin($id)
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$this->load->model('Kantin_model');
		$row = $this->Kantin_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id_kantin' => $row->id_kantin,
				'kode_kantin' => $row->kode_kantin,
				'nama_kantin' => $row->nama_kantin,
				'no_hp_kantin' => $row->no_hp_kantin,
				'email' => $row->email,
				'pengurus' => $row->pengurus,
				'foto_kantin' => $row->foto_kantin,
				'konten' => 'detail_kantin',
				'jdl' => $row->nama_kantin
			);
			$this->load->view('user_access/index_siswa', $data);
		}
	}

	public function ubahpassword_siswa()
	{
		if ($this->session->userdata('level') == "") {
           redirect('siswaui/login_user');
        } 
		$data = array(
			'konten' => 'ubahpassword_siswa',
			'jdl' => 'Ubah Password',
		);
		$this->load->view('user_access/index_siswa',$data);
	}

	public function aksi_ubahpassword_siswa()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$username = $this->input->post('username');
		$pswlama = md5($this->input->post('pswlama'));
		$pswbaru = md5($this->input->post('pswbaru'));
		$nis = $this->input->post('nis');

		$cekpsw = $this->db->query("SELECT * FROM user where password ='$pswlama'");
		if ($cekpsw->num_rows() == 1) {
			$this->db->where('nis', $nis);
			$this->db->update('user', array('password'=>$pswbaru));
			$this->session->set_flashdata('message_berhasil',
				'<script>
					Swal.fire({
						type: "success",
						text: "Password kamu berhasil diganti",
						showConfirmButton: false,
						timer: 1000,
					})
				</script>');
			$this->logoutsiswa();
		} else {
			?>
			<script type="text/javascript">
				window.location="<?php echo base_url() ?>siswaui/ubahpassword_siswa";
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

	public function saldo_saya()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'tabungan_saya',
			'jdl' => 'Data Tabungan',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function data_penarikan_saldo()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'data_penarikan_siswa',
			'jdl' => 'Penarikan Saldo',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function detail_produk($id)
	{
		if ($this->session->userdata('level')== "") {
			redirect('Siswaui/login_user');
		}
		$this->load->model('Barang_model');
		$row = $this->Barang_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id_barang' => $row->id_barang,
				'kode_barang' => $row->kode_barang,
				'nama_barang' => $row->nama_barang,
				'stok' => $row->stok,
				'kategori' => $row->kategori,
				'harga_jual' => $row->harga_jual,
				'foto_barang' => $row->foto_barang,
				'qr_code' => $row->qr_code,
				'key_barang' => $row->key_barang,
				'konten' => 'detail_produk',
				'jdl' => 'Detail Produk',
			);
			$this->load->view('user_access/index_siswa', $data);
		}else{
			redirect('Siswaui/produk');
		}
	}

	public function pesan_read($id)
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$nis = $this->session->userdata('nis');
		$row = $this->db->query("SELECT * FROM pesan WHERE to_nis='$nis' and id_pesan='$id'")->row();
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
        'konten' => 'pesan_siswa/pesan_read_by_siswa',
            'jdl' => 'Pesan Masuk',
	    );
            $this->load->view('user_access/index_siswa', $data);
		}else{
			redirect('Siswaui/box_pesan');
		}
	}	

	public function box_pesan()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
			'konten' => 'pesan_siswa/box_pesan',
			'jdl' => 'Box Pesan',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function histori_tambahan()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'histori_tambahan_saldo',
			'jdl' => 'Histori Tambahan Saldo',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function pengeluaran_siswa()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'pengeluaran_siswa/pengeluaran_siswa',
			'jdl' => 'Pengeluaran',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function pengeluaran_perbulan_siswa()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'pengeluaran_siswa/pengeluaran_siswa_perbulan',
			'jdl' => 'Pengeluaran Perbulan',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function pengeluaran_perhari_siswa()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'pengeluaran_siswa/pengeluaran_siswa_perhari',
			'jdl' => 'Pengeluaran PerTanggal',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function read_data_pen_siswa($id)
	{
	$nis = $this->session->userdata('nis');
	$row = $this->db->query("SELECT * FROM penjualan_header where nis='$nis' and id_penjualan='$id'")->row();
		if ($row) {
	  		$data = array(
	    		'kode_penjualan' => $row->kode_penjualan,
	    		'nis_pembeli' => $row->nis,
	    		'total_harga' => $row->total_harga,
	    		'key_barang' => $row->key_barang,
	    		'tgl_penjualan' => $row->tgl_penjualan,
	    		'konten' => 'pengeluaran_siswa/pengeluaran_siswa_read',
	    		'jdl' => 'Detail Pembelian',
	  		);
	 		$this->load->view('user_access/index_siswa', $data);
		}else{
			redirect('Siswaui/pengeluaran_siswa');
		}
	}	

	// public function scan_qr()
	// {
	// 	if ($this->session->userdata('level') == "") {
	// 		redirect('Siswaui/login_user');
	// 	}
	// 	$data = array(
	// 		'konten' => 'scan_qr_barang',
	// 		'jdl' => 'Scan QRCode',
	// 	);
	// 	$this->load->view('user_access/index_siswa', $data);
	// }

	public function order_psn($kobar)
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$query = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kobar'");
		$i = $query->row_array();
		$kantin = $this->db->query("SELECT nama_kantin FROM kantin WHERE kode_kantin='$i[key_barang]'")->row();
		if ($this->cart->total_items() > 0) {
			foreach ($this->cart->contents() as $items) {
				foreach ($items['options'] as $namakantin) {
					if ($namakantin != $kantin->nama_kantin) {
						$this->session->set_flashdata('message_cart',
			        	'<script>
			        		Swal.fire({
			        			type: "error",
			        			text: "Gagal menambahkan ke dalam keranjang",
			        			showConfirmButton: false,
			        			timer: 1500,
			        		})
			        	</script>'
			        	);
						redirect('Siswaui/detail_produk/'.$i['id_barang']);
					}else{
						$data = array(
							'id' => $i['kode_barang'],
							'qty' => 1,
							'price' => $i['harga_jual'],
							'name' => $i['nama_barang'],
							'options' => array('nama_kantin' => $kantin->nama_kantin),
						);
						$this->cart->insert($data);
				        $this->session->set_flashdata('message_cart',
				        	'<script>
				        		Swal.fire({
				        			type: "success",
				        			text: "Berhasil menambahkan ke dalam keranjang",
				        			showConfirmButton: false,
				        			timer: 1500,
				        		})
				        	</script>'
				        );
						redirect('Siswaui/detail_produk/'.$i['id_barang']);
					}
				}
			}
		}else{
			$data = array(
				'id' => $i['kode_barang'],
				'qty' => 1,
				'price' => $i['harga_jual'],
				'name' => $i['nama_barang'],
				'options' => array('nama_kantin' => $kantin->nama_kantin),
			);
			$this->cart->insert($data);
			$this->session->set_flashdata('message_cart',
				'<script>
				    Swal.fire({
				    	type: "success",
				       	text: "Berhasil menambahkan ke dalam keranjang",
				       	showConfirmButton: false,
				      	timer: 1500,
				    })
				</script>'
			);
			redirect('Siswaui/detail_produk/'.$i['id_barang']);
		}
	}

	public function keranjang_order()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
				'metode_pembayaran' => $this->input->post('metode_pembayaran'),
				'tujuan' => $this->input->post('tujuan'),
				'tn' => $this->input->post('tn'),
				'note' => $this->input->post('note'),
				'konten' => 'pembelian_siswa/keranjang_order',
				'jdl' => 'Keranjang',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function order_pesanan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('Siswaui/login_user');
        }
        if (isset($_POST['checkout'])) {
        	$this->load->model('No_urut');
        	date_default_timezone_set('Asia/Jakarta');
        	$tujuan = $this->input->post('tujuan');
        	$metode = $this->input->post('metode_pembayaran');
        	if ($metode == '') {
        		echo "<script>document.location.href='keranjang_order'</script>";
	        	$this->session->set_flashdata('message_tujuan',
	        		'<script>
	        			Swal.fire({
	        				type: "warning",
	        				text: "Anda Belum Mengisi Metode Pembayaran!",
	        				showConfirmButton: false,
	        				timer: 1500,
	        				})
	        		</script>'
	        	);
 			}elseif($tujuan == ''){
 				echo "<script>document.location.href='keranjang_order'</script>";
	        	$this->session->set_flashdata('message_tujuan',
	        		'<script>
	        			Swal.fire({
	        				type: "warning",
	        				text: "Anda Belum Mengisi Alamat Pengiriman atau Tujuan!",
	        				showConfirmButton: false,
	        				timer: 1500,
	        				})
	        		</script>'
	        	);
 			}else{
 				if ($metode == 'COD' or $metode == 'eS-Pay Offline') {
		        	$no_invoice = $this->No_urut->get_invoice();
		        	$nama_pembeli = $this->session->userdata('nama_siswa').' - '.$this->session->userdata('nis');
		        	$total_harga = $this->cart->total();
		        	$waktu = date('Y-m-d H:i:s');
			        $nama_kurir =  $this->db->query("SELECT * FROM active_kurir WHERE order_pesanan='no' ORDER BY RAND() LIMIT 1")->row();
		        	if ($nama_kurir == '') {
		        		echo "<script>document.location.href='keranjang_order'</script>";
			        	$this->session->set_flashdata('message_tujuan',
			        		'<script>
			        			Swal.fire({
			        				type: "info",
			        				text: "Kurir Tidak Ditemukan",
			        				showConfirmButton: false,
			        				timer: 1500,
			        				})
			        		</script>'
			        );
		        	}else{
		        	$nama_kurir = $nama_kurir->nama_kurir.' - '.$nama_kurir->id_kurir;
		        	$status = 'Menunggu Konfirmasi Kurir';
		        	$note = $this->input->post('note');
		        	$data = array(
		        		'invoice_order' => $no_invoice,
		        		'nama_pembeli' => $nama_pembeli,
		        		'nama_kurir' => $nama_kurir,
		        		'pesanan' => $this->input->post('pesanan'),
		        		'kantin' => $this->input->post('nama_kantin'),
		        		'total_harga' => $total_harga,
		        		'ongkir' => $this->input->post('ongkir'),
		        		'tujuan' => $tujuan,
		        		'status' => $status,
		        		'note' => $note,
		        		'metode_pembayaran' => $metode,
		        		'waktu' => $waktu,
		        	);
					$nis = $this->session->userdata('nis');
					$this->db->query("UPDATE user SET last_order='$no_invoice' WHERE nis='$nis'");
		        	$this->db->insert('order_pesanan', $data);
		        	redirect('siswaui/cari_kurir');
		        	}
		        }elseif($metode == 'eS-Pay Online'){
		        	$nis = $this->session->userdata('nis');
		        	$tabungan = $this->db->query("SELECT * FROM tabungan WHERE nis='$nis'")->row();
		        	$ongkir = $this->input->post('ongkir');
		        	$total_harga = $this->cart->total();
		        	$total_semua = $total_harga + $ongkir;
		        	if ($tabungan->saldo < $total_semua) {
		        		echo "<script>document.location.href='keranjang_order'</script>";
			        	$this->session->set_flashdata('message_tabungan',
			        		'<script>
			        			Swal.fire({
			        				type: "warning",
			        				text: "Saldo eS-Pay anda tidak cukup!",
			        				showConfirmButton: false,
			        				timer: 1500,
			        				})
			        		</script>'
			        	);
		        	}else{
			  			$no_invoice = $this->No_urut->get_invoice();
			        	$nama_pembeli = $this->session->userdata('nama_siswa').' - '.$this->session->userdata('nis');
			        	$waktu = date('Y-m-d H:i:s');
				        $nama_kurir =  $this->db->query("SELECT * FROM active_kurir WHERE order_pesanan='no' ORDER BY RAND() LIMIT 1")->row();
			        	if ($nama_kurir == '') {
			        		echo "<script>document.location.href='keranjang_order'</script>";
				        	$this->session->set_flashdata('message_tujuan',
				        		'<script>
				        			Swal.fire({
				        				type: "info",
				        				text: "Kurir Tidak Ditemukan",
				        				showConfirmButton: false,
				        				timer: 1500,
				        				})
				        		</script>'
				        	);
			        	}else{
				        	$nama_kurir = $nama_kurir->nama_kurir.' - '.$nama_kurir->id_kurir;
				        	$status = 'Menunggu Konfirmasi Kurir';
				        	$note = $this->input->post('note');
				        	$data = array(
				        		'invoice_order' => $no_invoice,
				        		'nama_pembeli' => $nama_pembeli,
				        		'nama_kurir' => $nama_kurir,
				        		'pesanan' => $this->input->post('pesanan'),
				        		'kantin' => $this->input->post('nama_kantin'),
				        		'total_harga' => $total_harga,
				        		'ongkir' => $ongkir,
				        		'tujuan' => $tujuan,
				        		'status' => $status,
				        		'note' => $note,
				        		'metode_pembayaran' => $metode,
				        		'waktu' => $waktu,
				        	);
							$this->db->query("UPDATE user SET last_order='$no_invoice' WHERE nis='$nis'");
							$this->db->insert('order_pesanan', $data);
				        	redirect('siswaui/cari_kurir');
			        	}
		        	}
				}
			}
		}elseif (isset($_POST['update'])) {
        	$this->cart->update($_POST);
        	redirect('Siswaui/keranjang_order');
        }
	}

	public function cari_kurir()
	{
		if ($this->session->userdata('level') == "") {
           redirect('Siswaui/login_user');
        }
        $data = array(
        	'no_invoice' => $this->session->userdata('no_invoice'),
        	'konten' => 'pembelian_siswa/mencari_kurir',
        	'jdl' => 'Order',
        );
        $this->load->view('user_access/index_siswa',$data);
	}

	public function ajax_kurir()
	{
		$this->load->view('user_access/pembelian_siswa/ajax_kurir');
	}


	public function hapus_cart($id)
	{
		if ($this->session->userdata('level') == "") {
           redirect('Siswaui/login_user');
        } 
        $data = array(
            'rowid'    => $id,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect('Siswaui/keranjang_order');
	}

	public function simpan_cart()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$kobar = $this->input->post('qrcode_text');
		$query = $this->db->query("SELECT * FROM barang where kode_barang='$kobar'");
		$i = $query->row_array();
		$data = array(
			'id' => $i['kode_barang'],
			'qty' => 1,
			'price' => $i['harga_jual'],
			'name' => $i['nama_barang'],
		);
		$this->cart->insert($data);
		redirect('Siswaui/tambah_transaksi');
	}

	public function aksi_pembelian(){
		if ($this->session->userdata('level') == "") {
           redirect('Siswaui/login_user');
        }
        if (isset($_POST['bayar'])) {
	        date_default_timezone_set('Asia/Jakarta');
	        $kode_pembelian = $this->input->post('kode_pembelian');
	        $nis = $this->input->post('nis');
	        $total_harga = $this->input->post('total_harga');
	        $key = $this->input->post('key_barang');
	        $tgl_penjualan = $this->input->post('tgl_penjualan');
	        $db_saldo = $this->db->query("SELECT * FROM tabungan where nis='$nis'");
	        $saldo = 0;
        foreach ($db_saldo->result() as $dt) {
        	$saldo = $saldo + $dt->saldo;
        }
        if ($db_saldo->num_rows() == 0) {
        	echo "<script>document.location.href='tambah_transaksi'</script>";
        	$this->session->set_flashdata('message_saldo',
        		'<script>
        			Swal.fire({
        				type: "warning",
        				text: "Anda tidak memiliki tabungan!",
        				showConfirmButton: false,
        				timer: 1500,
        				})
        		</script>'
        	);
        }elseif ($saldo < $total_harga) {
        	echo "<script>document.location.href='tambah_transaksi'</script>";
        	$this->session->set_flashdata('message_saldo',
        		'<script>
        			Swal.fire({
        				type: "error",
        				text: "Saldo anda kurang!",
        				showConfirmButton: false,
        				timer: 1500,
        				})
        		</script>'
        	);
        }elseif ($this->cart->contents() == NULL) {
        	echo "<script>document.location.href='tambah_transaksi'</script>";
        	$this->session->set_flashdata('message_saldo',
        		'<script>
        			Swal.fire({
        				type: "warning",
        				text: "Cart masih kosong!",
        				showConfirmButton: false,
        				timer: 1500,
        				})
        		</script>'
        	);
        }else{
        	foreach ($this->cart->contents() as $items) {
	        	$kode_barang = $items['id'];
	        	$qty = $items['qty'];
	        	$d = array(
	        		'kode_penjualan' => $kode_pembelian,
	        		'kode_barang' => $kode_barang,
	        		'qty' => $qty,
	        	);
	        	$this->db->insert('penjualan_detail', $d);
	        	$this->db->query("UPDATE barang SET stok=stok-'$qty' WHERE kode_barang='$kode_barang'");
	        }

	        $data = array(
	            'kode_penjualan'=> $kode_pembelian,
	            'nis'=> $nis,
	            'total_harga'=> $total_harga,
	            'key_barang'=> $key,
	            'tgl_penjualan'=> $tgl_penjualan,
	        );
	        $waktu = date('Y-m-d H:i:s');
	        $this->db->insert('penjualan_header', $data);
	        $this->db->query("UPDATE tabungan SET saldo=saldo-'$total_harga', pengeluaran=pengeluaran+'$total_harga' WHERE nis='$nis'");
	        $this->db->query("UPDATE tabungan_kantin SET total_saldo=total_saldo+'$total_harga', waktu='$waktu' WHERE kode_kantin='$key'");
	        $this->cart->destroy();
	        $this->session->set_flashdata('message_berhasil',
	        	'<script>
	        		Swal.fire({
	        			type: "success",
	        			showConfirmButton: false,
	        			title: "Pembelian Berhasil",
	        			timer: 1000,
	        			})
	        	</script>'
	    	);
	        redirect('Siswaui/pengeluaran_siswa');
        }
	    }elseif(isset($_POST['update'])){
	    	$this->cart->update($_POST);
	        redirect('Siswaui/tambah_transaksi');
	    }
	}

	public function tambah_transaksi() {
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$this->load->model('No_urut');
		$data = array(
				'konten' => 'pembelian_siswa/tambah_pembelian_siswa',
				'jdl' => 'Pembelian',
				'kodeurut' => $this->No_urut->buat_kode_penjualan(),
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function like_produk($id)
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$this->load->model('Barang_model');
		$row = $this->Barang_model->get_by_id($id);
		$nis = $this->session->userdata('nis');
		$query_like = $this->db->query("SELECT * FROM like_produk where nis='$nis' and kode_barang='$row->kode_barang'");
		if ($query_like->num_rows() > 0) {
			$this->session->set_flashdata('message_like', 
				'<script>
					Swal.fire({
					type: "error",
					text: "Kamu telah memberi like ke Produk ini!",
					showConfirmButton: false,
					timer: 1000
					});
				</script>');
			redirect(site_url('Siswaui/detail_produk/'.$row->id_barang));
		}else{
			$data = array(
				'kode_barang' => $row->kode_barang,
				'nis' => $nis,
				'jum' => 1,
			);
			$this->db->insert('like_produk', $data);
			$this->session->set_flashdata('message_like', 
				'<script>
				Swal.fire({
					type: "success",
					text: "Berhasil Menambahkan Like",
					showConfirmButton: false,
					timer: 1000
					});
				</script>');
			redirect(site_url('Siswaui/detail_produk/'.$row->id_barang));
		}
	}

	public function support_app()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
			'konten' => 'support_siswa_app',
			'jdl' => 'Bantuan eS-Pay',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function pengaturan_web()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
			'konten' => 'pengaturan_web_siswa',
			'jdl' => 'Pengaturan Web',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function support_web()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
			'konten' => 'support_web_siswa',
			'jdl' => 'Support',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function masalah_akun()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'masalah_akun_siswa',
			'jdl' => 'Masalah Akun',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function bantuan_akun()
	{
		if ($this->session->userdata('level') == "") {
			redirect('Siswaui/login_user');
		}
		$data = array(
			'konten' => 'help_support_siswa',
			'jdl' => 'Bantuan Akun',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function kirim_keluhan()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
			'konten' => 'keluhan_siswa',
			'jdl' => 'Kirim Keluhan',
		);
		$this->load->view('user_access/index_siswa', $data);
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
				redirect('Siswaui/support_web');
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
				redirect('Siswaui/support_web');
          }
	}

	public function chat_kurir($id)
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$data = array(
			'id' => $id,
			'konten' => 'pembelian_siswa/chat_kurir',
			'jdl' => 'Chat Kurir',
		);
		$this->load->view('user_access/index_siswa', $data);
	}

	public function chat_history($id)
	{	
		$data = array(
			'id' => $id,
		);
		$this->load->view('user_access/pembelian_siswa/chat_history', $data);
	}

	public function beta_dark_mode()
	{
		if ($this->session->userdata('level') == "") {
			redirect('siswaui/login_user');
		}
		$this->load->view('dark_m/beta_dark_mode');
	}

	public function login_user()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('login_user');
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
			$answer = decrypt($this->input->post('asw_asc4'), $password_encrypt);
			
			$cek_siswa = $this->db->query("SELECT * FROM user WHERE username='$username'");
			if ($cek_siswa->num_rows() == 1) {
				$vr = $cek_siswa->row_array();
				if ($password == $vr['password']) {
					if ($captcha == $answer) {
				foreach ($cek_siswa->result() as $row) {
						$sess_data['id_siswa'] = $row->id_siswa;
						$sess_data['nis'] = $row->nis;
						$sess_data['nama_siswa'] = $row->nama_siswa;
						$sess_data['username'] = $row->username;
						$sess_data['alamat'] = $row->alamat;
						$sess_data['foto'] = $row->foto;
						$sess_data['tanggal_lahir'] = $row->tanggal_lahir;
						$sess_data['tempat_lahir'] = $row->tempat_lahir;
						$sess_data['jurusan'] = $row->jurusan;
						$sess_data['tanggal_pembuatan'] = $row->tanggal_pembuatan;
						$sess_data['kelas'] = $row->kelas;
						$sess_data['no_hp'] = $row->no_hp;
						$sess_data['email'] = $row->email;
						$sess_data['level'] = $row->level;
						$sess_data['no_invoice'] = $row->last_order;
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
					redirect('Siswaui');
					}else{
						$ip = $_SERVER["REMOTE_ADDR"];
						$this->db->query("INSERT INTO `ip_captcha` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
							?>
						<script type="text/javascript">
							window.location="<?php echo base_url("Siswaui/login_user"); ?>";
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
						window.location="<?php echo base_url("Siswaui/login_user"); ?>";
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
						window.location="<?php echo base_url("Siswaui/login_user"); ?>";
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


	
	function logoutsiswa()
	{
		$this->session->unset_userdata('id_siswa');
		$this->session->unset_userdata('nis');
		$this->session->unset_userdata('nama_siswa');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('alamat');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('tanggal_lahir');
		$this->session->unset_userdata('tempat_lahir');
		$this->session->unset_userdata('jurusan');
		$this->session->unset_userdata('tanggal_pembuatan');
		$this->session->unset_userdata('kelas');
		$this->session->unset_userdata('no_hp');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('no_invoice');
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
		redirect('Siswaui/login_user');
	}
}
 ?>