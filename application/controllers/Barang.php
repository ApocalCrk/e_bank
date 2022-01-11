<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') == ""){
            redirect('app/login');
        }
        $this->load->model('Barang_model');
        $this->load->model('No_urut');
        $this->load->library('ciqrcode');
        $this->load->library('form_validation');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    public function upload(){
  $fileName = $this->input->post('file', TRUE);

  $config['upload_path'] = './upload/'; 
  $config['file_name'] = $fileName;
  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
  $config['max_size'] = 10000;

  $this->load->library('upload', $config);
  $this->upload->initialize($config); 
  
  if (!$this->upload->do_upload('file')) {
   $error = array('error' => $this->upload->display_errors());
   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
   redirect('import'); 
  } else {
   $media = $this->upload->data();
   $inputFileName = 'upload/'.$media['file_name'];
   
   try {
    $inputFileType = IOFactory::identify($inputFileName);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   }

   $sheet = $objPHPExcel->getSheet(0);
   $highestRow = $sheet->getHighestRow();
   $highestColumn = $sheet->getHighestColumn();

   for ($row = 2; $row <= $highestRow; $row++){  
     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
       NULL,
       TRUE,
       FALSE);
     $data = array(
                    'id_barang' => '',
                    'kode_barang' => $rowData[0][0],
                    'nama_barang' => $rowData[0][1],
                    'stok' => $rowData[0][2],
                    'kategori' => $rowData[0][3],
                    'harga' => $rowData[0][4],
                    'foto_barang' => $rowData[0][5],
                    'key_barang' => $rowData[0][7],
                );
    $this->db->insert("barang",$data);
   } 
   ?>
   <script type="text/javascript">
     alert('berhasil upload data !');
     window.location='<?php echo base_url() ?>barang/';
   </script>
   <?php
  }  
 }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
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
            'konten' => 'barang/barang_list',
            'jdl' => 'Data Barang',
        );
        $this->load->view('admin_access/v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_barang' => $row->id_barang,
		'kode_barang' => $row->kode_barang,
        'nama_barang' => $row->nama_barang,
		'satuan' => $row->satuan,
        'stok' => $row->stok,
		'kategori' => $row->kategori,
        'harga_jual' => $row->harga_jual,
        'key_barang' => $row->key_barang,
        'foto_barang' => $row->foto_barang,
        'konten' => 'barang/barang_read',
        'jdl' => 'Detail Produk/Barang'
	    );
            $this->load->view('admin_access/v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Barang/create_action'),
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
        'konten' => 'barang/barang_form',
            'jdl' => 'Data Produk/Barang',
	);
        $this->load->view('admin_access/v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if ($_FILES['foto_barang']['name'] == '') {
                $dfile = 'default.jpg';
                $kode_barang = $this->input->post('kode_barang', TRUE);

                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './image/';
                $config['errorlog'] = './image/';
                $config['imagedir'] = './image/barang/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(224,255,255);
                $config['white'] = array(70,130,180);
                $this->ciqrcode->initialize($config);
                $image_name = "Barang_".time().'.png';
                $params['data'] = $kode_barang;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->generate($params);

                $data = array(
                    'kode_barang' => $this->input->post('kode_barang',TRUE),
                    'nama_barang' => $this->input->post('nama_barang',TRUE),
                    'satuan' => $this->input->post('satuan',TRUE),
                    'stok' => $this->input->post('stok',TRUE),
                    'kategori' => $this->input->post('kategori',TRUE),
                    'harga_pokok' => $this->input->post('harga_pokok',TRUE),
                    'harga_jual' => $this->input->post('harga_jual',TRUE),
                    'foto_barang' => $dfile,
                    'qr_code' => $image_name,
                    'key_barang' => $this->input->post('key_barang', TRUE),
                    );
                $this->Barang_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('barang'));

            }else{
                $kode_barang = $this->input->post('kode_barang', TRUE);

                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './image/';
                $config['errorlog'] = './image/';
                $config['imagedir'] = './image/barang/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(224,255,255);
                $config['white'] = array(70,130,180);
                $this->ciqrcode->initialize($config);
                $image_name = "Barang_".time().'.png';
                $params['data'] = $kode_barang;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->generate($params);

                $nmfile = 'Barang_'.time();
                $config['upload_path'] = './image/barang_view/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto_barang');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];

                $data = array(
                    'kode_barang' => $this->input->post('kode_barang',TRUE),
                    'nama_barang' => $this->input->post('nama_barang',TRUE),
                    'satuan' => $this->input->post('satuan',TRUE),
                    'stok' => $this->input->post('stok',TRUE),
                    'kategori' => $this->input->post('kategori',TRUE),
                    'harga_pokok' => $this->input->post('harga_pokok',TRUE),
                    'harga_jual' => $this->input->post('harga_jual',TRUE),
                    'foto_barang' => $dfile,
                    'qr_code' => $image_name,
                    'key_barang' => $this->input->post('key_barang', TRUE),
                    );
                $this->Barang_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('barang'));
            }
        } 
    }

    public function create_action_kantin() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if ($_FILES['foto_barang']['name'] == '') {
                $dfile = 'default.jpg';
                $kode_barang = $this->input->post('kode_barang', TRUE);

                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './image/';
                $config['errorlog'] = './image/';
                $config['imagedir'] = './image/barang/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(224,255,255);
                $config['white'] = array(70,130,180);
                $this->ciqrcode->initialize($config);
                $image_name = "Barang_".time().'.png';
                $params['data'] = $kode_barang;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->generate($params);

                $data = array(
                    'kode_barang' => $this->input->post('kode_barang',TRUE),
                    'nama_barang' => $this->input->post('nama_barang',TRUE),
                    'satuan' => $this->input->post('satuan',TRUE),
                    'stok' => $this->input->post('stok',TRUE),
                    'kategori' => $this->input->post('kategori',TRUE),
                    'harga_pokok' => $this->input->post('harga_pokok',TRUE),
                    'harga_jual' => $this->input->post('harga_jual',TRUE),
                    'foto_barang' => $dfile,
                    'qr_code' => $image_name,
                    'key_barang' => $this->input->post('key_barang', TRUE),
                    );
                $this->Barang_model->insert($data);
                $this->session->set_flashdata('message', 
                    '<script>
                        Swal.fire({
                            type: "success",
                            title: "Create Record Success",
                            showConfirmButton: false,
                            timer: 1500,
                            })
                    </script>');
                redirect(site_url('Kantinui/data_barang'));
            }else{
                $kode_barang = $this->input->post('kode_barang', TRUE);

                $this->load->library('ciqrcode');
                $config['cacheable'] = true;
                $config['cachedir'] = './image/';
                $config['errorlog'] = './image/';
                $config['imagedir'] = './image/barang/';
                $config['quality'] = true;
                $config['size'] = '1024';
                $config['black'] = array(224,255,255);
                $config['white'] = array(70,130,180);
                $this->ciqrcode->initialize($config);
                $image_name = "Barang_".time().'.png';
                $params['data'] = $kode_barang;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name;
                $this->ciqrcode->generate($params);

                $nmfile = 'Barang_'.time();
                $config['upload_path'] = './image/barang_view/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto_barang');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];

                $data = array(
            		'kode_barang' => $this->input->post('kode_barang',TRUE),
                    'nama_barang' => $this->input->post('nama_barang',TRUE),
            		'satuan' => $this->input->post('satuan',TRUE),
                    'stok' => $this->input->post('stok',TRUE),
                    'kategori' => $this->input->post('kategori',TRUE),
            		'harga_pokok' => $this->input->post('harga_pokok',TRUE),
                    'harga_jual' => $this->input->post('harga_jual',TRUE),
                    'foto_barang' => $dfile,
                    'qr_code' => $image_name,
                    'key_barang' => $this->input->post('key_barang', TRUE),
            	    );
                $this->Barang_model->insert($data);
                $this->session->set_flashdata('message', 
                    '<script>
                        Swal.fire({
                            type: "success",
                            title: "Create Record Success",
                            showConfirmButton: false,
                            timer: 1500,
                            })
                    </script>');
                redirect(site_url('Kantinui/data_barang'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
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
        'konten' => 'barang/barang_form',
            'jdl' => 'Data Produk/Barang',
	    );
            $this->load->view('admin_access/v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            if ($_FILES['foto_barang']['name'] == '') {
            $data = array(
            'kode_barang' => $this->input->post('kode_barang',TRUE),
            'nama_barang' => $this->input->post('nama_barang',TRUE),
            'satuan' => $this->input->post('satuan',TRUE),
            'stok' => $this->input->post('stok',TRUE),
            'kategori' => $this->input->post('kategori',TRUE),
            'harga_pokok' => $this->input->post('harga_pokok',TRUE),
            'harga_jual' => $this->input->post('harga_jual',TRUE),
            'key_barang' => $this->input->post('key_barang', TRUE),
            );

            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);    
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang'));
            }else{
                $nmfile = "Barang_".time();
                $config['upload_path'] = './image/barang_view/';
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto_barang');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];
                $data = array(
                'kode_barang' => $this->input->post('kode_barang',TRUE),
                'nama_barang' => $this->input->post('nama_barang',TRUE),
                'satuan' => $this->input->post('satuan',TRUE),
                'stok' => $this->input->post('stok',TRUE),
                'kategori' => $this->input->post('kategori',TRUE),
                'harga_pokok' => $this->input->post('harga_pokok',TRUE),
                'harga_jual' => $this->input->post('harga_jual',TRUE),
                'foto_barang' => $dfile,
                'key_barang' => $this->input->post('key_barang', TRUE),
                );
                $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('barang'));
            }
        }
    }

    public function update_action_kantin() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            if ($_FILES['foto_barang']['name'] == '') {
            $data = array(
    		'kode_barang' => $this->input->post('kode_barang',TRUE),
            'nama_barang' => $this->input->post('nama_barang',TRUE),
    		'satuan' => $this->input->post('satuan',TRUE),
            'stok' => $this->input->post('stok',TRUE),
            'kategori' => $this->input->post('kategori',TRUE),
    		'harga_pokok' => $this->input->post('harga_pokok',TRUE),
            'harga_jual' => $this->input->post('harga_jual',TRUE),
            'key_barang' => $this->input->post('key_barang', TRUE),
    	    );

            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);    
            $this->session->set_flashdata('message', 
            '<script>
                    Swal.fire({
                        type: "success",
                        title: "Update Record Success",
                        showConfirmButton: false,
                        timer: 2000,
                    })
            </script>');
            redirect(site_url('Kantinui/data_barang'));
            }else{
                $nmfile = "Barang_".time();
                $config['upload_path'] = './image/barang_view/';
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto_barang');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];
                $data = array(
                'kode_barang' => $this->input->post('kode_barang',TRUE),
                'nama_barang' => $this->input->post('nama_barang',TRUE),
                'satuan' => $this->input->post('satuan',TRUE),
                'stok' => $this->input->post('stok',TRUE),
                'kategori' => $this->input->post('kategori',TRUE),
                'harga_pokok' => $this->input->post('harga_pokok',TRUE),
                'harga_jual' => $this->input->post('harga_jual',TRUE),
                'foto_barang' => $dfile,
                'key_barang' => $this->input->post('key_barang', TRUE),
                );
                $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
                $this->session->set_flashdata('message', 
                '<Script>
                    Swal.fire({
                        type: "success",
                        title: "Update Record Success",
                        showConfirmButton: false,
                        timer: 1500,
                        })
                </script>');
                redirect(site_url('Kantinui/data_barang'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function delete_for_kantin($id) 
    {
        $kode = $this->session->userdata('kode_kantin');
        $row = $this->db->query("SELECT * FROM barang where key_barang='$kode' and id_barang='$id'")->row();

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 
                '<Script>
                    Swal.fire({
                        type: "success",
                        title: "Delete Record Success",
                        showConfirmButton: false,
                        timer: 1500,
                        })
                </script>');
            redirect(site_url('Kantinui/data_barang'));
        } else {
            $this->session->set_flashdata('message', 
                '<Script>
                    Swal.fire({
                        type: "warning",
                        title: "Record Not Found",
                        showConfirmButton: false,
                        timer: 1500,
                        })
                </script>');
            redirect(site_url('Kantinui/data_barang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
    $this->form_validation->set_rules('stok', 'stok', 'trim|required');
    $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
    $this->form_validation->set_rules('harga_pokok', 'harga pokok', 'trim|required');
    $this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');

	$this->form_validation->set_rules('id_barang', 'id_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

