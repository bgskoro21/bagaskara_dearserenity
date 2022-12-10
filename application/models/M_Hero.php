<?php 

class M_Hero extends CI_Model{
    public function getAllHero(){
        $this->db->from('tbl_hero');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function add_hero($data){
        $query = $this->db->insert('tbl_hero',$data);
        return $query;
    }

    public function delete_hero($id){
        $this->db->where('id',$id);
        $this->db->delete('tbl_hero');
    }

    public function getHeroById($id){
        $this->db->from('tbl_hero');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function getGambarLama($id){
        $this->db->select('hero_pic');
        $this->db->from('tbl_hero');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function edit_hero($data, $id){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_hero',$data);
        return $query;
    }
}


?>