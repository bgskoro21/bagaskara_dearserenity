<?php 

class M_Harga extends CI_Model{
    public function getAllHarga(){
        $this->db->from('tbl_harga');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function add_harga($data){
        $query = $this->db->insert('tbl_harga',$data);
        return $query;
    }

    public function hapus_harga($id){
        $this->db->where('id',$id);
        $this->db->delete('tbl_harga');
    }

    public function getDataById($id){
        $this->db->from('tbl_harga');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function edit_harga($data,$id){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_harga',$data);
        return $query;
    }
}


?>