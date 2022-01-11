<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include 'Enc_Dec.php';

class App extends CI_Controller {


	public function index()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'v_home',
			'jdl' => 'Dashboard',
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function brg_suplayer()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'v_suplayer',
			'jdl' => 'Barang Suplayer',
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function ubahpassword()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'ubahpassword',
			'jdl' => 'Akun Anda',
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function aksi_ubahpassword()
	{
		$username = $this->input->post('username');
		$pswlama = md5($this->input->post('pswlama'));
		$pswbaru = md5($this->input->post('pswbaru'));
		$id_admin = $this->input->post('id_admin');

		$cekpsw = $this->db->query("SELECT * FROM admin where password ='$pswlama'");
		if ($cekpsw->num_rows() == 1) {
			$this->db->where('id_admin', $id_admin);
			$this->db->update('admin', array('password'=>$pswbaru));
			$this->logoutadmin();
		} else {
			?>
			<script type="text/javascript">
				alert('password kamu salah');
				window.location="<?php echo base_url() ?>app/ubahpassword";
			</script>
			<?php
		}		
	}

	public function cek_barang()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $kode_barang = $this->input->post('kode_barang');
        $cek = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kode_barang'")->row();
		$data = array(
			'stok' => $cek->stok,
			'harga' => $cek->harga,
			'kode_barang' => $cek->kode_barang,
			'nama_barang' => $cek->nama_barang,
		);
		echo json_encode($data);
	}

	public function cek_barang_suplayer()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $kode_barang = $this->input->post('kode_barang');
        $tb = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kode_barang'")->row();
        $sp = $this->db->query("SELECT jumlah FROM setoran_suplayer WHERE kode_barang='$kode_barang'")->row();

		$data = array(
			'stok' => $tb->stok,
			'harga' => $tb->harga,
			'kode_barang' => $tb->kode_barang,
			'nama_barang' => $tb->nama_barang,
			'nama_suplayer' => $tb->nama_suplayer,
			'terjual' => $sp->jumlah - $tb->stok,
			'nominal' => ($sp->jumlah - $tb->stok)*$tb->harga_suplayer,
		);
		echo json_encode($data);
	}

	public function export_siswa()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_siswa');	
	}

	public function export_barang()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_barang');
	}

	public function hapus_semua_siswa()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->db->delete('siswa');
        redirect('siswa','refresh');
	}

	public function export_tabungan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_tabungan');
	}

	public function export_tabungan_kantin()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_tabungan_kantin');	
	}

	public function export_data_penarikan_saldo()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_data_penarikan_saldo');
	}	
	
	public function export_kantin()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_kantin');
	}

	public function export_penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_penjualan');
	}

	public function export_suplayer()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_suplayer');
	}

	// public function cek_metode()
	// {
	// 	if ($this->session->userdata('level') == "") {
 //           redirect('app/login');
 //        } 
 //        $id = $this->input->post('id');
 //        if ($id =='CASH') {
 //        	# code...
 //        } else {
 //        	
        	
 //        	<?php
 //        }
	// }

	// public function simpan_cart()
	// {
	// 	if ($this->session->userdata('level') == "") {
 //           redirect('app/login');
 //        } 
 //        $data = array(
 //            'id'    => $this->input->post('kode_barang'),
 //            'qty'   => $this->input->post('jumlah'),
 //            'price' => $this->input->post('harga'),
 //            'name'  => $this->input->post('nabar'),
 //        );
 //        $this->cart->insert($data);
 //        redirect('app/tambah_penjualan');
	// }

	// public function hapus_cart($id)
	// {
	// 	if ($this->session->userdata('level') == "") {
 //           redirect('app/login');
 //        } 
 //        $data = array(
 //            'rowid'    => $id,
 //            'qty'   => 0,
 //        );
 //        $this->cart->update($data);
 //        redirect('app/tambah_penjualan');
	// }
	

	// public function penjualan()
	// {
	// 	if ($this->session->userdata('level') == "") {
 //           redirect('app/login');
 //        } 
	// 	$data = array(
	// 		'konten' => 'penjualan',
	// 		'jdl' => 'Data Transaksi',
	// 	);
	// 	$this->load->view('admin_access/v_index',$data);
	// }

	public function cetak_stok()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$this->load->view('cetak_stok');
	}

	public function cetak_terjual()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'cetak_terjual',
			'jdl' => 'Barang Terjual',
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function aksi_cetakterjual()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * FROM penjualan_header,barang,penjualan_detail where penjualan_header.kode_penjualan = penjualan_detail.kode_penjualan and penjualan_detail.kode_barang = barang.kode_barang and penjualan_header.tgl_penjualan BETWEEN '$tgl1' and '$tgl2'");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_terjual', $data);
	}

	public function cetak_laba()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'laba',
			'jdl' => 'Laba Penjualan',
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function aksi_cetaklaba()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * FROM penjualan_header where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_laba', $data);
	}

	public function cetak_transaksi()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'transaksi',
			'jdl' => 'Transaksi Penjualan',
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function aksi_cetaktransaksi()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * FROM penjualan_header where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_transaksi', $data);
	}

	public function detail_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'detail_penjualan',
			'jdl' => 'Detail Penjualan',
			'data' => $this->db->query("SELECT * FROM penjualan_header as a, user as b WHERE a.nis=b.nis and a.kode_penjualan='$kode_penjualan'"),
		);
		$this->load->view('admin_access/v_index',$data);
	}

	public function hapus_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->delete('penjualan_header');
		$this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->delete('penjualan_detail');
		?>
		<script type="text/javascript">
			alert('Berhapus Hapus Data');
			window.location='<?php echo base_url('app/penjualan') ?>';
		</script>
		<?php
	}

	public function cetak_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM penjualan_header as a, user as b WHERE a.nis=b.nis and a.kode_penjualan='$kode_penjualan'"),
		);
		$this->load->view('cetak_penjualan',$data);
	}

	public function cetak_saldo($nis)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM tabungan as a, user as b WHERE a.nis=b.nis and a.nis='$nis'"),
		);
		$this->load->view('cetak_saldo',$data);
	}

	public function cetak_saldo_kantin($kode_kantin)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM tabungan_kantin as a, kantin as b WHERE a.kode_kantin=b.kode_kantin and a.kode_kantin='$kode_kantin'"),
		);
		$this->load->view('cetak_saldo_kantin',$data);
	}

	public function cetak_saldo_kurir($nis_kurir)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM tabungan_kurir as a, kurir as b WHERE a.nis_kurir=b.nis_kurir and a.nis_kurir='$nis_kurir'"),
		);
		$this->load->view('cetak_saldo_kurir',$data);
	}

	public function tarik_saldo() 
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
        $data = array(
        	'konten' => 'tarik_saldo',
        	'jdl' => 'Penarikan Saldo',
        );
        $this->load->view('admin_access/v_index', $data);
	}

	public function aksi_tarik_saldo_siswa()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
			$password = 'password';
			$encrypt_nis = encrypt($this->input->post('nis'), $password);
			$nis = $this->input->post('nis');
        	$jumlah_penarikan = $this->input->post('jumlah_penarikan');
        	$password = md5($this->input->post('password'));
        	$waktu = $this->input->post('waktu');
        	$siswa = $this->db->query("SELECT * FROM user WHERE nis='$nis'")->row();
        	if ($password != $siswa->password) {
        		$this->session->set_flashdata('message', '<h5>Password anda salah!<h5>');
				redirect('app/tarik_saldo');
        	}else{
        	$sql = $this->db->query("SELECT * FROM tabungan where nis='$nis'");
        	foreach ($sql->result() as $row) {
        		if ($jumlah_penarikan <= $row->saldo) {
				    $data = array(
				     'kode_penarikan' => $encrypt_nis,
				     'jumlah_penarikan' => $jumlah_penarikan,
				     'waktu' => $waktu,
				    );
				    $this->db->insert('penarikan_saldo', $data);
				    $this->db->query("UPDATE tabungan SET saldo=saldo-'$jumlah_penarikan' WHERE nis='$nis'");
				    $this->db->query("UPDATE tabungan SET waktu='$waktu' WHERE nis='$nis'");
				    $this->session->set_flashdata('message', '<h5>Penarikan berhasil.<h5>');
				    redirect('app/tarik_saldo');
				}else{
					$this->session->set_flashdata('message', '<h5>Maaf saldo anda kurang.<h5>');
					redirect('app/tarik_saldo');
				}
			}
		}
	}

	public function web_setting()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
        $data = array(
        	'konten' => 'pengaturan_web_admin',
        	'jdl' => 'Pengaturan Web',
        );
        $this->load->view('admin_access/v_index', $data);
	}

	public function aksi_tarik_saldo_kantin()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
			$password = 'password';
			$encrypt_kode = encrypt($this->input->post('kode_kantin'), $password);
			$kode_kantin = $this->input->post('kode_kantin');
			$password = md5($this->input->post('password'));
        	$jumlah_penarikan = $this->input->post('jumlah_penarikan');
        	$waktu = $this->input->post('waktu');
        	$kantin = $this->db->query("SELECT * FROM kantin where kode_kantin='$kode_kantin'")->row();
        	if ($password != $kantin->password) {
        		$this->session->set_flashdata('message', '<h5>Password anda salah!<h5>');
				redirect('app/tarik_saldo');
        	}else{
        	$sql = $this->db->query("SELECT * FROM tabungan_kantin where kode_kantin='$kode_kantin'");
        	foreach ($sql->result() as $row) {
        		if ($jumlah_penarikan <= $row->total_saldo) {
				    $data = array(
				     'kode_penarikan' => $encrypt_kode,
				     'jumlah_penarikan' => $jumlah_penarikan,
				     'waktu' => $waktu,
				    );
				    $this->db->insert('penarikan_saldo', $data);
				    $this->db->query("UPDATE tabungan_kantin SET total_saldo=total_saldo-'$jumlah_penarikan' WHERE kode_kantin='$kode_kantin'");
				    $this->db->query("UPDATE tabungan_kantin SET waktu='$waktu' WHERE kode_kantin='$kode_kantin'");
				    $this->session->set_flashdata('message', '<h5>Penarikan berhasil.<h5>');
				    redirect('app/tarik_saldo');
				}else{
					$this->session->set_flashdata('message', '<h5>Maaf saldo anda kurang.<h5>');
					redirect('app/tarik_saldo');
				}
			}
		}
	}

	public function aksi_tarik_saldo_kurir()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
			$password = 'password';
			$encrypt_kode = encrypt($this->input->post('nis_kurir'), $password);
			$nis_kurir = $this->input->post('nis_kurir');
			$password = md5($this->input->post('password'));
        	$jumlah_penarikan = $this->input->post('jumlah_penarikan');
        	$waktu = $this->input->post('waktu');
        	$kurir = $this->db->query("SELECT * FROM kurir where nis_kurir='$nis_kurir'")->row();
        	if ($password != $kurir->password) {
        		$this->session->set_flashdata('message', '<h5>Password anda salah!<h5>');
				redirect('app/tarik_saldo');
        	}else{
        	$sql = $this->db->query("SELECT * FROM tabungan_kurir where nis_kurir='$nis_kurir'");
        	foreach ($sql->result() as $row) {
        		if ($jumlah_penarikan <= $row->total_saldo) {
				    $data = array(
				     'kode_penarikan' => $encrypt_kode,
				     'jumlah_penarikan' => $jumlah_penarikan,
				     'waktu' => $waktu,
				    );
				    $this->db->insert('penarikan_saldo', $data);
				    $this->db->query("UPDATE tabungan_kurir SET total_saldo=total_saldo-'$jumlah_penarikan' WHERE nis_kurir='$nis_kurir'");
				    $this->db->query("UPDATE tabungan_kurir SET waktu='$waktu' WHERE nis_kurir='$nis_kurir'");
				    $this->session->set_flashdata('message', '<h5>Penarikan berhasil.<h5>');
				    redirect('app/tarik_saldo');
				}else{
					$this->session->set_flashdata('message', '<h5>Maaf saldo anda kurang.<h5>');
					redirect('app/tarik_saldo');
				}
			}
		}
	}

	public function tabungan_kantin()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
        $data = array(
        	'konten' => 'tabungan/tabungan_list_kantin',
        	'jdl' => 'Tabungan Kantin',
        );
        $this->load->view('admin_access/v_index', $data);
	}

	public function tabungan_kurir()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
        $data = array(
        	'konten' => 'tabungan/tabungan_list_kurir',
        	'jdl' => 'Tabungan Kurir',
        );
        $this->load->view('admin_access/v_index', $data);
	}

	public function data_penarikan_saldo()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
			$data = array(
				'konten' => 'data_penarikan_saldo',
				'jdl' => 'Data Penarikan Saldo',
			);
			$this->load->view('admin_access/v_index', $data);
	}

	public function detail_data_penarikan($id)
	{
		$row = $this->db->query("SELECT * FROM penarikan_saldo WHERE id_penarikan='$id'")->row();
		if ($row) {
			$config['per_page'] = 10;
			$this->load->library('pagination');
        	$this->pagination->initialize($config);
			$data = array(
				'kode_penarikan' => $row->kode_penarikan,
				'jumlah_penarikan' => $row->jumlah_penarikan,
				'waktu' => $row->waktu,
				'pagination' => $this->pagination->create_links(),
				'konten' => 'detail_data_penarikan',
				'jdl' => 'Detail Data Penarikan',
			);
			$this->load->view('admin_access/v_index', $data);
		}
	}

	// public function tambah_penjualan()
	// {
	// 	if ($this->session->userdata('level') == "") {
 //           redirect('app/login');
 //        } 
 //        $this->load->model('No_urut');
	// 	$data = array(
	// 		'konten' => 'form_penjualan',
	// 		'jdl' => 'Tambah Transaksi',
	// 		'kodeurut' => $this->No_urut->buat_kode_penjualan(),
	// 	);
	// 	$this->load->view('admin_access/v_index',$data);
	// }

	// public function simpan_penjualan()
	// {
	// 	if ($this->session->userdata('level') == "") {
 //           redirect('app/login');
 //        } 
 //        $kode_penjualan = $this->input->post('kode_penjualan');
 //        $nis = $this->input->post('nis');
 //        $total_harga = $this->input->post('total_harga');
 //        $tgl_penjualan = $this->input->post('tgl_penjualan');

 //        $db_saldo = $this->db->query("SELECT * FROM tabungan where nis='$nis'");
 //        $saldo = 0;
 //        foreach ($db_saldo->result() as $dt) {
 //        	$saldo = $saldo+$dt->saldo;
 //        }
 //        if ($saldo < $total_harga) {
 //        	echo '<script>alert("tabungan anda kurang");document.location.href="tambah_penjualan"</script>';
 //        }else{

	//         foreach ($this->cart->contents() as $items) {
	//         	$kode_barang = $items['id'];
	//         	$qty = $items['qty'];
	//         	$d = array(
	//         		'kode_penjualan' => $kode_penjualan,
	//         		'kode_barang' => $kode_barang,
	//         		'qty' => $qty,
	//         	);
	//         	$this->db->insert('penjualan_detail', $d);
	//         	$this->db->query("UPDATE barang SET stok=stok-'$qty' WHERE kode_barang='$kode_barang'");
	//         }

	//         $data = array(
	//             'kode_penjualan'=> $kode_penjualan,
	//             'nis'=> $nis,
	//             'total_harga'=> $total_harga,
	//             'tgl_penjualan'=> $tgl_penjualan,
	//         );
	//         $this->db->insert('penjualan_header', $data);
	//         $this->db->query("UPDATE tabungan SET saldo=saldo-'$total_harga', pengeluaran=pengeluaran+'$total_harga' WHERE nis='$nis'");
	//         $this->cart->destroy();
	//         redirect('app/penjualan');
	//       }
	// }


	public function login()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('admin_access/login');
		} else {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			
			$cek_user = $this->db->query("SELECT * FROM admin WHERE username='$username' and password='$password'");
				if ($cek_user->num_rows() == 1) {
					foreach ($cek_user->result() as $row) {
						$sess_data['id_admin'] = $row->id_admin;
						$sess_data['foto'] = $row->foto;
						$sess_data['nama'] = $row->nama;
						$sess_data['username'] = $row->username;
						$sess_data['level'] = $row->level;
						$this->session->set_userdata($sess_data);
					}
					redirect('app');
					
				} else {
					?>
					<script type="text/javascript">
						alert('Username dan password kamu salah !');
						window.location="<?php echo base_url('app/login'); ?>";
					</script>
					<?php
				}

		}
	}


	
	function logoutadmin()
	{
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		redirect('app/login');
	}

}