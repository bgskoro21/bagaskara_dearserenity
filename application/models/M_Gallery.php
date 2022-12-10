<?php 

class M_Gallery extends CI_Model{
    public function getAllGallery(){
        $this->db->from('tbl_gallery');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function insert_gallery($data){
        $query = $this->db->insert('tbl_gallery',$data);
        return $query;
    }

    public function hapus_gallery($id){
        $this->db->where('id',$id);
        $this->db->delete('tbl_gallery');
    }

    public function getGalleryById($id){
        $this->db->from('tbl_gallery');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function update_gallery($data,$id){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_gallery',$data);
        return $query;
    }

}




?>