<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_app_model extends CI_Model {

	public function getLoginData($usr,$psw){
		$u = mysql_real_escape_string($usr);
		$p = mysql_real_escape_string($psw);
		$q_cek_login = $this->db->get_where('m_login', array('userid'=>$usr,'password'=>$psw));
			if (count($q_cek_login->result())>0) {
				foreach ($q_cek_login->result() as $qck) {
					
					if ($qck->userlevel=='Admin') {
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qck->username;
						$sess_data['stts'] = 'admin';
						$this->session->set_userdata($sess_data);
						redirect('admin');
					}

					if ($qck->userlevel=='Staff') {
						$sess_data['logged_in'] = 'yes';
						$sess_data['username'] = $qck->username;
						$sess_data['stts'] = 'staff';
						$this->session->set_userdata($sess_data);
						redirect('staff');
					}
				}
			}
			else
			{
				$this->session->set_flashdata('info','<div class="alert alert-warning">userid / password tidak sesuai !</div>');
				redirect('web');
			}

	}

	

}

/* End of file web_app_model.php */
/* Location: ./application/models/web_app_model.php */