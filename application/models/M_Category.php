<?php 

class M_Category extends CI_Model{
    public function getAllCategory(){
        $this->db->from('tbl_category');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function tambah_category($data){
        $query = $this->db->insert('tbl_category',$data);
        return $query;
    }

    public function hapus_category($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_category');
        return $query;
    }

    public function getCategoryById($id){
        $this->db->from('tbl_category');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function edit_category($data){
        $query = $this->db->update('tbl_category',$data);
        return $query;
    }
}


?>