<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $data['title'] = 'Home';
        return $this->template->load('/user/view_home',$data);
    }
}