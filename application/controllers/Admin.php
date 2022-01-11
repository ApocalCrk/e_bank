<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/index.html';
            $config['first_url'] = base_url() . 'admin/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_model->total_rows($q);
        $admin = $this->Admin_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_data' => $admin,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'admin/admin_list',
            'jdl' => 'Manajemen admin',
        );
        $this->load->view('admin_access/v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_admin' => $row->id_admin,
		'nama' => $row->nama,
		'username' => $row->username,
        'password' => $row->password,
		'no_hp' => $row->no_hp,
		'foto' => $row->foto,
		'level' => $row->level,
	    );
            $this->load->view('admin/admin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/create_action'),
	    'id_admin' => set_value('id_admin'),
	    'nama' => set_value('nama'),
	    'username' => set_value('username'),
        'password' => set_value('password'),
	    'no_hp' => set_value('no_hp'),
	    'foto' => set_value('foto'),
	    'level' => set_value('level'),
        'konten' => 'admin/admin_form',
            'jdl' => 'Manajemen admin',
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
                    'nama' => $this->input->post('nama',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'password' => md5($this->input->post('password',TRUE)),
                    'no_hp' => $this->input->post('no_hp',TRUE),
                    'foto' => $foto,
                    'level' => $this->input->post('level',TRUE),
                );

                $this->Admin_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('admin'));
            }else{
                $nmfile = "admin_".time();
                $config['upload_path'] = './image/user';
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
    		'nama' => $this->input->post('nama',TRUE),
    		'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
    		'no_hp' => $this->input->post('no_hp',TRUE),
    		'foto' => $dfile,
    		'level' => $this->input->post('level',TRUE),
    	    );

                $this->Admin_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('admin'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/update_action'),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'nama' => set_value('nama', $row->nama),
		'username' => set_value('username', $row->username),
        'password' => set_value('password', $row->password),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'foto' => set_value('foto', $row->foto),
        'level' => set_value('level', $row->level),
        'konten' => 'admin/admin_form',
            'jdl' => 'Manajemen admin',
	    );
            $this->load->view('admin_access/v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {

            if ($_FILES['foto']['name'] == '' ) {

                $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'level' => $this->input->post('level',TRUE),
            );

                $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('admin'));
            } else {

                $nmfile = "user_".time();
                $config['upload_path'] = './image/user';
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
            'nama' => $this->input->post('nama',TRUE),
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'foto' => $dfile,
            'level' => $this->input->post('level',TRUE),
            );

                $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('admin'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	// $this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

