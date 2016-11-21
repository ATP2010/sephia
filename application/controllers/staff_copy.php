<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
	
	function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
        $this->load->library('form_validation');
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
            	
           
            	$isi['tk_in']=$in;
            	$isi['tk_out']=$out;
				$isi['tot']=$tot;
				$isi['ag']=$r;
				

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

	public function tk_in(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='staff') {
				$isi['judul'] = 'Home';
            	$isi['sub_judul'] = "Tiket masuk";
            	$dt = "SELECT * FROM jenis_tiket , input_tiket WHERE jenis_tiket.id = input_tiket.jns_tiket and input_tiket.sta='0' order by input_tiket.tanggal DESC ";
            	$query = $this->db->query($dt);
            	$isi['data'] = $query;

				$this->load->view('design/atas2');
				$this->load->view('staff/menu',$isi);
				$this->load->view('staff/input',$isi);
				$this->load->view('design/bawah2');
			}
			else
			{
				redirect('web');
			}
	}	

	public function tk_out(){
			$cek = $this->session->userdata('logged_in');
			$stts = $this->session->userdata('stts');
			if (!empty($cek) && $stts=='staff') {
				$isi['judul'] = 'Home';
            	$isi['sub_judul'] = "Tiket sukses";
            	$dt = "SELECT * FROM jenis_tiket , input_tiket WHERE jenis_tiket.id = input_tiket.jns_tiket and input_tiket.sta='1' order by input_tiket.tanggal DESC ";
            	$query = $this->db->query($dt);
            	$isi['data'] = $query;

				$this->load->view('design/atas2');
				$this->load->view('staff/menu',$isi);
				$this->load->view('staff/out',$isi);
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
     		redirect(site_url('staff/tk_in'));
        } else { redirect('web'); } 
    }

    public function delete($id){
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
    }

}

/* End of file staff.php */
/* Location: ./application/controllers/staff.php */