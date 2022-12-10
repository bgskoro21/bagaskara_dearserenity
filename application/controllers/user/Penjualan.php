<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Hero','mdl',TRUE);
        $this->load->model('M_cBarang','mdlBarang',TRUE);
        $this->load->model('M_Unggulan','mdlUnggulan',TRUE);
    }
    public function index(){
        $data['title'] = 'Home';
        $data['heros'] = $this->mdl->getAllHero();
        $data['newest'] = $this->mdlBarang->getNewestProducts();
        $data['featureds'] = $this->mdlUnggulan->getFeaturedProducts();
        return $this->template->load('/user/view_home',$data);
    }
}