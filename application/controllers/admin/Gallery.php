<?php 

class Gallery extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cBarang','mdlBarang', TRUE);
        $this->load->model('M_Gallery','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Gallery Products';
        $data['galleries'] = $this->mdl->getAllGallery();
        $data['products'] = $this->mdlBarang->getAllBarang();
        return $this->template->load_admin('admin/content/gallery/vw_gallery',$data);
    }

    public function add_gallery(){

        $data = [
            'judul' => $this->input->post('judul'),
            'user_id' => $this->session->userdata('id')
        ];

        $config['upload_path'] = './assets/gallery';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('catalog_pic')){
            $data['catalog_pic'] = null;
        }else{
            $catalog = $this->upload->data('file_name');
            $data['catalog_pic'] = base_url('assets/gallery/'.$catalog);
        }

        // var_dump($catalog);

        if (!$this->upload->do_upload('model1_pic')){
            $data['model1_pic'] = null;
        }else{
            $model1 = $this->upload->data('file_name');
            $data['model1_pic'] = base_url('assets/gallery/'.$model1);
        }

        if (!$this->upload->do_upload('model2_pic')){
            $data['model2_pic'] = null;
        }else{
            $model2 = $this->upload->data('file_name');
            $data['model2_pic'] = base_url('assets/gallery/'.$model2);
        }

        $hasil = $this->mdl->insert_gallery($data);
        if($hasil){
            $this->session->set_flashdata('success','Data Gallery Berhasil Ditambahkan');
            redirect('admin/gallery');
        }else{
            $this->session->set_flashdata('success','Data Gallery Gagal Ditambahkan');
            redirect('admin/gallery');
        }
    }

    public function hapus_gallery($id){
        $this->mdl->hapus_gallery($id);
    }

    public function getGalleryById($id){
        $hasil = $this->mdl->getGalleryById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function edit_gallery($id){

        $data = [
            'judul' => $this->input->post('judul'),
            'user_id' => $this->session->userdata('id')
        ];

        $config['upload_path'] = './assets/gallery';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('catalog_pic')){
            $this->mdl->update_gallery($data,$id);
        }else{
            $catalog = $this->upload->data('file_name');
            $data['catalog_pic'] = base_url('assets/gallery/'.$catalog);
        }

        // var_dump($catalog);

        if (!$this->upload->do_upload('model1_pic')){
            $this->mdl->update_gallery($data,$id);
        }else{
            $model1 = $this->upload->data('file_name');
            $data['model1_pic'] = base_url('assets/gallery/'.$model1);
        }

        if (!$this->upload->do_upload('model2_pic')){
            $this->mdl->update_gallery($data,$id);
        }else{
            $model2 = $this->upload->data('file_name');
            $data['model2_pic'] = base_url('assets/gallery/'.$model2);
        }

        $hasil = $this->mdl->update_gallery($data,$id);
        if($hasil){
            $this->session->set_flashdata('success','Data Gallery Berhasil Diupdate');
            redirect('admin/gallery');
        }else{
            $this->session->set_flashdata('success','Data Gallery Gagal Diupdate');
            redirect('admin/gallery');
        }
    }


}




?>