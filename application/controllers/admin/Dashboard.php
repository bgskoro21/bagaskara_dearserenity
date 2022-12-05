<?php 

class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
    }

    public function index(){
        $data['title'] = 'Dashboard';
        return $this->template->load_admin('admin/content/dashboard',$data);
    }
}




?>