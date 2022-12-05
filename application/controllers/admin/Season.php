<?php 

class Season extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Season','mdl',TRUE);
        if(!$this->session->userdata('username')){
            redirect('login');
        }
    }

    public function index(){
        $data['seasons'] = $this->mdl->getDataSeason();
        $data['title'] = 'Season';
        return $this->template->load_admin('admin/content/season/vw_season',$data);
    }

    public function hapus_season($id){
        // $gambarLama = $this->mdl->getGambarLama($id);
        // $explode = explode('/', $gambarLama['logo_season']);
        $this->mdl->delete_season($id);
        // if($hasil){
        //     unlink('./assets/images/'.$explode[6]);
        // }
    }

    public function add_season(){
        $data = [
            "nama_season" => $this->input->post('nama_season'),
            "desc_season" => $this->input->post('desc_season'),
            'tema_season' => strtoupper($this->input->post('tema_season')), 
            "user_id" => $this->session->userdata('id'),
        ];
        
        $config['upload_path'] = './assets/img_season';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('logo_season')){
            $data['error'] = $this->upload->display_errors();
        }else{
            $uploaded_data = $this->upload->data('file_name');
        }

        if(!$this->upload->do_upload('hero_season')){
            $data['error'] = $this->upload->display_errors();
        }else{
            $img_season = $this->upload->data('file_name');
        }

        $data['logo_season'] = base_url("/assets/img_season/".$uploaded_data);
        $data['hero_season'] = base_url('/assets/img_season/'.$img_season);

        $hasil = $this->mdl->tambahSeason($data);
        if($hasil){
            redirect('admin/season');
        }
    }

    public function editseason($id){
        $hasil = $this->mdl->getDataById($id);
        if($hasil){
            echo json_encode($hasil[0]);
        }
    }

    public function editDataSeason($id){

        $gambarLama = $this->mdl->getGambarLamaLogo($id);
        $explode = explode('/', $gambarLama['logo_season']);
        $heroLama = $this->mdl->getGambarLamaHero($id);
        $explode = explode('/', $heroLama['hero_season']);
        // var_dump($explode);

        $data = [
            "nama_season" => $this->input->post('nama_season'),
            "desc_season" => $this->input->post('desc_season'),
            'tema_season' => strtoupper($this->input->post('tema_season')),
            "user_id" => $this->session->userdata('id'),
        ];
        
        $config['upload_path'] = './assets/img_season';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('logo_season')){
            $hasil = $this->mdl->editDataSeason($data,$id);
        }else{
            if($gambarLama != null){
                unlink('./assets/logo_season/'.$explode[6]);
            }
            $uploaded_data = $this->upload->data('file_name');
            $data['logo_season'] = base_url("/assets/img_season/".$uploaded_data);
        }

        if (!$this->upload->do_upload('hero_season')){
            $hasil = $this->mdl->editDataSeason($data,$id);
        }else{
            if($gambarLama != null){
                unlink('./assets/img_season/'.$explode[6]);
            }
            $img_hero = $this->upload->data('file_name');
            $data['hero_season'] = base_url("/assets/img_season/".$img_hero);
        }
        
        $hasil = $this->mdl->editDataSeason($data,$id);
        if($hasil){
            redirect('admin/season');
        }
    }



}




?>