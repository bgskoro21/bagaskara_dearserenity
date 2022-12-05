<?php 

class M_Season extends CI_Model{
    public function getDataSeason(){
        $this->db->from('tbl_season');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function delete_season($id){
        $this->db->from('tbl_season');
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_season');
        return $query;
    }

    public function tambahSeason($data){
        $query = $this->db->insert('tbl_season',$data);
        return $query;
    }

    public function getDataById($id){
        $this->db->from('tbl_season');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function editDataSeason($data,$id){
        $this->db->from('tbl_season');
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_season',$data);
        return $query;
    }

    function getGambarLamaLogo($id){
        $this->db->select('logo_season');
        $this->db->from('tbl_season');
        $this->db->where('id',$id);

        $query = $this->db->get()->result_array();
        return $query[0];
    }

    function getGambarLamaHero($id){
        $this->db->select('hero_season');
        $this->db->from('tbl_season');
        $this->db->where('id',$id);

        $query = $this->db->get()->result_array();
        return $query[0];
    }
}




?>