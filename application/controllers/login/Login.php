<?php 


class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Login';
        return $this->template->load('login/index',$data);
    }

    public function handle_login(){
        $username = $this->input->post('username');
        $password = base64_encode($this->input->post('password')); 

        $hasil = $this->mdl->getDataLogin($username, $password);
        if($hasil){
            $this->session->set_userdata($hasil);
            if($hasil['level'] != 'User'){
                redirect('admin');
            }else{
                redirect('/');
            }
        }else{
            redirect('login');
        }
    }

    public function handle_logout(){
        $this->session->sess_destroy();
        redirect('/');
    }

    

}


?>