<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getdata extends CI_Controller {

	public function index()
	{
		$hostname="10.194.7.73";
		$username="root";
		$password="Admingcc";
		$database="maincc147";
		$mysql=mysql_connect($hostname,$username,$password);
		if (!$mysql) {die('Koneksi ke Mysql gagal: ' . mysql_error());}
		mysql_select_db($database) or die( "Tidak dapat memilih data base");
		
		$ip = $_SERVER['REMOTE_ADDR'];
		//$tgl=date("Y-m-d H:i:s");
		
		$userid = $this->input->cookie("userid");
		$skill = $this->input->cookie("skill");
		$nama = $this->input->cookie("nama");
		
		$query=mysql_query("SELECT k.uname FROM cc147_main_konek AS k where k.host_addr = '$ip'");
		$data=mysql_fetch_row($query);
		
		if ($data[0] <> $userid){
		$query=mysql_query("SELECT k.uname, u.user_id, u.name, h.user3, g.group_id FROM cc147_main_konek AS k , cc147_main_users AS u , cc147_main_bbuser_group AS g, cc147_main_users_extended AS h WHERE k.uname =  u.username AND u.user_id =  g.user_id AND u.user_id =  h.id AND k.host_addr = '$ip'");
		$data=mysql_fetch_row($query);
		$logid=$data[0];
		$id=$data[1];
		$nama=$data[2];
		$lay=$data[3];
		$gid=$data[4];
		
		$data['logid'] =  $logid;
		$data['id'] =  $id;
		$data['nama'] =  $nama;
		$data['lay'] =  $lay;
		$data['gid'] =  $gid;
		$this->load->view('getdata',$data);
		}
		if ($nama =='') {
			$this->load->view("logout.php");
		}
	}
}

/* End of file getdata.php */
/* Location: ./application/controllers/getdata.php */