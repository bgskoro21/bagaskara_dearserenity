<?php 

class Category extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Category','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Category';
        $data['categories'] = $this->mdl->getAllCategory();
        return $this->template->load_admin('admin/content/category/vw_category',$data);
    }

    public function tambah_category(){
        $data = [
            'nama_category' => $this->input->post('nama_category'),
            'user_id' => $this->session->userdata('id')
        ];

        $data = $this->mdl->tambah_category($data);
        if($data){
            $this->session->set_flashdata('success','Data Kategori Berhasil Ditambahkan');
            redirect('admin/category');
        }else{
            $this->session->set_flashdata('success','Data Kategori Gagal Ditambahkan');
            redirect('admin/category');
        }
    }

    public function hapus_category($id){
        $this->mdl->hapus_category($id);
    }

    public function getCategoryById($id){
        $data = $this->mdl->getCategoryById($id);
        if($data){
            echo json_encode($data);
        }
    }

    public function edit_category($id){
        $data = [
            'nama_category' => $this->input->post('nama_category'),
            'user_id' => $this->session->userdata('id')
        ];

        $data = $this->mdl->edit_category($data);
        if($data){
            $this->session->set_flashdata('success','Data Kategori Berhasil Diupdate');
            redirect('admin/category');
        }else{
            $this->session->set_flashdata('success','Data Kategori Gagal Diupdate');
            redirect('admin/category');
        }
    }
}


?>