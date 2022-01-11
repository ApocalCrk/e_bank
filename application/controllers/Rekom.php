<?php 
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Rekom extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if ($this->session->userdata('level') == "") {
				redirect('app/login');
			}
			$this->load->model('Rekom_model');
			$this->load->library('form_validation');
		}

		public function index()
		{
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));

			if ($q <> '') {
				$config['base_url'] = base_url() . 'rekom/index.html?q=' . urlencode($q);
				$config['first_url'] = base_url() . 'rekom/index.html?q=' . urlencode($q);
			}else{
				$config['base_url'] = base_url() . 'rekom/index.html';
				$config['first_url'] = base_url() . 'rekom/index.html';
			}

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Rekom_model->total_rows($q);
			$rekom = $this->Rekom_model->get_limit_data($config['per_page'], $start, $q);
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'rekom_data' => $rekom,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
				'konten' => 'rekomendasi/rekom_list',
				'jdl' => 'Rekomendasi SlideShow',
			);
			$this->load->view('admin_access/v_index', $data);
		}

		public function read($id)
		{
			$row = $this->Rekom_model->get_by_id($id);
			if ($row) {
				$data = array(
					'id_produk' => $row->id_produk,
					'kode_produk' => $row->kode_produk,
					'foto' => $row->foto,
					'kode_rekom' => $row->kode_rekom,
					'tgl_awal_rekom' => $row->tgl_awal_rekom,
					'tgl_akhir_rekom' => $row->tgl_akhir_rekom,
					'active' => $row->active,
				);
				$this->load->view('admin_access/v_index', $data);
			}else{
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('rekom'));
			}
		}

		public function konfir_rekom()
		{
			$data = array(
				'konten' => 'rekomendasi/konfir_rekom',
				'jdl' => 'Konfirmasi Rekomendasi',
			);
			$this->load->view('admin_access/v_index', $data);
		}

		public function konfirmasi($id)
		{
			$row = $this->Rekom_model->get_by_id($id);

			if ($row) {
				$data = array(
					'active' => '1'
				);
				$this->Rekom_model->update($id, $data);
				$this->session->set_flashdata('message', 'Confirm Record Success');
					redirect(site_url('rekom'));
			}
		}

		public function tolak($id)
		{
			$row = $this->Rekom_model->get_by_id($id);
			if ($row) {
				$data = array(
					'active' => 'Ditolak',
				);
				$this->Rekom_model->update($id, $data);
				$this->session->set_flashdata('message', 'Reject Record Success');
					redirect(site_url('rekom'));
			}
		}

		public function create()
		{
			$data = array(
				'button' => 'Create',
				'action' => site_url('Rekom/create_action'),
				'id_produk' => set_value('id_produk'),
				'kode_produk' => set_value('kode_produk'),
				'foto' => set_value('foto'),
				'tgl_awal_rekom' => set_value('tgl_awal_rekom'),
				'tgl_akhir_rekom' => set_value('tgl_akhir_rekom'),
				'active' => set_value('active'),
				'konten' => 'rekomendasi/rekom_form',
				'jdl' => 'Data Rekomendasi',
			);
			$this->load->view('admin_access/v_index', $data);
		}

		public function create_action()
		{
			 $this->_rules();

        	if ($this->form_validation->run() == FALSE) {
            	$this->create();
       		}else{
       			$nmfile = "rekom".time();
       			$config['upload_path'] = './image/All';
       			$config['allowed_types'] = 'jpg|png';
       			$config['max_size'] = '20000';
				$config['file_name'] = $nmfile;

				$this->load->library('upload', $config);
				$this->upload->do_upload('foto');
				$result1 = $this->upload->data();
				$result = array('gambar'=>$result1);
				$dfile = $result['gambar']['file_name'];
				$kode_rekom = $this->session->userdata('nama');
				$data = array(
					'kode_produk' => $this->input->post('kode_produk', TRUE),
					'foto' => $dfile,
					'kode_rekom' => $kode_rekom,
					'tgl_awal_rekom' => $this->input->post('tgl_awal_rekom', TRUE),
					'tgl_akhir_rekom' => $this->input->post('tgl_akhir_rekom', TRUE),
					'active' => $this->input->post('active', TRUE),
				);
				$this->Rekom_model->insert($data);
				$this->session->set_flashdata('message', 'Create Record Success');
				redirect(site_url('rekom'));
       		}
		}

		public function create_action_kantin()
		{
			$this->_rules();

        	if ($this->form_validation->run() == FALSE) {
            	$this->create();
       		}else{
       			$nmfile = "rekom".time();
       			$config['upload_path'] = './image/All';
       			$config['allowed_types'] = 'jpg|png';
       			$config['max_size'] = '20000';
				$config['file_name'] = $nmfile;

				$this->load->library('upload', $config);
				$this->upload->do_upload('foto');
				$result1 = $this->upload->data();
				$result = array('gambar'=>$result1);
				$dfile = $result['gambar']['file_name'];
				$kode_rekom = $this->session->userdata('nama_kantin');
				$data = array(
					'kode_produk' => $this->input->post('kode_produk', TRUE),
					'foto' => $dfile,
					'kode_rekom' => $kode_rekom,
					'tgl_awal_rekom' => $this->input->post('tgl_awal_rekom', TRUE),
					'tgl_akhir_rekom' => $this->input->post('tgl_akhir_rekom', TRUE),
					'active' => $this->input->post('active', TRUE),
				);
				$this->Rekom_model->insert($data);
				$this->session->set_flashdata('message', 
					'<script>
                    Swal.fire({
                        type: "success",
                        title: "Create Record Success",
                        showConfirmButton: false,
                        timer: 2000,
                    })
            		</script>');
				redirect(site_url('kantinui/list_rekom_kantin'));
       		}
		}

		public function update($id)
		{
			$row = $this->Rekom_model->get_by_id($id);
			if($row){
				$data = array(
					'button' => 'Update',
					'action' => site_url('Rekom/update_action'),
					'id_produk' => set_value('id_produk', $row->id_produk),
					'kode_produk' => set_value('kode_produk', $row->kode_produk),
					'foto' => set_value('foto', $row->foto),
					'tgl_awal_rekom' => set_value('tgl_awal_rekom', $row->tgl_awal_rekom),
					'tgl_akhir_rekom' => set_value('tgl_akhir_rekom', $row->tgl_akhir_rekom),
					'active' => set_value('active', $row->active),
					'konten' => 'rekomendasi/rekom_form',
					'jdl' => 'Data Rekomendasi',
				);
				$this->load->view('admin_access/v_index', $data);
			}else{
				$this->session->set_flashdata('message','Record Not Found');
				redirect(site_url('rekom'));
			}
		}

		public function update_action()
		{
			$this->_rules();
			if ($this->form_validation->run() == FALSE) {
				$this->update($this->input->post('id_produk', TRUE));
			}else{
				$this->_rules();
				if ($_FILES['foto']['name'] == '') {
					$data = array(
						'kode_produk' => $this->input->post('kode_produk', TRUE),
						'tgl_awal_rekom' => $this->input->post('tgl_awal_rekom', TRUE),
						'tgl_akhir_rekom' => $this->input->post('tgl_akhir_rekom', TRUE),
						'active' => $this->input->post('active', TRUE),
					);
					$this->Rekom_model->update($this->input->post('id_produk', TRUE), $data);
					$this->session->set_flashdata('message', 'Update Record Success');
					redirect(site_url('rekom'));
				}else{
					$nmfile = "rekom".time();
	       			$config['upload_path'] = './image/All';
	       			$config['allowed_types'] = 'jpg|png';
	       			$config['max_size'] = '20000';
					$config['file_name'] = $nmfile;

					$this->load->library('upload', $config);
					$this->upload->do_upload('foto');
					$result1 = $this->upload->data();
					$result = array('gambar'=>$result1);
					$dfile = $result['gambar']['file_name'];

					$data = array(
						'kode_produk' => $this->input->post('kode_produk', TRUE),
						'foto' => $dfile,
						'tgl_awal_rekom' => $this->input->post('tgl_awal_rekom', TRUE),
						'tgl_akhir_rekom' => $this->input->post('tgl_akhir_rekom', TRUE),
						'active' => $this->input->post('active', TRUE),
					);
					$this->Rekom_model->update($this->input->post('id_produk', TRUE), $data);
					$this->session->set_flashdata('message', 'Update Record Success');
					redirect(site_url('rekom'));
				}
			}
		}


		public function delete($id)
		{
			$row = $this->Rekom_model->get_by_id($id);

			if ($row) {
				$this->Rekom_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('rekom'));
			}else{
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('rekom'));
			}
		}

		public function delete_kantin($id)
		{
			$row = $this->Rekom_model->get_by_id($id);

			if ($row) {
				$this->Rekom_model->delete($id);
				$this->session->set_flashdata('message', 
					'<script>
                    Swal.fire({
                        type: "success",
                        title: "Delete Record Success",
                        showConfirmButton: false,
                        timer: 2000,
                    })
            		</script>');
				redirect(site_url('kantinui/list_rekom_kantin'));
			}else{
				$this->session->set_flashdata('message', 
					'<script>
                    Swal.fire({
                        type: "error",
                        title: "Record Not Found",
                        showConfirmButton: false,
                        timer: 2000,
                    })
            		</script>');
				redirect(site_url('kantinui/list_rekom_kantin'));
			}
		}

















		public function _rules() 
	    {
			$this->form_validation->set_rules('kode_produk', 'kode produk', 'trim|required');
		    $this->form_validation->set_rules('tgl_awal_rekom', 'tanggal awal rekomendasi', 'trim|required');
			$this->form_validation->set_rules('tgl_akhir_rekom', 'tanggal akhir rekomendasi', 'trim|required');
			$this->form_validation->set_rules('active', 'active', 'trim|required');

			$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
			$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	    }


	}

 ?>