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

        $data['hero_pic'] = "/assets/hero/".$uploaded_data;
        $data['status'] = 'Belum Disetujui';

        $hasil = $this->mdl->add_hero($data);
        if($hasil){
            $this->session->set_flashdata('success','Data Hero Berhasil Ditambahkan!');
            redirect('admin/hero');
        }else{
            $this->session->set_flashdata('success','Data Hero Gagal Ditambahkan!');
            redirect('admin/hero');

        }

    }

    public function preview(){
        $data['title'] = 'Preview Hero';
        $data['heros'] = $this->mdl->getAllHero();
        return $this->template->load_admin('admin/content/hero/vw_preview_hero',$data);
    }

    public function hapus_hero($id){
        $gambarLama = $this->mdl->getGambarLama($id);
        $hero = explode('/',$gambarLama['hero_pic']);
        $hasil = $this->mdl->delete_hero($id);
        if($hasil){
            $this->session->set_flashdata('success','Data Berhasil Dihapus!');
            unlink('./assets/hero/'.$hero[3]);
            redirect('admin/hero');
        }
    }

    public function getDataById($id){
        $hasil = $this->mdl->getHeroById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function edit_hero($id){
        if($this->session->userdata('level') != 'Manager'){
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
                    unlink('./assets/hero/'.$explode[3]);
                }
                $uploaded_data = $this->upload->data('file_name');
            }
    
            $data['hero_pic'] = "/assets/hero/".$uploaded_data;
        }else{
            $data['status'] = $this->input->post('status');
        }

        $hasil = $this->mdl->edit_hero($data,$id);
        if($hasil){
            $this->session->set_flashdata('success','Data Hero Berhasil Diupdate!');
            redirect('admin/hero');
        }else{
            $this->session->set_flashdata('success','Data Hero Gagal Diupdate!');
            redirect('admin/hero');

        }


        
    }
}


?>