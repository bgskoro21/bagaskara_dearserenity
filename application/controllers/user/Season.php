<?php 

class Season extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Season','mdl',TRUE);
        $this->load->model('M_cBarang','model',TRUE);

    }

    public function index(){
        $data['title'] = 'Season';
        $data['seasons'] = $this->mdl->getDataSeason();
        return $this->template->load('user/vw_season',$data);
    }

    public function showDetailSeason($id){
        $data['title'] = 'Detail Season';
        $data['season'] = $this->mdl->getDataById($id)[0];
        $data['barang'] = $this->model->getBarangBySeason($id);
        return $this->template->load('user/vw_detailseason',$data);
    }
}



?>