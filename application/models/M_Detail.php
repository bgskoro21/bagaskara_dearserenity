<?php 

class M_Detail extends CI_Model{
    public function getAllUkuran(){
        $this->db->from('tbl_detail_ukuran');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function addDetailUkuran($data){
        $query = $this->db->insert('tbl_detail_ukuran',$data);
        return $query;
    }

    public function hapus_ukuran($id){
        $this->db->from('tbl_detail_ukuran');
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_detail_ukuran');
        return $query;
    }

    public function getDataById($id){
        $this->db->from('tbl_detail_ukuran');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function edit_ukuran($data,$id){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_detail_ukuran',$data);
        return $query;
    }
}



?>