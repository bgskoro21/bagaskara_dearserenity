<?php 

class Hero extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Hero','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Hero Hompage';
        $data['heros'] = $this->mdl->getAllHero();
        return $this->template->load_admin('admin/content/hero/vw_hero',$data);
    }

    public function add_hero(){
        $data['user_id'] = $this->session->userdata('id');
        $config['upload_path'] = './assets/hero';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('hero_pic')){
            redirect('admin/hero');
        }else{
            $uploaded_data = $this->upload->data('file_name');
        }

        $data['hero_pic'] = base_url("/assets/hero/".$uploaded_data);

        $hasil = $this->mdl->add_hero($data);
        if($hasil){
            redirect('admin/hero');
        }

    }

    public function preview(){
        $data['title'] = 'Preview Hero';
        $data['heros'] = $this->mdl->getAllHero();
        return $this->template->load_admin('admin/content/hero/vw_preview_hero',$data);
    }

    public function hapus_hero($id){
        $this->mdl->delete_hero($id);
    }

    public function getDataById($id){
        $hasil = $this->mdl->getHeroById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function edit_hero($id){
        $data['user_id'] = $this->session->userdata('id');
        $gambarLama = $this->mdl->getGambarLama($id);
        $explode = explode('/', $gambarLama['hero_pic']);

        $config['upload_path'] = './assets/hero';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('hero_pic')){
            redirect('admin/hero');
        }else{
            if($gambarLama != null){
                unlink('./assets/hero/'.$explode[6]);
            }
            $uploaded_data = $this->upload->data('file_name');
        }

        $data['hero_pic'] = base_url("/assets/hero/".$uploaded_data);

        $hasil = $this->mdl->edit_hero($data,$id);
        if($hasil){
            redirect('admin/hero');
        }


        
    }
}


?>