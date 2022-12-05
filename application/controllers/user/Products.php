<?php 


class Products extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cBarang','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Products';
        $data['products'] = $this->mdl->getAllBarang();
        return $this->template->load('user/vw_products.php',$data);
    }

}



?>