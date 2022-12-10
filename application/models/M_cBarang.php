<?php 

class M_cBarang extends CI_Model{

    public function getAllBarang(){
        $query = $this->db->get('tbl_cbarang')->result_array();
        return $query;
    }

    public function getBarang(){
        $this->db->select('tbl_cbarang.*, tbl_season.nama_season, tbl_category.nama_category');
        $this->db->join('tbl_season', 'tbl_cbarang.season_id = tbl_season.id');
        $this->db->join('tbl_category', 'tbl_cbarang.category_id = tbl_category.id');
        $query = $this->db->get('tbl_cbarang')->result_array();
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

    function search_data($keyword){
        $this->db->from('tbl_cbarang');
        $this->db->like('nama_barang',$keyword);
        $this->db->or_like('harga_barang',$keyword);
        $query = $this->db->get()->result_array();
        return $query;
    }

    function searchByCategory($category){
        $this->db->from('tbl_cbarang');
        if($category!=0){
            $this->db->where('category_id',$category);
        }
        $query = $this->db->get()->result_array();
        return $query;
    }

    function searchBySeason($season){
        $this->db->from('tbl_cbarang');
        if($season!=0){
            $this->db->where('season_id',$season);
        }
        $query = $this->db->get()->result_array();
        return $query;
    }

    function searchByHarga($harga){
        $this->db->from('tbl_cbarang');
        if($harga!=0){
            $this->db->where('harga_id',$harga);
        }
        $query = $this->db->get()->result_array();
        return $query;
    }

    function getNewestProducts(){
        $this->db->select('tbl_cbarang.*, tbl_season.nama_season, tbl_season.tema_season,tbl_gallery.catalog_pic, tbl_gallery.model1_pic');
        $this->db->from('tbl_cbarang');
        $this->db->join('tbl_season','tbl_cbarang.season_id = tbl_season.id');
        $this->db->join('tbl_gallery','tbl_cbarang.gallery_id = tbl_gallery.id');
        $this->db->order_by('tbl_cbarang.id','DESC');
        $this->db->limit(3);
        $query = $this->db->get()->result_array();
        return $query;
    }



}



?>