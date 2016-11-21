<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tl extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
        $this->load->library('form_validation');
    }

    public function index() {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='tl' || $stts=='Supervisor') {
            $isi['judul'] = 'Home';
            $isi['sub_judul'] = "Info";
            //$isi['data'] = $this->db->get_where($this->table, array('status'=>'aktif'));

            $this->load->view('design/atas2');
            $this->load->view('staff/menu',$isi);
            $this->load->view('staff/home',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); }        
    }

}

/* End of file tl.php */
/* Location: ./application/controllers/tl.php */