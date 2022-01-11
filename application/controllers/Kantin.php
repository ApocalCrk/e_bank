<?php 
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Kantin extends CI_Controller
	{
		function __construct(){
			parent::__construct();
			if ($this->session->userdata('level') == "") {
				redirect('app/login');
			}
			$this->load->model('Kantin_model');
			$this->load->model('No_urut');
			$this->load->library('form_validation');
		}

		public function index(){
	        $q = urldecode($this->input->get('q', TRUE));
	        $start = intval($this->input->get('start'));
	        
	        if ($q <> '') {
	            $config['base_url'] = base_url() . 'kantin/index.html?q=' . urlencode($q);
	            $config['first_url'] = base_url() . 'kantin/index.html?q=' . urlencode($q);
	        } else {
	            $config['base_url'] = base_url() . 'kantin/index.html';
	            $config['first_url'] = base_url() . 'kantin/index.html';
	        }

	        $config['per_page'] = 10;
	        $config['page_query_string'] = TRUE;
	        $config['total_rows'] = $this->Kantin_model->total_rows($q);
	        $kantin = $this->Kantin_model->get_limit_data($config['per_page'], $start, $q);

	        $this->load->library('pagination');
	        $this->pagination->initialize($config);

        	$data = array(
	            'kantin_data' => $kantin,
	            'q' => $q,
	            'pagination' => $this->pagination->create_links(),
	            'total_rows' => $config['total_rows'],
	            'start' => $start,
	            'konten' => 'kantin/kantin_list',
	            'jdl' => 'Data Kantin',
	        );
        	$this->load->view('admin_access/v_index', $data);
    	}

    	public function read($id){
    		$row = $this->Kantin_model->get_by_id($id);
    		if($row){
    			$data = array(
    				'id_kantin' => $row->id_kantin,
    				'kode_kantin' => $row->kode_kantin,
    				'nama_kantin' => $row->nama_kantin,
                    'no_hp_kantin' => $row->no_hp_kantin,
    				'email' => $row->email,
    				'pengurus_kantin' => $row->pengurus_kantin,
    				'foto_kantin' => $row->foto_kantin,
    				'level' => $row->level,
    				'konten' => 'kantin/kantin_read',
    				'jdl' => 'Data Kantin'
    			);
    			$this->load->view('admin_access/v_index', $data);
    		}
    	}

    	public function create(){
    		$data = array(
    			'button' => 'Create',
    			'action' => site_url('Kantin/create_action'),
    			'id_kantin' => set_value('id_kantin'),
    			'kode_kantin' => $this->No_urut->kode_kantin(),
    			'nama_kantin' => set_value('nama_kantin'),
                'no_hp_kantin' => set_value('no_hp_kantin'),
    			'email' => set_value('email'),
    			'pengurus_kantin' => set_value('pengurus_kantin'),
    			'foto_kantin' => set_value('foto_kantin'),
    			'username' => set_value('username'),
    			'password' => set_value('password'),
    			'level' => set_value('level'),
    			'konten' => 'kantin/kantin_form',
    			'jdl' => 'Data Kantin',
    		);
    		$this->load->view('admin_access/v_index', $data);
    	}

    	public function create_action(){
    		$this->_rules();
    		if ($this->form_validation->run() == FALSE) {
    			$this->create();
    		}else{
                date_default_timezone_set('Asia/Jakarta');
    			$kode_kantin = $this->input->post('kode_kantin', TRUE);
                $waktu = date('Y-m-d H:i:s');
                if ($_FILES['foto_kantin']['name'] == '') {
                    $foto = 'default.jpg';
    				$data = array(
    					'kode_kantin' => $this->input->post('kode_kantin', TRUE),
    					'nama_kantin' => $this->input->post('nama_kantin', TRUE),
                        'no_hp_kantin' => $this->input->post('no_hp_kantin', TRUE),
    					'email' => $this->input->post('email', TRUE),
    					'pengurus_kantin' => $this->input->post('pengurus_kantin', TRUE),
    					'foto_kantin' => $foto,
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
                    $data_tabungan = array(
                        'kode_kantin' =>  $this->input->post('kode_kantin', TRUE),
                        'total_saldo' => '0',
                        'waktu' => $waktu,
                    );
                    $this->db->insert('tabungan_kantin', $data_tabungan);
    				$this->Kantin_model->insert($data);
	                $this->session->set_flashdata('message', 'Create Record Success');
	                redirect(site_url('kantin'));
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
    					'kode_kantin' => $this->input->post('kode_kantin', TRUE),
    					'nama_kantin' => $this->input->post('nama_kantin', TRUE),
                        'no_hp_kantin' => $this->input->post('no_hp_kantin', TRUE),
    					'email' => $this->input->post('email', TRUE),
    					'pengurus_kantin' => $this->input->post('pengurus_kantin', TRUE),
    					'foto_kantin' => $dfile,
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
                    $data_tabungan = array(
                        'kode_kantin' =>  $this->input->post('kode_kantin', TRUE),
                        'total_saldo' => '0',
                        'waktu' => $waktu,
                    );
                    $this->db->insert('tabungan_kantin', $data_tabungan);
    				$this->Kantin_model->insert($data);
	                $this->session->set_flashdata('message', 'Create Record Success');
	                redirect(site_url('kantin'));
    			}
    		}
    	}

    	public function update($id)
    	{
    		$row = $this->Kantin_model->get_by_id($id);

    		if ($row) {
    			$data = array(
    				'button' => 'Update',
    				'action' => site_url('kantin/update_action'),
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
			        'konten' => 'kantin/kantin_form',
			        'jdl' => 'Data Kantin',
    			);
    			$this->load->view('admin_access/v_index', $data);
    		}else{
    			$this->session->set_flashdata('message', 'Record Not Found');
    			redirect(site_url('kantin'));
    		}
    	}

    	public function update_action(){
    		$this->_rules();
    		if ($this->form_validation->run() == FALSE) {
    			$this->update($this->input->post('id_kantin', TRUE));
    		}else{
    			if ($_FILES['foto_kantin']['name'] == '') {
    				$data = array(
    					'kode_kantin' => $this->input->post('kode_kantin', TRUE),
    					'nama_kantin' => $this->input->post('nama_kantin', TRUE),
                        'no_hp_kantin' => $this->input->post('no_hp_kantin', TRUE),
    					'email' => $this->input->post('email', TRUE),
    					'pengurus_kantin' => $this->input->post('pengurus_kantin', TRUE),
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
    				$this->Kantin_model->update($this->input->post('id_kantin', TRUE), $data);
    				$this->session->set_flashdata('message', 'Update Record Success');
    				redirect('kantin');
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
    					'kode_kantin' => $this->input->post('kode_kantin', TRUE),
    					'nama_kantin' => $this->input->post('nama_kantin', TRUE),
                        'no_hp_kantin' => $this->input->post('no_hp_kantin', TRUE),
    					'email' => $this->input->post('email', TRUE),
    					'pengurus_kantin' => $this->input->post('pengurus_kantin', TRUE),
    					'foto_kantin' => $dfile,
    					'username' => $this->input->post('username', TRUE),
    					'password' => md5($this->input->post('password', TRUE)),
    					'level' => $this->input->post('level', TRUE),
    				);
    				$this->Kantin_model->update($this->input->post('id_kantin', TRUE),$data);
	                $this->session->set_flashdata('message', 'Create Record Success');
	                redirect(site_url('kantin'));
    			}
    		}
    	}

    	public function delete($id) 
    {
        $row = $this->Kantin_model->get_by_id($id);

        if ($row) {
            $this->Kantin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kantin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kantin'));
        }
    }

    	public function _rules() 
	    {
		$this->form_validation->set_rules('kode_kantin', 'kode kantin', 'trim|required');
		$this->form_validation->set_rules('nama_kantin', 'nama kantin', 'trim|required');
        $this->form_validation->set_rules('no_hp_kantin', 'no hp kantin', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('pengurus_kantin', 'nama pengurus kantin', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
	    $this->form_validation->set_rules('password', 'password', 'trim|required');
	    $this->form_validation->set_rules('level', 'level', 'trim|required');


		$this->form_validation->set_rules('id_kantin', 'id_kantin', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	    }
	}
?>