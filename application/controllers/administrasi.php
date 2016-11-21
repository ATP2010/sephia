<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
        $this->load->library('form_validation');
    }

	public function index()
	{
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='administrasi') {
				$isi['judul'] = "Home";
				$isi['sub_judul'] = "Info";

				$in=$this->db->query("select count(logid) as tot_in from input_tiket where sta='0'");
            	$out=$this->db->query("select count(logid) as tot_out from input_tiket where sta='1'");
            	$tot=$this->db->query("select count(logid) as tot from input_tiket");            	
            	$q=$this->db->query("select count(logid) as ag from input_tiket group by logid");	
            	$r=$q->num_rows();
            	
           
            	$isi['tk_in']=$in;
            	$isi['tk_out']=$out;
				$isi['tot']=$tot;
				$isi['ag']=$r;

				$this->load->view('design/atas2');
				$this->load->view('administrasi/menu',$isi);
				$this->load->view('administrasi/home',$isi);
				$this->load->view('design/bawah2');
			}
			else
			{ redirect('web'); }
	}

	public function input_data() {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='administrasi') {
            $isi['action'] = site_url('administrasi/act_input_data');
            
            $isi['judul'] = 'Data Aplikasi';
            $isi['sub_judul'] = "Input data";
            
            $this->load->model('m_agent');
            $isi['jns_tiket'] = $this->m_agent->get_jenis_tiket();
            $isi['kary'] = $this->m_agent->get_kary();
            $isi['jab'] = $this->m_agent->get_jab();

            $this->load->view('design/atas2');
            $this->load->view('administrasi/menu',$isi);
            $this->load->view('administrasi/input_data',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); }        
    }

    public function act_input_data(){
    	$this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->input_data();
        } else {
        $data = array(
            'nama' => $this->input->post('nama'),
            'jab' => $this->input->post('jab'),
            'batch' => $this->input->post('batch'),
            'tgl_in' => $this->input->post('tgl_in'),
            'tgl_out' => $this->input->post('tgl_out'),
            'avaya' => $this->input->post('avaya'),
            'siska' => $this->input->post('siska'),
            'cx' => $this->input->post('cx'),
            'nossa' => $this->input->post('nossa'),
            'ibooster' => $this->input->post('ibooster'),
            't3ol' => $this->input->post('t3ol'),
            'startklik' => $this->input->post('startklik'),
            'webcare' => $this->input->post('webcare'),
            'payment' => $this->input->post('payment'),
            'kms' => $this->input->post('kms'),
            'soap' => $this->input->post('soap'),
            'cstools' => $this->input->post('cstools'),
            'ideas' => $this->input->post('ideas'),
            'ket' => $this->input->post('ket')
            );
        	/*var_dump($_POST);*/
        

            $this->db->insert('app_data_app', $data);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success">Data berhasil ditambahkan</div>');
            redirect('administrasi/input_data');
        }
    }

    public function ajax_data_app(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}else{
			$this->load->library('ssp');
			$table = 'app_data_app';
			$primaryKey = 'no';
			 $columns = array(
                array('db' => 'nama', 'dt' => 0),
                array('db' => 'jab', 'dt' => 1),
                array('db' => 'batch', 'dt' => 2),
                array('db' => 'tgl_in', 'dt' => 3),
                /*array('db' => 'tgl_out', 'dt' => 4),*/
                array('db' => 'sta', 'dt' => 4),
                /*array('db' => 'avaya', 'dt' => 6),
                array('db' => 'siska', 'dt' => 7),
                array('db' => 'cx', 'dt' => 8),
                array('db' => 'nossa', 'dt' => 9),
                array('db' => 'ibooster', 'dt' => 10),
                array('db' => 't3ol', 'dt' => 11),
                array('db' => 'startklik', 'dt' => 12),
                array('db' => 'webcare', 'dt' => 13),
                array('db' => 'payment', 'dt' => 14),
                array('db' => 'kms', 'dt' => 15),
                array('db' => 'soap', 'dt' => 16),
                array('db' => 'cstools', 'dt' => 17),
                array('db' => 'ideas', 'dt' => 18),
                array('db' => 'ket', 'dt' => 19),*/
                array('db'  => 'no', 'dt' => 5, 'formatter' => function( $d) {
                    return '<div class="btn-group">
                      <a class="btn btn-primary btn-flat" href="'.site_url('administrasi/detail/' .$d).'"><i class="fa fa-check-circle"></i> Detail</a>
                      <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="'.site_url('administrasi/update/' .$d).'"><i class="fa fa-pencil"></i>Update</a></li>
                      </ul>
                    </div>';
                }),
                );
			$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'Admingcc',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);
			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns ));
		}
	}

	public function list_data(){
            $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='administrasi') {
                $isi['judul'] = 'Data Aplikasi';
                $isi['sub_judul'] = "list data";
                
                $this->load->view('design/atas2');
                $this->load->view('administrasi/menu',$isi);
                $this->load->view('administrasi/list_data');
                $this->load->view('design/bawah2');
            }
            else
            {
                redirect('web');
            }
    }

      public function update($no){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
       

        if (!empty($cek) && $stts=='administrasi') {
            $row=$this->m_agent->get_data_id($no);
            if ($row) {
                $isi=array(
                    'button'=>'Update',
                    'action'=>site_url('administrasi/update_action'),
                    'no' => set_value('no', $row->no),
                    'nama' => set_value('nama', $row->nama),
                    'jab' => set_value('jab', $row->jab),
                    'batch' => set_value('batch', $row->batch),
                   'tgl_in' => set_value('tgl_in', $row->tgl_in),
                    'tgl_out' => set_value('tgl_out', $row->tgl_out),
                    'avaya' => set_value('avaya', $row->avaya),
                    'siska' => set_value('siska', $row->siska),
                    'cx' => set_value('cx', $row->cx),
                    'nossa' => set_value('nossa', $row->nossa),
                    'ibooster' => set_value('ibooster', $row->ibooster),
                    't3ol' => set_value('t3ol', $row->t3ol),
                    'startklik' => set_value('startklik', $row->startklik),
                    'webcare' => set_value('webcare', $row->webcare),
                    'payment' => set_value('payment', $row->payment),
                    'kms' => set_value('kms', $row->kms),
                    'soap' => set_value('soap', $row->soap),
                    'cstools' => set_value('cstools', $row->cstools),
                    'ideas' => set_value('ideas', $row->ideas),
                    'nama' => set_value('nama', $row->nama),
                    'ket' => set_value('ket', $row->ket),
                    'sta' => set_value('sta', $row->sta)
                    );
            }            
            $isi['jab_list'] = $this->m_agent->get_jab();
            $isi['judul'] = 'DATA TIKET';
            $isi['sub_judul'] = "Update Data";
            $this->load->view('design/atas2');
            $this->load->view('administrasi/menu',$isi);
            $this->load->view('administrasi/update_data',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); } 
    }

    public function update_action(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no',TRUE));
        } else {                 
        $data = array(
            //'nama' => $this->input->post('nama'),
            'jab' => $this->input->post('jab'),
            'batch' => $this->input->post('batch'),
            'tgl_in' => $this->input->post('tgl_in'),
            'tgl_out' => $this->input->post('tgl_out'),
            'avaya' => $this->input->post('avaya'),
            'siska' => $this->input->post('siska'),
            'cx' => $this->input->post('cx'),
            'nossa' => $this->input->post('nossa'),
            'ibooster' => $this->input->post('ibooster'),
            't3ol' => $this->input->post('t3ol'),
            'startklik' => $this->input->post('startklik'),
            'webcare' => $this->input->post('webcare'),
            'payment' => $this->input->post('payment'),
            'kms' => $this->input->post('kms'),
            'soap' => $this->input->post('soap'),
            'cstools' => $this->input->post('cstools'),
            'ideas' => $this->input->post('ideas'),
            'ket' => $this->input->post('ket'),
            'sta' => $this->input->post('sta')
            );
         }    
            
            /*var_dump($_POST);*/

            $this->m_agent->update_app($this->input->post('no',TRUE),$data);
            $this->m_agent->get_selisih_date($this->input->post('no',TRUE),$data);
            redirect(site_url('administrasi/list_data/'));
        
        }

    public function detail($no){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='administrasi') {
            $row=$this->m_agent->get_data_id($no);
            if ($row) {
                $isi=array(
                    
                    'no' => set_value('no', $row->no),
                    'nama' => set_value('nama', $row->nama),
                    'avaya' => set_value('avaya', $row->avaya),
                    'siska' => set_value('siska', $row->siska),
                    'cx' => set_value('cx', $row->cx),
                    'nossa' => set_value('nossa', $row->nossa),
                    'ibooster' => set_value('ibooster', $row->ibooster),
                    't3ol' => set_value('t3ol', $row->t3ol),
                    'startklik' => set_value('startklik', $row->startklik),
                    'webcare' => set_value('webcare', $row->webcare),
                    'payment' => set_value('payment', $row->payment),
                    'kms' => set_value('kms', $row->kms),
                    'soap' => set_value('soap', $row->soap),
                    'cstools' => set_value('cstools', $row->cstools),
                    'ideas' => set_value('ideas', $row->ideas),
                    'nama' => set_value('nama', $row->nama),
                    'ket' => set_value('ket', $row->ket)
                    );
            }
            $isi['judul'] = 'DATA TIKET';
            $isi['sub_judul'] = "Detail Data";            
            $this->load->view('design/atas2');
            $this->load->view('administrasi/menu',$isi);
            $this->load->view('administrasi/detail_data',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); } 
    }

    public function u_aktif(){
            $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='administrasi') {
                $isi['judul'] = 'Data Aplikasi';
                $isi['sub_judul'] = "Laporan User Aktif";
                
                $this->load->view('design/atas2');
                $this->load->view('administrasi/menu',$isi);
                $this->load->view('administrasi/u_aktif');
                $this->load->view('design/bawah2');
            }
            else
            {
                redirect('web');
            }
    }

    public function ajax_u_aktif(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $this->load->library('ssp');
            $table = 'app_data_app';
            $primaryKey = 'no';
             $columns = array(
                array('db' => 'nama', 'dt' => 0),
                array('db' => 'jab', 'dt' => 1),
                array('db' => 'batch', 'dt' => 2),
                array('db' => 'tgl_in', 'dt' => 3),
                array('db' => 'tgl_out', 'dt' => 4),
                array('db' => 'out_in', 'dt' => 5),
                array('db' => 'sta', 'dt' => 6),
                array('db' => 'avaya', 'dt' => 7),
                array('db' => 'siska', 'dt' => 8),
                array('db' => 'cx', 'dt' => 9),
                array('db' => 'nossa', 'dt' => 10),
                array('db' => 'ibooster', 'dt' => 11),
                array('db' => 't3ol', 'dt' => 12),
                array('db' => 'startklik', 'dt' => 13),
                array('db' => 'webcare', 'dt' => 14),
                array('db' => 'payment', 'dt' => 15),
                array('db' => 'kms', 'dt' => 16),
                array('db' => 'soap', 'dt' => 17),
                array('db' => 'cstools', 'dt' => 18),
                array('db' => 'ideas', 'dt' => 19),
                array('db' => 'ket', 'dt' => 20),
                array('db' => 'sta', 'dt' => 21),
                );
            $sql_details = array(
                'user'  => 'root',
                'pass'  => 'root',
                'db'    =>  'Maincc147',
                'host'  => 'localhost'
                );

            
            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    function _rules() 
    {
    $this->form_validation->set_rules('nama', 'Nama', 'is_unique[app_data_app.nama]');
    $this->form_validation->set_rules('jab', ' ', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */