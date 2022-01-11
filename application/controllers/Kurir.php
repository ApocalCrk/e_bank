<?php 
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Kurir extends CI_Controller
	{
		function __construct(){
			parent::__construct();
			if ($this->session->userdata('level') == "") {
				redirect('app/login');
			}
			$this->load->model('Kurir_model');
			$this->load->model('No_urut');
			$this->load->library('form_validation');
		}

		public function index(){
	        $q = urldecode($this->input->get('q', TRUE));
	        $start = intval($this->input->get('start'));
	        
	        if ($q <> '') {
	            $config['base_url'] = base_url() . 'kurir/index.html?q=' . urlencode($q);
	            $config['first_url'] = base_url() . 'kurir/index.html?q=' . urlencode($q);
	        } else {
	            $config['base_url'] = base_url() . 'kurir/index.html';
	            $config['first_url'] = base_url() . 'kurir/index.html';
	        }

	        $config['per_page'] = 10;
	        $config['page_query_string'] = TRUE;
	        $config['total_rows'] = $this->Kurir_model->total_rows($q);
	        $kurir = $this->Kurir_model->get_limit_data($config['per_page'], $start, $q);

	        $this->load->library('pagination');
	        $this->pagination->initialize($config);

        	$data = array(
	            'kurir_data' => $kurir,
	            'q' => $q,
	            'pagination' => $this->pagination->create_links(),
	            'total_rows' => $config['total_rows'],
	            'start' => $start,
	            'konten' => 'kurir/kurir_list',
	            'jdl' => 'Data Kurir',
	        );
        	$this->load->view('admin_access/v_index', $data);
    	}

    	public function read($id){
    		$row = $this->Kurir_model->get_by_id($id);
    		if($row){
    			$data = array(
    				'id_kurir' => $row->id_kurir,
    				'nis_kurir' => $row->nis_kurir,
    				'nama_kurir' => $row->nama_kurir,
    				'no_hp_kurir' => $row->no_hp_kurir,
    				'email_kurir' => $row->email_kurir,
    				'foto_kurir' => $row->foto_kurir,
    				'id_qrcode' => $row->id_qrcode,
    				'tanggal_pembuatan' => $row->tanggal_pembuatan,
    				'username' => $row->username,
    				'password' => $row->password,
    				'level' => $row->level,
    				'konten' => 'kurir/kurir_read',
    				'jdl' => 'Data Kurir'
    			);
    			$this->load->view('admin_access/v_index', $data);
    		}
    	}

    	public function create(){
    		$data = array(
    			'button' => 'Create',
    			'action' => 'Kurir/create_action',
    			'id_kurir' => set_value('id_kurir'),
    			'nis_kurir' => set_value('nis_kurir'),
    			'nama_kurir' => set_value('nama_kurir'),
    			'no_hp_kurir' => set_value('no_hp_kurir'),
    			'email_kurir' => set_value('email_kurir'),
    			'foto_kurir' => set_value('foto_kurir'),
    			'id_qrcode' => set_value('id_qrcode'),
    			'tanggal_pembuatan' => set_value('tanggal_pembuatan'),
    			'username' => set_value('username'),
    			'password' => set_value('password'),
    			'level' => set_value('level'),
    			'konten' => 'kurir/kurir_form',
    			'jdl' => 'Data Kurir',
    		);
    		$this->load->view('admin_access/v_index', $data);
    	}

    	public function create_action(){
    		$this->_rules();
    		if ($this->form_validation->run() == FALSE) {
    			$this->create();
    		}else{
    			date_default_timezone_set('Asia/Jakarta');
    			$waktu = date('Y-m-d H:i:s');
    			$id_qrcode = $this->input->post('nis_kurir', TRUE);
    			if ($_FILES['foto_kurir']['name'] == '') {
    				$foto = 'default.png';
    				$this->load->library('ciqrcode');
	                $config['cacheable'] = true;
	                $config['cachedir'] = './image/';
	                $config['errorlog'] = './image/';
	                $config['imagedir'] = './image/kurir_code/';
	                $config['quality'] = true;
	                $config['size'] = '1024';
	                $config['black'] = array(224,255,255);
	                $config['white'] = array(70,130,180);
	                $this->ciqrcode->initialize($config);
	                $code_name = "Kurir_".$id_qrcode.'.png';
	                $params['data'] = $id_qrcode;
	                $params['level'] = 'H';
	                $params['size'] = 10;
	                $params['savename'] = FCPATH.$config['imagedir'].$code_name;
	                $this->ciqrcode->generate($params);
    				$data = array(
    					'id_kurir' => $this->input->post('id_kurir', TRUE),
    					'nis_kurir' => $this->input->post('nis_kurir', TRUE),
    					'nama_kurir' => $this->input->post('nama_kurir', TRUE),
    					'no_hp_kurir' => $this->input->post('no_hp_kurir', TRUE),
    					'email_kurir' => $this->input->post('email_kurir', TRUE),
    					'foto_kurir' => $foto,
    					'id_qrcode' => $code_name,
    					'tanggal_pembuatan' => $waktu,
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
    				$data_tabungan = array(
    					'nis_kurir' => $this->input->post('nis_kurir'),
    					'total_saldo' => 0,
    					'waktu' => $waktu,
    				);
    				$this->db->insert('tabungan_kurir', $data_tabungan);
    				$this->Kurir_model->insert($data);
    				$this->session->set_flashdata('message', 'Create Record Success');
	                redirect(site_url('kurir'));
    			}else{
    				$nmfile = 'kurir_'.time();
	                $config['upload_path'] = './image/kurir/';
	                $config['allowed_types'] = 'jpg|png';
	                $config['max_size'] = '20000';
	                $config['file_name'] = $nmfile;
	                // load library upload
	                $this->load->library('upload', $config);
	                // upload gambar 1
	                $this->upload->do_upload('foto_kurir');
	                $result1 = $this->upload->data();
	                $result = array('gambar'=>$result1);
	                $dfile = $result['gambar']['file_name'];

    				$this->load->library('ciqrcode');
	                $config['cacheable'] = true;
	                $config['cachedir'] = './image/';
	                $config['errorlog'] = './image/';
	                $config['imagedir'] = './image/kurir_code/';
	                $config['quality'] = true;
	                $config['size'] = '1024';
	                $config['black'] = array(224,255,255);
	                $config['white'] = array(70,130,180);
	                $this->ciqrcode->initialize($config);
	                $code_name = "Kurir_".$id_qrcode.'.png';
	                $params['data'] = $id_qrcode;
	                $params['level'] = 'H';
	                $params['size'] = 10;
	                $params['savename'] = FCPATH.$config['imagedir'].$code_name;
	                $this->ciqrcode->generate($params);

	                $data = array(
    					'id_kurir' => $this->input->post('id_kurir', TRUE),
    					'nis_kurir' => $this->input->post('nis_kurir', TRUE),
    					'nama_kurir' => $this->input->post('nama_kurir', TRUE),
    					'no_hp_kurir' => $this->input->post('no_hp_kurir', TRUE),
    					'email_kurir' => $this->input->post('email_kurir', TRUE),
    					'foto_kurir' => $dfile,
    					'id_qrcode' => $code_name,
    					'tanggal_pembuatan' => $waktu,
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
    				$data_tabungan = array(
    					'nis_kurir' => $this->input->post('nis_kurir'),
    					'total_saldo' => 0,
    					'waktu' => $waktu,
    				);
    				$this->db->insert('tabungan_kurir', $data_tabungan);
    				$this->Kurir_model->insert($data);
    				$this->session->set_flashdata('message', 'Create Record Success');
	                redirect(site_url('kurir'));
    			}
    		}
    	}

    	public function update($id)
    	{
    		$row = $this->Kurir_model->get_by_id($id);
    		if ($row) {
    			$data = array(
    				'button' => 'Update',
    				'action' => site_url('Kurir/update_action'),
    				'id_kurir' => set_value('id_kurir', $row->id_kurir),
    				'nama_kurir' => set_value('nama_kurir', $row->nama_kurir),
    				'nis_kurir' => set_value('nis_kurir', $row->nis_kurir),
    				'no_hp_kurir' => set_value('no_hp_kurir', $row->no_hp_kurir),
    				'email_kurir' => set_value('email_kurir', $row->email_kurir),
    				'foto_kurir' => set_value('foto_kurir', $row->foto_kurir),
    				'username' => set_value('username', $row->username),
    				'password' => set_value('password', $row->password),
    				'level' => set_value('level', $row->level),
    				'konten' => 'kurir/kurir_form',
    				'jdl' => 'Data Kurir'
    			);
    			$this->load->view('admin_access/v_index', $data);
	        }else{
	            $this->session->set_flashdata('message', 'Record Not Found');
	            redirect(site_url('Kurir'));
	        }
    	}


    	public function update_action()
    	{
    		$this->_rules();
	        if ($this->form_validation->run() == FALSE) {
	            $this->update($this->input->post('id_kurir', TRUE));
	        } else {
	        	date_default_timezone_set('Asia/Jakarta');
    			if ($_FILES['foto_kurir']['name'] == '') {
    				$data = array(
    					'id_kurir' => $this->input->post('id_kurir', TRUE),
    					'nis_kurir' => $this->input->post('nis_kurir', TRUE),
    					'nama_kurir' => $this->input->post('nama_kurir', TRUE),
    					'no_hp_kurir' => $this->input->post('no_hp_kurir', TRUE),
    					'email_kurir' => $this->input->post('email_kurir', TRUE),
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
    				$this->Kurir_model->update($this->input->post('id_kurir', TRUE),$data);
    				$this->session->set_flashdata('message', 'Update Record Success');
	                redirect(site_url('kurir'));
    			}else{
    				$nmfile = 'kurir_'.time();
	                $config['upload_path'] = './image/kurir/';
	                $config['allowed_types'] = 'jpg|png';
	                $config['max_size'] = '20000';
	                $config['file_name'] = $nmfile;
	                // load library upload
	                $this->load->library('upload', $config);
	                // upload gambar 1
	                $this->upload->do_upload('foto_kurir');
	                $result1 = $this->upload->data();
	                $result = array('gambar'=>$result1);
	                $dfile = $result['gambar']['file_name'];
	                $data = array(
    					'id_kurir' => $this->input->post('id_kurir', TRUE),
    					'nis_kurir' => $this->input->post('nis_kurir', TRUE),
    					'nama_kurir' => $this->input->post('nama_kurir', TRUE),
    					'no_hp_kurir' => $this->input->post('no_hp_kurir', TRUE),
    					'email_kurir' => $this->input->post('email_kurir', TRUE),
    					'foto_kurir' => $dfile,
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
    				$this->Kurir_model->update($this->input->post('id_kurir'),$data);
    				$this->session->set_flashdata('message', 'Update Record Success');
	                redirect(site_url('kurir'));
    			}
	        }
    	}

    	public function delete($id) 
	    {
	        $row = $this->Kurir_model->get_by_id($id);

	        if ($row) {
	            $this->Kurir_model->delete($id);
	            $this->session->set_flashdata('message', 'Delete Record Success');
	            redirect(site_url('kurir'));
	        } else {
	            $this->session->set_flashdata('message', 'Record Not Found');
	            redirect(site_url('kurir'));
	        }
	    }





    	public function _rules() 
	    {
			$this->form_validation->set_rules('nis_kurir', 'NIS Kurir', 'trim|required');
			$this->form_validation->set_rules('nama_kurir', 'Nama Kurir', 'trim|required');
			$this->form_validation->set_rules('no_hp_kurir', 'No Hp', 'trim|required');
			$this->form_validation->set_rules('email_kurir', 'Email', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('level', 'level', 'trim|required');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	    }
	}
?>