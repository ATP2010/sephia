<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_agent');
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
            redirect(site_url('agent/list_dt'));
        }
        }
    }

    public function list_dt(){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if (!empty($cek) && $stts=='agent') {
            
            $login=$this->session->userdata('user1');
            $isi['judul'] = 'DATA TIKET';
            $isi['sub_judul'] = "List Data";
            /*$isi['data'] = $this->db->get_where('input_tiket', array('sta'=>'0','logid'=>$login));*/
            $dt = "SELECT * FROM jenis_tiket , input_tiket WHERE jenis_tiket.id = input_tiket.jns_tiket AND logid = '$login' order by input_tiket.tanggal DESC ";
            $query = $this->db->query($dt);
            $isi['data'] = $query;


            $this->load->view('design/atas2');
            $this->load->view('agent/menu',$isi);
            $this->load->view('agent/list',$isi);
            $this->load->view('design/bawah2');
        } else { redirect('web'); } 
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
            redirect(site_url('agent/list_dt'));
        
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

    function _rules() 
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

}

/* End of file agent.php */
/* Location: ./application/controllers/agent.php */