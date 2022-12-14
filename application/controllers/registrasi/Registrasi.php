<?php 

class Registrasi extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Registrasi';
        return $this->template->load('registrasi/index',$data);
    }

    public function add_user(){
        $data = [
            "nama_lengkap" => $this->input->post('nama_lengkap'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('username'),
            "password" => base64_encode($this->input->post('password')) ,
            "alamat" => $this->input->post('alamat'),
            "level" => 'User',
        ];

        $hasil = $this->mdl->tambahUser($data);
        if($hasil == 1){
            $this->session->set_flashdata('success','Akun Anda Berhasil Dibuat! Silahkan Login!');
            redirect('login');
        }else{
            $this->session->set_flashdata('success','Akun Anda Gagal Dibuat, Username Sudah Digunakan!');
            redirect('admin/user');
        }
    }
}





?>