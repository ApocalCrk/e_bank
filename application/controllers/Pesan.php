<?php 
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pesan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('level') == ""){
			redirect('app/login');
		}
		$this->load->model('Pesan_model');
		$this->load->model('No_urut');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pesan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pesan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pesan/index.html';
            $config['first_url'] = base_url() . 'pesan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pesan_model->total_rows($q);
        $pesan = $this->Pesan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pesan_data' => $pesan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'pesan/pesan_list',
            'jdl' => 'Data Pesan ',
        );
        $this->load->view('admin_access/v_index', $data);
    }

	public function read($id)
	{
		$row = $this->Pesan_model->get_by_id($id);
		if($row) {
			$data = array(
		'id_pesan' => $row->id_pesan,
		'kode_pesan' => $row->kode_pesan,
		'pengirim' => $row->pengirim,
		'to_nis' => $row->to_nis,
		'tanggal' => $row->tanggal,
		'subjek_pesan' => $row->subjek_pesan,
		'isi_pesan' => $row->isi_pesan,
		'baca' => $row->baca,
		'konten' => 'pesan/pesan_read',
			'jdl' => 'Data Pesan',
		);
			$this->load->view('admin_access/v_index', $data);
		}else{
			$this->session->set_flashdata('message', 'Message Not Found');
			redirect(site_url('pesan'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Kirim',
			'action' => site_url('Pesan/create_action'),
		'id_pesan' => set_value('id_pesan'),
		'kode_pesan' => $this->No_urut->kode_pesan(),
		'pengirim' => set_value('pengirim'),
		'to_nis' => set_value('to_nis'),
		'tanggal' => set_value('tanggal'),
		'subjek_pesan' => set_value('subjek_pesan'),
		'isi_pesan' => set_value('isi_pesan'),
		'baca' => set_value('baca'),
		'konten' => 'pesan/pesan_form',
			'jdl' => 'Data Pesan',
		);
		$this->load->view('admin_access/v_index', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$kode_pesan = $this->input->post('kode_pesan',TRUE);
			$stat = 'belum';
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
			$password = 'password';
			$encrypt_str = encrypt($this->input->post('isi_pesan', TRUE), $password);
			$data = array(
				'id_pesan' => $this->input->post('id_pesan',TRUE),
				'kode_pesan' => $this->input->post('kode_pesan',TRUE),
				'pengirim' => $this->input->post('pengirim',TRUE),
				'to_nis' => $this->input->post('to_nis',TRUE),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'subjek_pesan' => $this->input->post('subjek_pesan',TRUE),
				'isi_pesan' => $encrypt_str,
				'baca' => $stat,
			);
			$this->Pesan_model->insert($data);
			$this->session->set_flashdata('message', 'Send Message Success');
			redirect(site_url('pesan'));
		}
		
	}

	public function update($id)
	{
		$row = $this->Pesan_model->get_by_id($id);
		if($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('pesan/update_action'),
				'id_pesan' => set_value('id_pesan', $row->id_pesan),
				'kode_pesan' => set_value('kode_pesan', $row->kode_pesan),
				'pengirim' => set_value('pengirim', $row->pengirim),
				'to_nis' => set_value('to_nis', $row->to_nis),
				'tanggal' => set_value('tanggal', $row->tanggal),
				'subjek_pesan' => set_value('subjek_pesan', $row->subjek_pesan),
				'isi_pesan' => set_value('isi_pesan', $row->isi_pesan),
				'baca' => set_value('baca', $row->baca),
				'konten' => 'pesan/pesan_form',
				'jdl' => 'Data Pesan',
			);
			$this->load->view('admin_access/v_index', $data);
		}else{
			$this->session->set_flashdata('message', 'Message Not Found');
			redirect(site_url('pesan'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_pesan', TRUE));
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
			$password = 'password';
			$encrypt_str_up = encrypt($this->input->post('isi_pesan', TRUE), $password);
			$data = array(
				'id_pesan' => $this->input->post('id_pesan', TRUE),
				'kode_pesan' => $this->input->post('kode_pesan', TRUE),
				'pengirim' => $this->input->post('pengirim', TRUE),
				'to_nis' => $this->input->post('to_nis', TRUE),
				'tanggal' => $this->input->post('tanggal', TRUE),
				'subjek_pesan' => $this->input->post('subjek_pesan', TRUE),
				'isi_pesan' => $encrypt_str_up,
			);
			$this->Pesan_model->update($this->input->post('id_pesan', TRUE), $data);
		}
		$this->session->set_flashdata('message', 'Update message Success');
		redirect(site_url('pesan'));
	}


	public function delete($id) 
    {
        $row = $this->Pesan_model->get_by_id($id);

        if ($row) {
            $this->Pesan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Message Success');
            redirect(site_url('pesan'));
        } else {
            $this->session->set_flashdata('message', 'Message Not Found');
            redirect(site_url('pesan'));
        }
    }
























	public function _rules() 
    {
	$this->form_validation->set_rules('pengirim', 'pengirim', 'trim|required');
	$this->form_validation->set_rules('to_nis', 'to nis', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('subjek_pesan', 'subjek pesan', 'trim|required');
	$this->form_validation->set_rules('isi_pesan', 'isi pesan', 'trim|required');

	$this->form_validation->set_rules('id_pesan', 'id_pesan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }



















}


 ?>