<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == ""){
            redirect('app/login');
        }
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');        
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'siswa/index.html';
            $config['first_url'] = base_url() . 'siswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Siswa_model->total_rows($q);
        $siswa = $this->Siswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'siswa_data' => $siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'siswa/siswa_list',
            'jdl' => 'Data Siswa ',
        );
        $this->load->view('admin_access/v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_siswa' => $row->id_siswa,
		'nis' => $row->nis,
		'nama_siswa' => $row->nama_siswa,
		'alamat' => $row->alamat,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
        'no_hp' => $row->no_hp,
		'email' => $row->email,
        'kelas' => $row->kelas,
        'foto'  => $row->foto,
        'jurusan' => $row->jurusan,
        'konten' => 'siswa/siswa_read',
            'jdl' => 'Data Siswa',
	    );
            $this->load->view('admin_access/v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Siswa/create_action'),
	    'id_siswa' => set_value('id_siswa'),
	    'nis' => set_value('nis'),
	    'nama_siswa' => set_value('nama_siswa'),
	    'alamat' => set_value('alamat'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
        'no_hp' => set_value('no_hp'),
        'email' => set_value('email'),
        'kelas' => set_value('kelas'),
        'foto' => set_value('foto'),
        'jurusan' => set_value('jurusan'),
        'tanggal_pembuatan' => set_value('tanggal_pembuatan'),
        'username' => set_value('username'),
        'password' => set_value('password'),
        'level'    => set_value('level'),
        'konten' => 'siswa/siswa_form',
            'jdl' => 'Data Siswa',
	);
        $this->load->view('admin_access/v_index', $data);
    }

    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if ($_FILES['foto']['name'] == '') {
                $foto = 'default.png';
                $data = array(
                    'nis' => $this->input->post('nis',TRUE),
            		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
            		'alamat' => $this->input->post('alamat',TRUE),
            		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                    'no_hp' => $this->input->post('no_hp',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'kelas' => $this->input->post('kelas',TRUE),
            		'foto' => $foto,
                    'jurusan' => $this->input->post('jurusan',TRUE),
                    'tanggal_pembuatan' => date('Y-m-d'),
                    'username' => $this->input->post('username',TRUE),
                    'password' => md5($this->input->post('password',TRUE)),
                    'level' => $this->input->post('level',TRUE),
            	);

                $this->Siswa_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('siswa'));
            }else{
                $nmfile = 'siswa_'.time();
                $config['upload_path'] = './image/siswa/';
                $config['allowed_types'] = 'jpg|png';
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
                    'nis' => $this->input->post('nis',TRUE),
                    'nama_siswa' => $this->input->post('nama_siswa',TRUE),
                    'alamat' => $this->input->post('alamat',TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                    'no_hp' => $this->input->post('no_hp',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'kelas' => $this->input->post('kelas',TRUE),
                    'foto' => $dfile,
                    'jurusan' => $this->input->post('jurusan',TRUE),
                    'tanggal_pembuatan' => date('Y-m-d'),
                    'username' => $this->input->post('username',TRUE),
                    'password' => md5($this->input->post('password',TRUE)),
                    'level' => $this->input->post('level',TRUE),
                );

                $this->Siswa_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('siswa'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Siswa/update_action'),
        'id_siswa' => set_value('id_siswa', $row->id_siswa),
		'nis' => set_value('nis', $row->nis),
		'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
		'alamat' => set_value('alamat', $row->alamat),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
        'no_hp' => set_value('no_hp', $row->no_hp),
        'email' => set_value('email', $row->email),
        'kelas' => set_value('kelas', $row->kelas),
        'foto' => set_value('foto', $row->foto),
		'jurusan' => set_value('jurusan', $row->jurusan),
        'username' => set_value('username', $row->username),
        'password' => set_value('password', $row->password),
        'level' => set_value('level', $row->level),
        'konten' => 'siswa/siswa_form',
            'jdl' => 'Data Siswa',
	    );
            $this->load->view('admin_access/v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_siswa', TRUE));
        } else {
            if($_FILES['foto']['name'] == ''){
                $data = array(
            'id_siswa' => $this->input->post('id_siswa',TRUE),
            'nis' => $this->input->post('nis',TRUE),
    		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
    		'alamat' => $this->input->post('alamat',TRUE),
    		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
    		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'email' => $this->input->post('email',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'jurusan' => $this->input->post('jurusan',TRUE),
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'level' => $this->input->post('level',TRUE),
    	    );

                $this->Siswa_model->update($this->input->post('id_siswa', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('siswa'));
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
            'id_siswa' => $this->input->post('id_siswa',TRUE),
            'nis' => $this->input->post('nis',TRUE),
            'nama_siswa' => $this->input->post('nama_siswa',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'email' => $this->input->post('email',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'foto' => $dfile,
            'jurusan' => $this->input->post('jurusan',TRUE),
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'level' => $this->input->post('level',TRUE),
            );
                $this->Siswa_model->update($this->input->post('id_siswa', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('siswa'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $file_name = glob('image/siswa/$row->foto');
            unlink($files);
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nis', 'nis', 'trim|required');
	$this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
    $this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
    $this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
    $this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('level', 'level', 'trim|required');


	$this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

