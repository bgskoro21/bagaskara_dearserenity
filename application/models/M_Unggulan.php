<?php 

class M_Unggulan extends CI_Model{
    public function getAllFeatured(){
        $this->db->select('tbl_unggulan.*, tbl_cbarang.nama_barang');
        $this->db->from('tbl_unggulan');
        $this->db->join('tbl_cbarang','tbl_unggulan.barang_id = tbl_cbarang.id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getFeaturedProducts(){
        $this->db->select('tbl_unggulan.*, tbl_cbarang.nama_barang, tbl_cbarang.foto_barang, tbl_cbarang.harga_barang, tbl_season.nama_season, tbl_gallery.model1_pic');
        $this->db->from('tbl_unggulan');
        $this->db->order_by('tbl_season.nama_season','ASC');
        $this->db->join('tbl_cbarang','tbl_unggulan.barang_id = tbl_cbarang.id');
        $this->db->join('tbl_season','tbl_cbarang.season_id = tbl_season.id');
        $this->db->join('tbl_gallery','tbl_cbarang.gallery_id = tbl_gallery.id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function add_featured($data){
        $query = $this->db->insert('tbl_unggulan',$data);
        return $query;
    }

    public function hapus_featured($id){
        $this->db->where('id',$id);
        $this->db->delete('tbl_unggulan');
    }

    public function getDataById($id){
        $this->db->from('tbl_unggulan');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function edit_featured($data,$id){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_unggulan',$data);
        return $query;
    }
}

?>