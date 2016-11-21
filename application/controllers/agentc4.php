<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agentc4 extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function index() {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agentc4') {
            $isi['judul'] = 'Home';
            $isi['sub_judul'] = "Info";
                
                $logid=$this->session->userdata('user1');
                $in=$this->db->query("select count(no_tiket) as tot_in from cc147_caring_export a where not exists (select * from cc147_caring_status b where a.no_tiket=b.no_tiket)");
                $out=$this->db->query("select count(no_tiket) as tot_out from cc147_caring_status where sta='1'");
                $tot=$this->db->query("select count(no_tiket) as tot_out from cc147_caring_status where sta='2'");
                $q=$this->db->query("select count(no_tiket) as tot_out from cc147_caring_status where sta='3'");
                
                
           
                $isi['tk_in']=$in;
                $isi['tk_out']=$out;
                $isi['tot']=$tot;
                $isi['q']=$q;

                $this->load->view('design/atas2');
                $this->load->view('agentc4/menu',$isi);
                $this->load->view('agentc4/home',$isi);
                $this->load->view('design/bawah2');
        } else { redirect('web'); }        
    }

     public function tiket_in(){
            $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='agentc4') {
                $isi['judul'] = 'Data tiket';
                $isi['sub_judul'] = "list data";
                
                $this->load->view('design/atas2');
                $this->load->view('agentc4/menu',$isi);
                $this->load->view('agentc4/list_data');
                $this->load->view('design/bawah2');
            }
            else
            {
                redirect('web');
            }
    }

    public function ajax_data_in(){
        $login=$this->session->userdata('user1');
        
     /*   if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{*/
           
            $this->load->library('ssp');
            $table = 'cc147_caring_export';
            $primaryKey = 'no_tiket';
            $columns = array(
            	array('db'  => '`a`.`no_tiket`', 'dt' => 0, 'field' => 'no_tiket', 'formatter' => function( $d) {
                                                                return '<a href="'.site_url('agentc4/pindah/' .$d).'" >Send</a>';}),
                array('db' => '`a`.`no_tiket`', 'dt' => 1, 'field' => 'no_tiket'),
                array('db' => '`a`.`lapul`', 'dt' => 2, 'field' => 'lapul'),
                array('db' => '`a`.`witel`', 'dt' => 3, 'field' => 'witel'),
                array('db' => '`a`.`kandatel`', 'dt' => 4, 'field' => 'kandatel'),
                array('db' => '`a`.`emosi_plg`', 'dt' => 5, 'field' => 'emosi_plg'),
                array('db' => '`a`.`trouble_opentime`', 'dt' => 6, 'field' => 'trouble_opentime'),               
                );
           	$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'root',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);
                
                $joinQuery = "FROM cc147_caring_export a";
                $extraWhere = "not exists (select * from cc147_caring_status b where a.no_tiket=b.no_tiket) ";   

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
        }

    public function pindah(){
    	$uri3 = $this->uri->segment(3);
    	$sql = $this->db->query("INSERT into cc147_caring_status (no_tiket,lapul,witel,kandatel,emosi_plg,trouble_opentime, sta) 
									SELECT no_tiket,lapul,witel,kandatel,emosi_plg,trouble_opentime,'1' from cc147_caring_export where no_tiket = '".$uri3."'");
    	redirect('agentc4/tiket_in','refresh');
    	
    }

    public function tiket_cb(){
            $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='agentc4') {
                $isi['judul'] = 'Data tiket';
                $isi['sub_judul'] = "list data";
                
                $this->load->view('design/atas2');
                $this->load->view('agentc4/menu',$isi);
                $this->load->view('agentc4/list_cb');
                $this->load->view('design/bawah2');
            }
            else
            {
                redirect('web');
            }
    }

    public function ajax_data_cb(){
        $login=$this->session->userdata('user1');
        
     /*   if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{*/
           
            $this->load->library('ssp');
            $table = 'cc147_caring_status';
            $primaryKey = 'no_tiket';
            $columns = array(
            	
                array('db' => '`a`.`no_tiket`', 'dt' => 0, 'field' => 'no_tiket'),
                array('db' => '`a`.`lapul`', 'dt' => 1, 'field' => 'lapul'),
                array('db' => '`b`.`nm_sta`', 'dt' => 2, 'field' => 'nm_sta'),
                array('db' => '`a`.`login`', 'dt' => 3, 'field' => 'login'),
                array('db' => '`a`.`ket`', 'dt' => 4, 'field' => 'ket'),
                array('db'  => '`a`.`no_tiket`', 'dt' => 5, 'field' => 'no_tiket', 'formatter' => function( $d) {
                                                                return '<a href="'.site_url('agentc4/detail/' .$d).'" >Detail</a>';}),
                );
           	$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'root',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);
                
                $joinQuery = "FROM cc147_caring_status a, cc147_caring_stamenu b";
                $extraWhere = "a.sta=b.id";   

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
        }

}

/* End of file agentc4.php */
/* Location: ./application/controllers/agentc4.php */