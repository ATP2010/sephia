<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_agent extends CI_Model {
	function get_jenis_tiket(){
		$result = $this->db->get_where('jenis_tiket', array('sw'=>'1'));
		$options = array();
		foreach ($result->result_array() as $row) {
			$options[$row["id"]] = $row["nm_tiket"];
		}
		return $options;
	}

	function get_tkt_aktif(){
		$result = $this->db->get_where('jenis_tiket', array('sw'=>'1'));
		$options = array();
		foreach ($result->result_array() as $row) {
			$options[$row["id"]] = $row["nm_tiket"];
		}
		return $options;
	}

	function get_tkt_non(){
		$result = $this->db->get_where('jenis_tiket', array('sw'=>'0'));
		$options = array();
		foreach ($result->result_array() as $row) {
			$options[$row["id"]] = $row["nm_tiket"];
		}
		return $options;
	}

	function insert($data){
		$this->db->insert('input_tiket', $data);
	}

	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('input_tiket', $data);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get('input_tiket')->row();
		 /*$dt = "SELECT * FROM jenis_tiket , input_tiket WHERE jenis_tiket.id = input_tiket.jns_tiket AND input_tiket.id = '$id'";
         $query = $this->db->query($dt);*/
         /*return $query->row();*/
	}

	function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('input_tiket');
    }

    function get_done_id($id){
    	$this->db->where('id', $id);
    	$q="UPDATE input_tiket SET sta = '1', logid_eks = 42111 WHERE id = 11";
    }

    function get_menu_id($id){
		$this->db->where('id', $id);
		return $this->db->get('jenis_tiket')->row();
		 /*$dt = "SELECT * FROM jenis_tiket , input_tiket WHERE jenis_tiket.id = input_tiket.jns_tiket AND input_tiket.id = '$id'";
         $query = $this->db->query($dt);*/
         /*return $query->row();*/
	}

	function update_menu($id,$data){
		$this->db->where('id', $id);
		$this->db->update('jenis_tiket', $data);
	}

	function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_tiket');
    }

}

/* End of file m_agent.php */
/* Location: ./application/models/m_agent.php */