<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
        $this->load->model('m_hc');
        $this->load->library('form_validation');
    }

	public function index() {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agent') {
            $isi['judul'] = 'Home';
            $isi['sub_judul'] = "Info";
                
                $logid=$this->session->userdata('user1');
                $in=$this->db->query("select count(logid) as tot_in from input_tiket where sta='0' and logid='$logid'");
                $out=$this->db->query("select count(logid) as tot_out from input_tiket where sta='1' and logid='$logid'");
                $tot=$this->db->query("select count(logid) as tot from input_tiket where logid='$logid'");               
                $q=$this->db->query("select count(logid) as ag from input_tiket where logid='$logid' group by logid");   
                $r=$q->num_rows();
                
           
                $isi['tk_in']=$in;
                $isi['tk_out']=$out;
                $isi['tot']=$tot;
                $isi['ag']=$r;

                $this->load->view('design/atas2');
                $this->load->view('agent/menu',$isi);
                $this->load->view('agent/home',$isi);
                $this->load->view('design/bawah2');
        } else { redirect('web'); }        
    }

    public function create() {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agent') {
            
               $isi = array(
                'button' => 'Create',
                'action' => site_url('agent/create_action'),
                'id' => set_value('id'),
                'jns_tiket' => set_value('jns_tiket'),
                'no_telp' => set_value('no_telp'),
                'no_inet' => set_value('no_inet'),
                'nm_pelapor' => set_value('nm_pelapor'),
                'no_cp' => set_value('no_cp'),
                'email' => set_value('email'),
                'atas_nama' => set_value('atas_nama'),
                'alamat' => set_value('alamat'),
                'detail' => set_value('detail'),
                );
            
            $isi['judul'] = 'DATA TIKET';
            $isi['sub_judul'] = "Input data";
            $this->load->model('m_agent');
            $isi['jns_tiket'] = $this->m_agent->get_jenis_tiket();
            
            $this->load->view('design/atas2');
            $this->load->view('agent/menu',$isi);
            $this->load->view('agent/input',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); }        
    }

    public function create_action(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
                    
                  
        $data = array(
            'tanggal' => $this->input->post('tanggal'),
            'logid' => $this->input->post('logid'),
            'jns_tiket' => $this->input->post('j_tiket'),
            'no_telp' => $this->input->post('no_telp',TRUE),
            'no_inet' => $this->input->post('no_inet',TRUE),
            'nm_pelapor' => $this->input->post('nm_pelapor',TRUE),
            'no_cp' => $this->input->post('no_cp',TRUE),
            'email' => $this->input->post('email',TRUE),
            'atas_nama' => $this->input->post('atas_nama',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'detail' => $this->input->post('detail',TRUE),
            );
        foreach ($data as $key) {
            $this->load->model('m_agent');
            $this->m_agent->insert($data);
            /*var_dump($_POST);*/
            redirect(site_url('agent/tiket_in'));
        }
        }
    }

    public function ajax_data_in(){
        $login=$this->session->userdata('user1');
        
     /*   if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{*/
           
            $this->load->library('ssp');
            $table = 'input_tiket';
            $primaryKey = 'id';
            $columns = array(
                array('db' => '`u`.`tanggal`', 'dt' => 0, 'field' => 'tanggal'),
                array('db' => '`u`.`logid`', 'dt' => 1, 'field' => 'logid'),
                array('db' => '`ud`.`nm_tiket`', 'dt' => 2, 'field' => 'nm_tiket'),
                array('db' => '`u`.`no_telp`', 'dt' => 3, 'field' => 'no_telp'),
                array('db' => '`u`.`no_inet`', 'dt' => 4, 'field' => 'no_inet'),
                array('db' => '`u`.`nm_pelapor`', 'dt' => 5, 'field' => 'nm_pelapor'),
                array('db' => '`u`.`no_cp`', 'dt' => 6, 'field' => 'no_cp'),
                array('db' => '`u`.`email`', 'dt' => 7, 'field' => 'email'),
                array('db' => '`u`.`atas_nama`', 'dt' => 8, 'field' => 'atas_nama'),
                array('db' => '`u`.`alamat`', 'dt' => 9, 'field' => 'alamat'),
                array('db' => '`u`.`detail`', 'dt' => 10, 'field' => 'detail'),
                array('db'  => '`u`.`id`', 'dt' => 11, 'field' => 'id', 'formatter' => function( $d) {
                                                                return '<a href="'.site_url('agent/update/' .$d).'" >update</a>';}),
                
                );
           	$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'root',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);
                
                $joinQuery = "FROM input_tiket AS u, jenis_tiket AS ud";
                $extraWhere = "ud.id = u.jns_tiket and u.logid = '$login' and u.sta = '0' ";   

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
        }
    /*}*/

        public function tiket_in(){
            $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='agent') {
                $isi['judul'] = 'Data tiket';
                $isi['sub_judul'] = "list data";
                
                $this->load->view('design/atas2');
                $this->load->view('agent/menu',$isi);
                $this->load->view('agent/list_data');
                $this->load->view('design/bawah2');
            }
            else
            {
                redirect('web');
            }
    }

    public function update($id){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agent') {
            $row=$this->m_agent->get_by_id($id);
            if ($row) {
                $isi=array(
                    'button'=>'Update',
                    'action'=>site_url('agent/update_action'),
                    'id' => set_value('id', $row->id),
                    'jns_tiket' => set_value('jns_tiket', $row->jns_tiket),
                    'no_telp' => set_value('no_telp', $row->no_telp),
                    'no_inet' => set_value('no_inet', $row->no_inet),
                    'nm_pelapor' => set_value('nm_pelapor', $row->nm_pelapor),
                    'no_cp' => set_value('no_cp', $row->no_cp),
                    'email' => set_value('email', $row->email),
                    'atas_nama' => set_value('atas_nama', $row->atas_nama),
                    'alamat' => set_value('alamat', $row->alamat),
                    'detail' => set_value('detail', $row->detail),
                    );
            }
            /*$login=$this->session->userdata('user1');*/
            $isi['judul'] = 'DATA TIKET';
            $isi['sub_judul'] = "Update Data";
            $isi['jns_tiket'] = $this->m_agent->get_jenis_tiket();
            $this->load->view('design/atas2');
            $this->load->view('agent/menu',$isi);
            $this->load->view('agent/input',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); } 
    }

    public function update_action(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id',TRUE));
        } else {                 
        $data = array(
            'tanggal' => $this->input->post('tanggal'),
            'logid' => $this->input->post('logid'),
            'jns_tiket' => $this->input->post('j_tiket'),
            'no_telp' => $this->input->post('no_telp',TRUE),
            'no_inet' => $this->input->post('no_inet',TRUE),
            'nm_pelapor' => $this->input->post('nm_pelapor',TRUE),
            'no_cp' => $this->input->post('no_cp',TRUE),
            'email' => $this->input->post('email',TRUE),
            'atas_nama' => $this->input->post('atas_nama',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'detail' => $this->input->post('detail',TRUE),
            );
        
            $this->m_agent->update($this->input->post('id',TRUE),$data);
            /* var_dump($_POST);*/
            redirect(site_url('agent/tiket_in'));
        
        }
    }

    public function delete($id){
        $row=$this->m_agent->get_by_id($id);
        if ($row) {
            $this->m_agent->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('agent/list_dt'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agent/list_dt'));
        }
    }

     public function create_hc(){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agent') {
            
               $isi = array(
                'button' => 'Create',
                'action' => site_url('agent/create_hc_action'),
                'id' => set_value('id'),
                'tanggal' => set_value('tanggal'),
                'logid' => set_value('logid'),
                'witel' => set_value('witel'),
                'nm_pelapor' => set_value('nm_pelapor'),
                'nm_pelanggan' => set_value('nm_pelanggan'),
                'no_fastel' => set_value('no_fastel'),
                'alamat' => set_value('alamat'),
                'no_tiket' => set_value('no_tiket'),
                'tgl_open' => set_value('tgl_open'),
                'sta_tiket' => set_value('sta_tiket'),
                'lapul' => set_value('lapul'),
                'gaul' => set_value('gaul'),
                'cp' => set_value('cp'),
                'email' => set_value('email'),
                'keluhan' => set_value('keluhan'),
                'by_sup' => set_value('by_sup'),
                'by_tl' => set_value('by_tl'),
                );
            
            $isi['judul'] = 'DATA HC';
            $isi['sub_judul'] = "Input data";
            $this->load->model('m_hc');
            //$isi['jns_tiket'] = $this->m_agent->get_jenis_tiket();
            
            $this->load->view('design/atas2');
            $this->load->view('agent/menu',$isi);
            $this->load->view('agent/input_hc',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); }
    }

    public function create_hc_action(){
        $this->_rules_hc();
        if ($this->form_validation->run() == FALSE) {
            $this->create_hc();
        } else {
        $data = array(
                'tanggal' => $this->input->post('tanggal'),
                'logid' => $this->input->post('logid'),
                'witel' => $this->input->post('witel'),
                'nm_pelapor' => $this->input->post('nm_pelapor'),
                'nm_pelanggan' => $this->input->post('nm_pelanggan'),
                'no_fastel' => $this->input->post('no_fastel'),
                'alamat' => $this->input->post('alamat'),
                'no_tiket' => $this->input->post('no_tiket'),
                'tgl_open' => $this->input->post('tgl_open'),
                'sta_tiket' => $this->input->post('sta_tiket'),
                'lapul' => $this->input->post('lapul'),
                'gaul' => $this->input->post('gaul'),
                'cp' => $this->input->post('cp'),
                'email' => $this->input->post('email'),
                'keluhan' => $this->input->post('keluhan'),
                'by_sup' => $this->input->post('by_sup'),
                'by_tl' => $this->input->post('by_tl'),
            );
        foreach ($data as $key) {
            $this->load->model('m_hc');
            $this->m_hc->insert($data);
            //var_dump($_POST);
            $this->session->set_flashdata('hc_oke','<div class="alert alert-success">Data berhasil diinput !</div>');
            redirect(site_url('agent/create_hc'));
        }
        }
    }

    public function ajax_datahc_in(){
        $login=$this->session->userdata('user1');
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
           
            $this->load->library('ssp');
            $table = 's_data_hc';
            $primaryKey = 'id';
            $columns = array(
                array('db' => 'tanggal', 'dt' => 0, 'field' => 'tanggal'),
                array('db' => 'witel', 'dt' => 1, 'field' => 'witel'),
                array('db' => 'nm_pelapor', 'dt' => 2, 'field' => 'nm_pelapor'),
                array('db' => 'nm_pelanggan', 'dt' => 3, 'field' => 'nm_pelanggan'),
                array('db' => 'no_fastel', 'dt' => 4, 'field' => 'no_fastel'),
                array('db' => 'alamat', 'dt' => 5, 'field' => 'alamat'),
                array('db' => 'no_tiket', 'dt' => 6, 'field' => 'no_tiket'),
                array('db' => 'tgl_open', 'dt' => 7, 'field' => 'tgl_open'),
                array('db' => 'sta_tiket', 'dt' => 8, 'field' => 'sta_tiket'),
                array('db' => 'lapul', 'dt' => 9, 'field' => 'lapul'),
                array('db' => 'gaul', 'dt' => 10, 'field' => 'gaul'),
                array('db' => 'cp', 'dt' => 11, 'field' => 'cp'),
                array('db' => 'email', 'dt' => 12, 'field' => 'email'),
                array('db' => 'keluhan', 'dt' => 13, 'field' => 'keluhan'),
                
                /*array('db'  => 'id', 'dt' => 14, 'field' => 'id', 'formatter' => function( $d) {
                        return '<a href="'.site_url('agent/update_hc/' .$d).'" >update</a>';}),*/
                
                );
            $sql_details = array(
                'user'  => 'root',
                'pass'  => 'root',
                'db'    =>  'Maincc147',
                'host'  => 'localhost'
                );
                
                $joinQuery = "FROM s_data_hc";
                $extraWhere = "logid = '$login'";   

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
        }
    }

    public function list_hc(){
         $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='agent') {
                $isi['judul'] = 'Data Hard Complaint';
                $isi['sub_judul'] = "list data";
                
                $this->load->view('design/atas2');
                $this->load->view('agent/menu',$isi);
                $this->load->view('agent/list_hc');
                $this->load->view('design/bawah2');
            }
            else
            {
                redirect('web');
            }
    }

    public function update_hc($id){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agent') {
            
            $row=$this->m_hc->get_by_id($id);
            if ($row) {
                $isi=array(
                    'button'=>'Update',
                    'action'=>site_url('agent/update_hc_action'),
                    'id' => set_value('id', $row->id),
                    'tanggal' => set_value('tanggal', $row->tanggal),
                    'logid' => set_value('logid', $row->logid),
                    'witel' => set_value('witel', $row->witel),
                    'nm_pelapor' => set_value('nm_pelapor', $row->nm_pelapor),
                    'nm_pelanggan' => set_value('nm_pelanggan', $row->nm_pelanggan),
                    'no_fastel' => set_value('no_fastel', $row->no_fastel),
                    'alamat' => set_value('alamat', $row->alamat),
                    'no_tiket' => set_value('no_tiket', $row->no_tiket),
                    'tgl_open' => set_value('tgl_open', $row->tgl_open),
                    'sta_tiket' => set_value('sta_tiket', $row->sta_tiket),
                    'lapul' => set_value('lapul', $row->lapul),
                    'gaul' => set_value('gaul', $row->gaul),
                    'cp' => set_value('cp', $row->cp),
                    'email' => set_value('email', $row->email),
                    'keluhan' => set_value('keluhan', $row->keluhan)
                    );
            }
            $isi['judul'] = 'DATA HC';
            $isi['sub_judul'] = "Update Data";
            $this->load->view('design/atas2');
            $this->load->view('agent/menu',$isi);
            $this->load->view('agent/input_hc',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); } 
    }

    function _rules() //rule tiket
    {
    $this->form_validation->set_rules('no_telp', ' ', 'trim|required');
    $this->form_validation->set_rules('no_inet', ' ', 'trim|required');
    $this->form_validation->set_rules('nm_pelapor', ' ', 'trim|required');
    $this->form_validation->set_rules('no_cp', ' ', 'trim|required');
    $this->form_validation->set_rules('email', ' ', 'trim|required');
    $this->form_validation->set_rules('atas_nama', ' ', 'trim|required');
    $this->form_validation->set_rules('alamat', ' ', 'trim|required');
    $this->form_validation->set_rules('detail', ' ', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function _rules_hc() //rule HC
    {
    $this->form_validation->set_rules('nm_pelapor', ' ', 'trim|required');
    $this->form_validation->set_rules('email', ' ', 'trim|required');
    $this->form_validation->set_rules('alamat', ' ', 'trim|required');
    $this->form_validation->set_rules('witel', ' ', 'trim|required');
    $this->form_validation->set_rules('nm_pelanggan', ' ', 'trim|required');
    $this->form_validation->set_rules('no_fastel', ' ', 'trim|required');
    $this->form_validation->set_rules('no_tiket', ' ', 'trim|required');
    $this->form_validation->set_rules('tgl_open', ' ', 'trim|required');
    $this->form_validation->set_rules('sta_tiket', ' ', 'trim|required');
    $this->form_validation->set_rules('lapul', ' ', 'trim|required');
    $this->form_validation->set_rules('gaul', ' ', 'trim|required');
    $this->form_validation->set_rules('cp', ' ', 'trim|required');
    $this->form_validation->set_rules('keluhan', ' ', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file agent.php */
/* Location: ./application/controllers/agent.php */