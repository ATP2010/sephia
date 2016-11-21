<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiling extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
        $this->load->library('form_validation');
        $this->load->model('M_hc');
        $this->load->library('user_agent');
    }

	public function index()
	{
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='Admin Profiling') {
				$isi['judul'] = 'Home';
            	$isi['sub_judul'] = "Info";
           
            	$in=$this->db->query("select count(logid) as tot_in from input_tiket where sta='0' and jns_tiket='32'");
            	$out=$this->db->query("select count(logid) as tot_out from input_tiket where sta='1' and jns_tiket='32'");
            	$tot=$this->db->query("select count(logid) as tot from input_tiket where jns_tiket='32'");            	
            	$q=$this->db->query("select count(logid) as ag from input_tiket where jns_tiket='32' group by logid");	
            	$r=$q->num_rows();
            	
           		/*$new=$this->db->query("select count(logid) as new from s_data_hc where by_sup='new' and by_tl='new'");
            	$dina=$this->db->query("select count(logid) as dina from s_data_hc where by_sup='new' and by_tl='oke'");
            	$tial=$this->db->query("select count(logid) as tial from s_data_hc where by_sup='oke' and by_tl='new'");            	
            	$oke=$this->db->query("select count(logid) as oke from s_data_hc where by_sup='oke' and by_tl='oke'");	*/
            	
           
            	$isi['tk_in']=$in;
            	$isi['tk_out']=$out;
				$isi['tot']=$tot;
				$isi['ag']=$r;

				/*$isi['new']=$new;
				$isi['dina']=$dina;
				$isi['tial']=$tial;
				$isi['oke']=$oke;*/
				

            	$this->load->view('design/atas2');
	            $this->load->view('admin_profiling/menu',$isi);
	            $this->load->view('admin_profiling/home',$isi);
	            $this->load->view('design/bawah2');
            	
			}
			else
			{
				redirect('web');
			}
	}

	public function tiket_in(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='Admin Profiling') {
				$isi['judul'] = 'Data tiket';
            	$isi['sub_judul'] = "tiket in";
            	

				$this->load->view('design/atas2');
				$this->load->view('admin_profiling/menu',$isi);
				$this->load->view('admin_profiling/tiket_in');
				$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
	}

	public function ajax_data_in(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}else{
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
																return '<a href="'.site_url('profiling/done/' .$d).'" >eksekusi</a>';}),
				/*array('db' => '`u`.`logid_eks`', 'dt' => 11, 'field' => 'logid_eks'),*/
				);
				$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'Admingcc',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);

				$joinQuery = "FROM input_tiket AS u, jenis_tiket AS ud";
				$extraWhere = "ud.id = u.jns_tiket and u.sta = '0' and jns_tiket='32'";   

			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
		}}

		public function done($id){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='Admin Profiling') {
        	$login=$this->session->userdata('user1');
        	$q="UPDATE input_tiket SET sta = '1', logid_eks = '$login' WHERE id = '$id'";
     		$query=$this->db->query($q);
     		redirect(site_url('profiling/tiket_in'));
        } else { redirect('web'); } 
    }

    public function tiket_out(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='Admin Profiling') {
				$isi['judul'] = 'Data tiket';
            	$isi['sub_judul'] = "tiket out";
            	

				$this->load->view('design/atas2');
				$this->load->view('admin_profiling/menu',$isi);
				$this->load->view('admin_profiling/tiket_out');
				$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
	}

	public function ajax_data_out(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}else{
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
				array('db' => '`u`.`logid_eks`', 'dt' => 11, 'field' => 'logid_eks'),
				);
				$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'Admingcc',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);

				$joinQuery = "FROM input_tiket AS u, jenis_tiket AS ud";
				$extraWhere = "ud.id = u.jns_tiket and u.sta = '1' and jns_tiket='32'";   

			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
		}}	
}

/* End of file profiling.php */
/* Location: ./application/controllers/profiling.php */