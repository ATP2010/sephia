<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
	
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
			if (!empty($cek) && $stts=='staff') {
				$isi['judul'] = 'Home';
            	$isi['sub_judul'] = "Info";
           
            	$in=$this->db->query("select count(logid) as tot_in from input_tiket where sta='0'");
            	$out=$this->db->query("select count(logid) as tot_out from input_tiket where sta='1'");
            	$tot=$this->db->query("select count(logid) as tot from input_tiket");            	
            	$q=$this->db->query("select count(logid) as ag from input_tiket group by logid");	
            	$r=$q->num_rows();
            	
           		$new=$this->db->query("select count(logid) as new from s_data_hc where by_sup='new' and by_tl='new'");
            	$dina=$this->db->query("select count(logid) as dina from s_data_hc where by_sup='new' and by_tl='oke'");
            	$tial=$this->db->query("select count(logid) as tial from s_data_hc where by_sup='oke' and by_tl='new'");            	
            	$oke=$this->db->query("select count(logid) as oke from s_data_hc where by_sup='oke' and by_tl='oke'");	
            	
           
            	$isi['tk_in']=$in;
            	$isi['tk_out']=$out;
				$isi['tot']=$tot;
				$isi['ag']=$r;
				$isi['new']=$new;
				$isi['dina']=$dina;
				$isi['tial']=$tial;
				$isi['oke']=$oke;
				

            	$this->load->view('design/atas2');
	            $this->load->view('staff/menu',$isi);
	            $this->load->view('staff/home',$isi);
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
																return '<a href="'.site_url('staff/done/' .$d).'" >eksekusi</a>';}),
				/*array('db' => '`u`.`logid_eks`', 'dt' => 11, 'field' => 'logid_eks'),*/
				);
				$sql_details = array(
				'user' 	=> 'root',
				'pass' 	=> 'Admingcc',
				'db' 	=>	'Maincc147',
				'host' 	=> 'localhost'
				);

				$joinQuery = "FROM input_tiket AS u, jenis_tiket AS ud";
				$extraWhere = "ud.id = u.jns_tiket and u.sta = '0'";   

			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
		}}

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
				$extraWhere = "ud.id = u.jns_tiket and u.sta = '1'";   

			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
		}}

	public function tiket_in(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='staff') {
				$isi['judul'] = 'Data tiket';
            	$isi['sub_judul'] = "tiket in";
            	

				$this->load->view('design/atas2');
				$this->load->view('staff/menu',$isi);
				$this->load->view('staff/tiket_in');
				$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
	}

	public function tiket_out(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='staff') {
				$isi['judul'] = 'Data tiket';
            	$isi['sub_judul'] = "tiket out";
            	

				$this->load->view('design/atas2');
				$this->load->view('staff/menu',$isi);
				$this->load->view('staff/tiket_out');
				$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
	}	

	public function done($id){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='staff') {
        	$login=$this->session->userdata('user1');
        	$q="UPDATE input_tiket SET sta = '1', logid_eks = '$login' WHERE id = '$id'";
     		$query=$this->db->query($q);
     		redirect(site_url('staff/tiket_in'));
        } else { redirect('web'); } 
    }

  /*  public function delete($id){
        $row=$this->m_agent->get_by_id($id);
        if ($row) {
            $this->m_agent->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('staff/tk_in'));
        } 
    }

    public function delete_out($id){
        $row=$this->m_agent->get_by_id($id);
        if ($row) {
            $this->m_agent->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('staff/tk_out'));
        } 
    }*/

    function by_sup($id){
    	$q = "UPDATE s_data_hc SET by_sup = 'oke' WHERE id = '$id'";
    	$this->db->query($q);
		redirect($this->agent->referrer());
    }

    function by_tl($id){
    	$q = "UPDATE s_data_hc SET by_tl = 'oke' WHERE id = '$id'";
    	$this->db->query($q);
		redirect($this->agent->referrer());
    }

    public function tiket_hc_new(){

	$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='staff') {
			$isi['judul'] = 'List Data';
        	$isi['sub_judul'] = "Tiket Baru";

		$this->load->view('design/atas2');
		$this->load->view('staff/menu',$isi);
		$this->load->view('staff/tiket_hc_new');
		$this->load->view('design/bawah2');

		}
			else
			{
				redirect('web');
			}
	}

	function ajax_hc_new()
    {
    	/** AJAX Handle */
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    		)
    	{
            
            //$this->load->model('M_tiket_hc');
    		
    		/**
    		 * Mengambil Parameter dan Perubahan nilai dari setiap 
    		 * aktifitas pada table
    		 */
            $datatables  = $_POST;
            $datatables['table']    = 's_data_hc';
    		$datatables['id-table'] = 'id';

            /**
             * Kolom yang ditampilkan
             */
	    	$datatables['col-display'] = array(
            	    		             	 'id',
		                                     'id',
            	    		             	 'tanggal',
		                                     'logid',
		                                     'witel',
		                                     'nm_pelapor',
		                                     'nm_pelanggan',
		                                     'no_fastel',
		                                     'alamat',
		                                     'no_tiket',
		                                     'tgl_open',
		                                     'sta_tiket',
		                                     'lapul',
		                                     'gaul',
		                                     'cp',
		                                     'email',
		                                     'keluhan',
            	    		             	);

            /**
             * menggunakan table join
             */
            //$datatables['join']    = 'INNER JOIN position ON position = id_position';

	    	$this->M_hc->tiket_new($datatables);
    	}

    	return;
    }

    public function tiket_hc_sup(){

	$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='staff') {
			$isi['judul'] = 'Input DINA';
        	$isi['sub_judul'] = "List data";

		$this->load->view('design/atas2');
		$this->load->view('staff/menu',$isi);
		$this->load->view('staff/tiket_hc_sup');
		$this->load->view('design/bawah2');

		}
			else
			{
				redirect('web');
			}
	}

    function ajax_hc_sup()
    {
    	/** AJAX Handle */
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    		)
    	{
            
            //$this->load->model('M_tiket_hc');
    		
    		/**
    		 * Mengambil Parameter dan Perubahan nilai dari setiap 
    		 * aktifitas pada table
    		 */
            $datatables  = $_POST;
            $datatables['table']    = 's_data_hc';
    		$datatables['id-table'] = 'id';

            /**
             * Kolom yang ditampilkan
             */
	    	$datatables['col-display'] = array(
            	    		             	 
		                                     'id',
            	    		             	 'tanggal',
		                                     'logid',
		                                     'witel',
		                                     'nm_pelapor',
		                                     'nm_pelanggan',
		                                     'no_fastel',
		                                     'alamat',
		                                     'no_tiket',
		                                     'tgl_open',
		                                     'sta_tiket',
		                                     'lapul',
		                                     'gaul',
		                                     'cp',
		                                     'email',
		                                     'keluhan',
            	    		             	);

            /**
             * menggunakan table join
             */
            //$datatables['join']    = 'INNER JOIN position ON position = id_position';

	    	$this->M_hc->tiket_sup($datatables);
    	}

    	return;
    }

    public function tiket_hc_tl(){

	$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='staff') {
			$isi['judul'] = 'Posting TIAL';
        	$isi['sub_judul'] = "List data";

		$this->load->view('design/atas2');
		$this->load->view('staff/menu',$isi);
		$this->load->view('staff/tiket_hc_tl');
		$this->load->view('design/bawah2');

		}
			else
			{
				redirect('web');
			}
	}

	function ajax_hc_tl()
    {
    	/** AJAX Handle */
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    		)
    	{
            
            //$this->load->model('M_tiket_hc');
    		
    		/**
    		 * Mengambil Parameter dan Perubahan nilai dari setiap 
    		 * aktifitas pada table
    		 */
            $datatables  = $_POST;
            $datatables['table']    = 's_data_hc';
    		$datatables['id-table'] = 'id';

            /**
             * Kolom yang ditampilkan
             */
	    	$datatables['col-display'] = array(
            	    		             	 
		                                     'id',
            	    		             	 'tanggal',
		                                     'logid',
		                                     'witel',
		                                     'nm_pelapor',
		                                     'nm_pelanggan',
		                                     'no_fastel',
		                                     'alamat',
		                                     'no_tiket',
		                                     'tgl_open',
		                                     'sta_tiket',
		                                     'lapul',
		                                     'gaul',
		                                     'cp',
		                                     'email',
		                                     'keluhan',
            	    		             	);

            /**
             * menggunakan table join
             */
            //$datatables['join']    = 'INNER JOIN position ON position = id_position';

	    	$this->M_hc->tiket_tl($datatables);
    	}

    	return;
    }

    public function tiket_hc_ok(){

	$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='staff') {
			$isi['judul'] = 'List Data';
        	$isi['sub_judul'] = "Tiket Complete";

		$this->load->view('design/atas2');
		$this->load->view('staff/menu',$isi);
		$this->load->view('staff/tiket_hc_ok');
		$this->load->view('design/bawah2');

		}
			else
			{
				redirect('web');
			}
	}

	function ajax_hc_ok()
    {
    	/** AJAX Handle */
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    		)
    	{
            
            //$this->load->model('M_tiket_hc');
    		
    		/**
    		 * Mengambil Parameter dan Perubahan nilai dari setiap 
    		 * aktifitas pada table
    		 */
            $datatables  = $_POST;
            $datatables['table']    = 's_data_hc';
    		$datatables['id-table'] = 'id';

            /**
             * Kolom yang ditampilkan
             */
	    	$datatables['col-display'] = array(
            	    		             	 
		                                     
            	    		             	 'tanggal',
		                                     'logid',
		                                     'witel',
		                                     'nm_pelapor',
		                                     'nm_pelanggan',
		                                     'no_fastel',
		                                     'alamat',
		                                     'no_tiket',
		                                     'tgl_open',
		                                     'sta_tiket',
		                                     'lapul',
		                                     'gaul',
		                                     'cp',
		                                     'email',
		                                     'keluhan',
            	    		             	);

            /**
             * menggunakan table join
             */
            //$datatables['join']    = 'INNER JOIN position ON position = id_position';

	    	$this->M_hc->tiket_ok($datatables);
    	}

    	return;
    }

}

/* End of file staff.php */
/* Location: ./application/controllers/staff.php */