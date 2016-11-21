<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	public function getLoginData($u,$p){
		/*$u = mysqli_real_escape_string($usr);
		$p = mysqli_real_escape_string($psw);*/
		$q_cek_login = $this->db->get_where('cc147_main_users', array('username'=>$u,'user_password'=>md5($p)));
			if (count($q_cek_login->result())>0) {
				foreach ($q_cek_login->result() as $qck) {
					$usid = $qck->user_id;
					$mux=$this->db->get_where('cc147_main_users_extended',array('id'=>$usid));
						foreach ($mux->result() as $ext) {
							/*$stts=$ext->user3;*/
							$stts=strtolower($ext->user3);
							$ag = substr($stts,0,5);
							$spv = substr($stts,0,10);
							$tl = substr($stts,0,2);
							
							if (($stts == 'agent 147')||($stts == 'agent t1 english')||($stts == 'agent t1 informasi')||($stts == 'agent t1 komplain')
								||($stts == 'agent t1 registrasi')||($stts == 'agent t2 inbound')||($stts == 'agent web in')) {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'agent';
								$this->session->set_userdata($sess_data);
								redirect('agent');
							}

							if ($stts == 'agent t2 outbound') {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'agent2out';
								$this->session->set_userdata($sess_data);
								redirect('agent2out');
							}

							if ($stts == 'agent c4') {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'agentc4';
								$this->session->set_userdata($sess_data);
								redirect('agentc4');
							}

							if (($spv == 'supervisor')||($tl == 'tl')) {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'staff';
								$this->session->set_userdata($sess_data);
								redirect('staff');
							}

							if ($stts == 'administrasi') {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'administrasi';
								$this->session->set_userdata($sess_data);
								redirect('administrasi');
							}

							if ($stts == 'admin profiling') {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'Admin Profiling';
								$this->session->set_userdata($sess_data);
								redirect('profiling');
							}

							if (($stts == 'koordinator')||($stts == 'maintenance')||($stts == 'duktek')) {
								$sess_data['logged_in'] = 'yes';
								$sess_data['user_id'] = $ext->user_id;
								$sess_data['user1'] = $ext->user1;
								$sess_data['user2'] = $ext->user2;
								$sess_data['user3'] = $ext->user3;
								$sess_data['user4'] = $ext->user4;
								$sess_data['stts'] = 'admin';
								$this->session->set_userdata($sess_data);
								redirect('admin');
							}
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