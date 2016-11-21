<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
        $this->load->model('M_hc');
        $this->load->library('form_validation');
        $this->load->library('user_agent');
    }

	public function index()
	{
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='admin') {
				$isi['judul'] = "Home";
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
				$this->load->view('admin/menu',$isi);
				$this->load->view('admin/home',$isi);
				$this->load->view('design/bawah2');
			}
			else
			{ redirect('web'); }
	}

	public function set_menu(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='admin') {
				
				$isi = array(
					'aktif'=>'Switch OFF',
					'non'=>'Switch ON',
					'action'=>site_url('admin/ubh_tiket'));
				$isi['judul'] = "Master";
				$isi['sub_judul'] = "Set Menu";
            	$isi['tkt_aktif'] = $this->m_agent->get_tkt_aktif();
            	$isi['tkt_non'] = $this->m_agent->get_tkt_non();

				$this->load->view('design/atas2');
				$this->load->view('admin/menu',$isi);
				$this->load->view('admin/menu_aktif',$isi);
				$this->load->view('design/bawah2');
			}
			else
			{ redirect('web'); }
	}

	public function ubh_tiket(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='admin') {
				
				$sw=$this->input->post('sw');
				$id=$this->input->post('j_tiket');

			if ($id!='') {
				if ($sw==1) {
					$q="UPDATE jenis_tiket SET sw = '0' WHERE id = $id";
					$query=$this->db->query($q);
					redirect(site_url('admin/set_menu'));
				} 
				if ($sw==0) {
				 	$q="UPDATE jenis_tiket SET sw = '1' WHERE id = $id";
					$query=$this->db->query($q);
					redirect(site_url('admin/set_menu'));
				}
			} else { redirect(site_url('admin/set_menu')); }
		}
		else { redirect('web'); }
	}

	public function add_menu() {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='admin') {
            
               $isi = array(
                'button' => 'Create',
                'action' => site_url('admin/add_menu_action'),
                'id' => set_value('id'),
                'sw' => set_value('0'),
                'nm_tiket' => set_value('nm_tiket'),
                );

            $isi['judul'] = 'Master';
            $isi['sub_judul'] = "Add Menu";
            //$this->load->model('m_agent');
            //$isi['jns_tiket'] = $this->m_agent->get_jenis_tiket();

            $this->load->view('design/atas2');
            $this->load->view('admin/menu',$isi);
            $this->load->view('admin/input_menu',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); }        
    }

    public function add_menu_action(){
        $data = array(
            'nm_tiket' => $this->input->post('nm_tiket'),
            'sw' => $this->input->post('sw'),
            );
            $this->db->insert('jenis_tiket', $data);
            redirect('admin/set_menu');
    }

	public function edit_menu(){
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='admin') {
			$isi['judul'] = 'Master';
            $isi['sub_judul'] = "edit menu";
            $dt = "select * from jenis_tiket order by sw";
			$query = $this->db->query($dt);
            $isi['data'] = $query;            

			$this->load->view('design/atas2');
			$this->load->view('admin/menu',$isi);
			$this->load->view('admin/edit_menu',$isi);
			$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
		}

	public function edit_menu_upd($id){
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='admin') {
			$row=$this->m_agent->get_menu_id($id);
            if ($row) {
                	$isi=array(
                		'button'=>'update',
                		'action'=>site_url('admin/edit_menu_upd_act'),
                		'id'=>set_value('id', $row->id),
                		'nm_tiket'=>set_value('nm_tiket', $row->nm_tiket),
                		'sw'=>set_value('sw', $row->sw),
                		);
                      }            
            $isi['judul'] = 'Master';
            $isi['sub_judul'] = "update menu";
			$this->load->view('design/atas2');
			$this->load->view('admin/menu',$isi);
			$this->load->view('admin/input_menu',$isi);
			$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
		}

		public function edit_menu_upd_act(){
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id',TRUE));
        } else {                 
        $data = array(
            'sw' => $this->input->post('sw'),
            'nm_tiket' => $this->input->post('nm_tiket'),
            );
            $this->m_agent->update_menu($this->input->post('id',TRUE),$data);
          	redirect(site_url('admin/edit_menu'));
        
        }
    }

    public function edit_menu_del($id){
        $row=$this->m_agent->get_menu_id($id);
        if ($row) {
            $this->m_agent->delete_menu($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/edit_menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/edit_menu'));
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
				$extraWhere = "ud.id = u.jns_tiket and u.sta = '1'";   

			echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere ));
		}}

	public function tiket_in(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='admin') {
				$isi['judul'] = 'Data tiket';
            	$isi['sub_judul'] = "tiket in";
            	

				$this->load->view('design/atas2');
				$this->load->view('admin/menu',$isi);
				$this->load->view('admin/tiket_in');
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
			if (!empty($cek) && $stts=='admin') {
				$isi['judul'] = 'Data tiket';
            	$isi['sub_judul'] = "tiket out";
            	

				$this->load->view('design/atas2');
				$this->load->view('admin/menu',$isi);
				$this->load->view('admin/tiket_out');
				$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
	}

	public function u_aktif(){
            $cek = $this->session->userdata('logged_in');
            $stts = $this->session->userdata('stts');
            if (!empty($cek) && $stts=='admin') {
                $isi['judul'] = 'Data Aplikasi';
                $isi['sub_judul'] = "Laporan User Aktif";
                
                $this->load->view('design/atas2');
                $this->load->view('admin/menu',$isi);
                $this->load->view('admin/u_aktif');
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
                'pass'  => 'Admingcc',
                'db'    =>  'Maincc147',
                'host'  => 'localhost'
                );

            
            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

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
		if (!empty($cek) && $stts=='admin') {
			$isi['judul'] = 'List Data';
        	$isi['sub_judul'] = "Tiket Baru";

		$this->load->view('design/atas2');
		$this->load->view('admin/menu',$isi);
		$this->load->view('admin/tiket_hc_new');
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
		if (!empty($cek) && $stts=='admin') {
			$isi['judul'] = 'Input DINA';
        	$isi['sub_judul'] = "List data";

		$this->load->view('design/atas2');
		$this->load->view('admin/menu',$isi);
		$this->load->view('admin/tiket_hc_sup');
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
		if (!empty($cek) && $stts=='admin') {
			$isi['judul'] = 'Posting TIAL';
        	$isi['sub_judul'] = "List data";

		$this->load->view('design/atas2');
		$this->load->view('admin/menu',$isi);
		$this->load->view('admin/tiket_hc_tl');
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
		if (!empty($cek) && $stts=='admin') {
			$isi['judul'] = 'List Data';
        	$isi['sub_judul'] = "Tiket Complete";

		$this->load->view('design/atas2');
		$this->load->view('admin/menu',$isi);
		$this->load->view('admin/tiket_hc_ok');
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


    public function data_hr(){
    	$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if (!empty($cek) && $stts=='admin') {
			$isi['judul'] = 'Data HR';
        	$isi['sub_judul'] = "All Karyawan";

		$this->load->view('design/atas2');
		$this->load->view('admin/menu',$isi);
		$this->load->view('admin/data_hr');
		$this->load->view('design/bawah2');

		}
			else
			{
				redirect('web');
			}
    }

    public function dataTable_hr() {
		$this -> load -> library('Datatable', array('model' => 'm_datahr', 'rowIdCol' => 'user_id'));
		
		$jsonArray = $this -> datatable -> datatableJson(array(
                /*'user8' => 'date'*/
            ));
		$this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
		
	}





    function _rules() 
    {
    $this->form_validation->set_rules('nm_tiket', ' ', 'trim');
    $this->form_validation->set_rules('sw', ' ', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */