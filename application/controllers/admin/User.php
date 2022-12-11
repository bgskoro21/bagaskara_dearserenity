<?php 

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User','mdl',TRUE);
        if(!$this->session->userdata('username')){
            redirect('login');
        }
    }

    public function index(){
        $data['users'] = $this->mdl->getDataUser();
        $data['title'] = 'Daftar User';

        return $this->template->load_admin('admin/content/user/vw_useradmin',$data);
    }

    public function hapus_user($id){
       $this->mdl->hapus_user($id);
    }

    public function add_user(){
        $data = [
            "nama_lengkap" => $this->input->post('nama_lengkap'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('username'),
            "password" => base64_encode($this->input->post('password')) ,
            "alamat" => $this->input->post('alamat'),
            "level" => $this->input->post('level'),
        ];

        $hasil = $this->mdl->tambahUser($data);
        if($hasil == 1){
            $this->session->set_flashdata('success','Data User Berhasil Ditambahkan');
            redirect('admin/user');
        }else{
            $this->session->set_flashdata('success','Data User Gagal Ditambahkan! Username Sudah Digunakan!');
            redirect('admin/user');
        }
    }

    public function getDataByID($id){
        $hasil = $this->mdl->getDataByID($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function edit_user($id){
        $data = [
            "nama_lengkap" => $this->input->post('nama_lengkap'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
            "alamat" => $this->input->post('alamat'),
            "level" => $this->input->post('level'),
        ];

        if($this->session->userdata('id') == $id){
            $this->session->set_userdata([
                "email" => $this->input->post('email'),
                "username" => $this->input->post('username'),
                "alamat" => $this->input->post('alamat'),
                "level" => $this->input->post('level'),
            ]);
        }

        $hasil = $this->mdl->editUser($data, $id);
        if($hasil){
            $this->session->set_flashdata('success','Data User Berhasil Diupdate');
            redirect('admin/user');
        }else{
            $this->session->set_flashdata('success','Data User Gagal Diupdate');
            redirect('admin/user');
        }
    }

    public function show_detail($id){
        $data['title'] = 'Detail User';
        $data['user'] = $this->mdl->getDataById($id);
        return $this->template->load_admin('/admin/content/user/vw_detailuser',$data);
    }

}


?>