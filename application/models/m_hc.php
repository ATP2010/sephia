<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hc extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function insert($data){
		$this->db->insert('s_data_hc', $data);
		
	}

	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get('s_data_hc')->row();
		 /*$dt = "SELECT * FROM jenis_tiket , input_tiket WHERE jenis_tiket.id = input_tiket.jns_tiket AND input_tiket.id = '$id'";
         $query = $this->db->query($dt);*/
         /*return $query->row();*/
	}

	function tiket_new($dt){

        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

        //$join = $dt['join'];
        //$sql  = "SELECT {$columns} FROM {$dt['table']} {$join}";
        $kondisi = 'where by_sup = "new" and by_tl = "new"';

        $sql  = "SELECT {$columns} FROM {$dt['table']} {$kondisi}";

        $data = $this->db->query($sql);

        $rowCount = $data->num_rows();

        $data->free_result();

        // pengkondisian aksi seperti next, search dan limit
        $columnd = $dt['col-display'];
        $count_c = count
        ($columnd);

        // search
        $search = $dt['search']['value'];

        /**
         * Search Global
         * pencarian global pada pojok kanan atas
         */
        $where = '';
        if ($search != '') {   
            for ($i=0; $i < $count_c ; $i++) {
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                
                if ($i < $count_c - 1) {
                    $where .= ' OR ';
                }
            }
        }
        
        /**
         * Search Individual Kolom
         * pencarian dibawah kolom
         */
        for ($i=0; $i < $count_c; $i++) { 
            $searchCol = $dt['columns'][$i]['search']['value'];
            if ($searchCol != '') {
                $where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
                break;
            }
        }

        /**
         * pengecekan Form pencarian
         * pencarian aktif jika ada karakter masuk pada kolom pencarian.
         */
        if ($where != '') {
            $sql .= " and " . $where;
            
        }
        
        // sorting
        $sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
        
        // limit
        $start  = $dt['start'];
        $length = $dt['length'];

        $sql .= " LIMIT {$start}, {$length}";
        
        $list = $this->db->query($sql);

        /**
         * convert to json
         */
        $option['draw']            = $dt['draw'];
        $option['recordsTotal']    = $rowCount;
        $option['recordsFiltered'] = $rowCount;
        $option['data']            = array();

        foreach ($list->result() as $row) {
        
         /* custom gunakan*/
          $option['data'][] = array(
                                anchor('admin/by_sup/'.$row->id,'Input DINA', array('class' => 'btn btn-sm btn-primary btn-flat')),
                                anchor('admin/by_tl/'.$row->id,'Posting TIAL', array('class'=>'btn btn-sm btn-success btn-flat')),
                                $row->tanggal,
                                $row->logid,
                                $row->witel,
                                $row->nm_pelapor,
                                $row->nm_pelanggan,
                                $row->no_fastel,
                                $row->alamat,
                                $row->no_tiket,
                                $row->tgl_open,
                                $row->sta_tiket,
                                $row->lapul,
                                $row->gaul,
                                $row->cp,
                                $row->email,
                                $row->keluhan,
                                
                              ); 
         
           /*$rows = array();
           for ($i=0; $i < $count_c; $i++) { 
               $rows[] = $row->$columnd[$i];
           }
           $option['data'][] = $rows;*/
        }

        // eksekusi json
        echo json_encode($option);
    }

    function tiket_sup($dt){

        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

        //$join = $dt['join'];
        //$sql  = "SELECT {$columns} FROM {$dt['table']} {$join}";
        $kondisi = 'where by_sup = "new" and by_tl = "oke"';

        $sql  = "SELECT {$columns} FROM {$dt['table']} {$kondisi}";

        $data = $this->db->query($sql);

        $rowCount = $data->num_rows();

        $data->free_result();

        // pengkondisian aksi seperti next, search dan limit
        $columnd = $dt['col-display'];
        $count_c = count
        ($columnd);

        // search
        $search = $dt['search']['value'];

        /**
         * Search Global
         * pencarian global pada pojok kanan atas
         */
        $where = '';
        if ($search != '') {   
            for ($i=0; $i < $count_c ; $i++) {
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                
                if ($i < $count_c - 1) {
                    $where .= ' OR ';
                }
            }
        }
        
        /**
         * Search Individual Kolom
         * pencarian dibawah kolom
         */
        for ($i=0; $i < $count_c; $i++) { 
            $searchCol = $dt['columns'][$i]['search']['value'];
            if ($searchCol != '') {
                $where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
                break;
            }
        }

        /**
         * pengecekan Form pencarian
         * pencarian aktif jika ada karakter masuk pada kolom pencarian.
         */
        if ($where != '') {
            $sql .= " and " . $where;
            
        }
        
        // sorting
        $sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
        
        // limit
        $start  = $dt['start'];
        $length = $dt['length'];

        $sql .= " LIMIT {$start}, {$length}";
        
        $list = $this->db->query($sql);

        /**
         * convert to json
         */
        $option['draw']            = $dt['draw'];
        $option['recordsTotal']    = $rowCount;
        $option['recordsFiltered'] = $rowCount;
        $option['data']            = array();

        foreach ($list->result() as $row) {
        
         /* custom gunakan*/
          $option['data'][] = array(
                                anchor('admin/by_sup/'.$row->id,'Input DINA', array('class' => 'btn btn-sm btn-primary btn-flat')),
                                
                                $row->tanggal,
                                $row->logid,
                                $row->witel,
                                $row->nm_pelapor,
                                $row->nm_pelanggan,
                                $row->no_fastel,
                                $row->alamat,
                                $row->no_tiket,
                                $row->tgl_open,
                                $row->sta_tiket,
                                $row->lapul,
                                $row->gaul,
                                $row->cp,
                                $row->email,
                                $row->keluhan,
                                
                              ); 
         
           /*$rows = array();
           for ($i=0; $i < $count_c; $i++) { 
               $rows[] = $row->$columnd[$i];
           }
           $option['data'][] = $rows;*/
        }

        // eksekusi json
        echo json_encode($option);
    }


    function tiket_tl($dt){

        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

        //$join = $dt['join'];
        //$sql  = "SELECT {$columns} FROM {$dt['table']} {$join}";
        $kondisi = 'where by_sup = "oke" and by_tl = "new"';

        $sql  = "SELECT {$columns} FROM {$dt['table']} {$kondisi}";

        $data = $this->db->query($sql);

        $rowCount = $data->num_rows();

        $data->free_result();

        // pengkondisian aksi seperti next, search dan limit
        $columnd = $dt['col-display'];
        $count_c = count
        ($columnd);

        // search
        $search = $dt['search']['value'];

        /**
         * Search Global
         * pencarian global pada pojok kanan atas
         */
        $where = '';
        if ($search != '') {   
            for ($i=0; $i < $count_c ; $i++) {
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                
                if ($i < $count_c - 1) {
                    $where .= ' OR ';
                }
            }
        }
        
        /**
         * Search Individual Kolom
         * pencarian dibawah kolom
         */
        for ($i=0; $i < $count_c; $i++) { 
            $searchCol = $dt['columns'][$i]['search']['value'];
            if ($searchCol != '') {
                $where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
                break;
            }
        }

        /**
         * pengecekan Form pencarian
         * pencarian aktif jika ada karakter masuk pada kolom pencarian.
         */
        if ($where != '') {
            $sql .= " and " . $where;
            
        }
        
        // sorting
        $sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
        
        // limit
        $start  = $dt['start'];
        $length = $dt['length'];

        $sql .= " LIMIT {$start}, {$length}";
        
        $list = $this->db->query($sql);

        /**
         * convert to json
         */
        $option['draw']            = $dt['draw'];
        $option['recordsTotal']    = $rowCount;
        $option['recordsFiltered'] = $rowCount;
        $option['data']            = array();

        foreach ($list->result() as $row) {
        
         /* custom gunakan*/
          $option['data'][] = array(
                                
                                anchor('admin/by_tl/'.$row->id,'Posting TIAL', array('class'=>'btn btn-sm btn-success btn-flat')),
                                
                                $row->tanggal,
                                $row->logid,
                                $row->witel,
                                $row->nm_pelapor,
                                $row->nm_pelanggan,
                                $row->no_fastel,
                                $row->alamat,
                                $row->no_tiket,
                                $row->tgl_open,
                                $row->sta_tiket,
                                $row->lapul,
                                $row->gaul,
                                $row->cp,
                                $row->email,
                                $row->keluhan,
                                
                              ); 
         
           /*$rows = array();
           for ($i=0; $i < $count_c; $i++) { 
               $rows[] = $row->$columnd[$i];
           }
           $option['data'][] = $rows;*/
        }

        // eksekusi json
        echo json_encode($option);
    }


    function tiket_ok($dt){

        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

        //$join = $dt['join'];
        //$sql  = "SELECT {$columns} FROM {$dt['table']} {$join}";
        $kondisi = 'where by_sup = "oke" and by_tl = "oke"';

        $sql  = "SELECT {$columns} FROM {$dt['table']} {$kondisi}";

        $data = $this->db->query($sql);

        $rowCount = $data->num_rows();

        $data->free_result();

        // pengkondisian aksi seperti next, search dan limit
        $columnd = $dt['col-display'];
        $count_c = count
        ($columnd);

        // search
        $search = $dt['search']['value'];

        /**
         * Search Global
         * pencarian global pada pojok kanan atas
         */
        $where = '';
        if ($search != '') {   
            for ($i=0; $i < $count_c ; $i++) {
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                
                if ($i < $count_c - 1) {
                    $where .= ' OR ';
                }
            }
        }
        
        /**
         * Search Individual Kolom
         * pencarian dibawah kolom
         */
        for ($i=0; $i < $count_c; $i++) { 
            $searchCol = $dt['columns'][$i]['search']['value'];
            if ($searchCol != '') {
                $where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
                break;
            }
        }

        /**
         * pengecekan Form pencarian
         * pencarian aktif jika ada karakter masuk pada kolom pencarian.
         */
        if ($where != '') {
            $sql .= " and " . $where;
            
        }
        
        // sorting
        $sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
        
        // limit
        $start  = $dt['start'];
        $length = $dt['length'];

        $sql .= " LIMIT {$start}, {$length}";
        
        $list = $this->db->query($sql);

        /**
         * convert to json
         */
        $option['draw']            = $dt['draw'];
        $option['recordsTotal']    = $rowCount;
        $option['recordsFiltered'] = $rowCount;
        $option['data']            = array();

        foreach ($list->result() as $row) {
        
         /* custom gunakan*/
          $option['data'][] = array(
                                
                               
                                
                                $row->tanggal,
                                $row->logid,
                                $row->witel,
                                $row->nm_pelapor,
                                $row->nm_pelanggan,
                                $row->no_fastel,
                                $row->alamat,
                                $row->no_tiket,
                                $row->tgl_open,
                                $row->sta_tiket,
                                $row->lapul,
                                $row->gaul,
                                $row->cp,
                                $row->email,
                                $row->keluhan,
                                
                              ); 
         
           /*$rows = array();
           for ($i=0; $i < $count_c; $i++) { 
               $rows[] = $row->$columnd[$i];
           }
           $option['data'][] = $rows;*/
        }

        // eksekusi json
        echo json_encode($option);
    }

    

}

/* End of file m_hc.php */
/* Location: ./application/models/m_hc.php */