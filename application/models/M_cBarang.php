<?php 

class M_cBarang extends CI_Model{

    public function getAllBarang(){
        $query = $this->db->get('tbl_cbarang')->result_array();
        return $query;
    }

    public function getBarang($number, $offset){
        $this->db->select('tbl_cbarang.*, tbl_season.nama_season');
        $this->db->join('tbl_season', 'tbl_cbarang.season_id = tbl_season.id');
        $query = $this->db->get('tbl_cbarang', $number, $offset)->result_array();
        return $query;
    }

    public function jumlah_data(){
        return $this->db->get('tbl_cbarang')->num_rows();
    }

    public function tambahDataBarang($data){
        $query = $this->db->insert('tbl_cbarang',$data);
        return $query;
    }

    public function hapusDataBarang($id){
        $this->db->where('id',$id);
        $delete = $this->db->delete('tbl_cbarang');
        return $delete;
    }

    public function editDataBarang($data,$id){
        $this->db->from('tbl_cbarang');
        $this->db->where('id',$id);

        $query = $this->db->update('tbl_cbarang',$data);
        return $query;
    }

    public function getDataById($id){
        $this->db->select('tbl_cbarang.*');
        $this->db->from('tbl_cbarang');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    function getGambarLama($id){
        $this->db->select('foto_barang');
        $this->db->from('tbl_cbarang');
        $this->db->where('id',$id);

        $query = $this->db->get()->result_array();
        return $query[0];
    }

    function detailBarang($id){
        $this->db->select('tbl_cbarang.*, tbl_user.nama_lengkap, tbl_season.nama_season,tbl_season.tema_season ');
        $this->db->from('tbl_cbarang');
        $this->db->join('tbl_user', 'tbl_user.id = tbl_cbarang.user_id');
        $this->db->join('tbl_season', 'tbl_season.id = tbl_cbarang.season_id');
        $this->db->where('tbl_cbarang.id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    function getBarangBySeason($season){
        $this->db->from('tbl_cbarang');
        $this->db->where('season_id',$season);
        $query = $this->db->get()->result_array();
        return $query;
    }

}



?>