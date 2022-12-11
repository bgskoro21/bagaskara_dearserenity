<?php 

class M_User extends CI_Model{

    public function getDataUser(){
        $this->db->from('tbl_user');
        $this->db->order_by('level','DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function hapus_user($id){
        $this->db->from('tbl_user');
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_user');
        return $query;
    }

    public function tambahUser($data){
        $this->db->select('username');
        $this->db->from('tbl_user');
        $this->db->where('username',$data['username']);
        $get = $this->db->get()->result();
        if(count($get) == 0){
          $this->db->insert('tbl_user',$data);
          $hasil = 1;
        }else{
            $hasil = 0;
        }
        return $hasil;
    }

    public function getDataByID($id){
        $this->db->from('tbl_user');
        $this->db->where('id',$id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function editUser($data, $id){
        $this->db->from('tbl_user');
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_user',$data);
        return $query;
    }

    public function getDataLogin($username, $password){
        $this->db->select('foto_profile, level, alamat, username, email,id');
        $this->db->from('tbl_user');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query = $this->db->get()->result_array();
        return $query[0];
    }
}

?>