<?php 

class M_Barang extends CI_Model{

    public function getBarang($number, $offset){
        $this->db->select('tbl_barang.*, tbl_detail_ukuran.ukuran, tbl_cbarang.nama_barang');
        $this->db->join('tbl_detail_ukuran', 'tbl_barang.ukuran_id = tbl_detail_ukuran.id');
        $this->db->join('tbl_cbarang', 'tbl_barang.barang_id = tbl_cbarang.id');
        $query = $this->db->get('tbl_barang', $number, $offset)->result_array();
        return $query;
    }

    public function jumlah_data(){
        return $this->db->get('tbl_barang')->num_rows();
    }

    public function tambahDataBarang($data){
        $query = $this->db->insert('tbl_barang',$data);
        return $query;
    }

    public function hapusDataBarang($id){
        $this->db->where('id',$id);
        $delete = $this->db->delete('tbl_barang');
        return $delete;
    }

    public function editDataBarang($data,$id){
        $this->db->from('tbl_barang');
        $this->db->where('id',$id);

        $query = $this->db->update('tbl_barang',$data);
        return $query;
    }

    public function getDataById($id){
        $this->db->select('tbl_barang.*');
        $this->db->from('tbl_barang');
        $this->db->where('id',$id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function getDetail($size,$id){
        $this->db->select('tbl_detail_ukuran.ukuran, tbl_cbarang.*, tbl_barang.*');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_cbarang','tbl_barang.barang_id = tbl_cbarang.id');
        $this->db->join('tbl_detail_ukuran','tbl_barang.ukuran_id = tbl_detail_ukuran.id');
        $this->db->where('tbl_detail_ukuran.ukuran',$size);
        $this->db->where('tbl_cbarang.id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

}



?>