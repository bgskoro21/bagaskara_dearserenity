<?php 

class DetailUkuran extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Detail','mdl',TRUE);
    }

    public function index(){
        $data['title'] = 'Detail Ukuran';
        $data['sizes'] = $this->mdl->getAllUkuran();
        return $this->template->load_admin('admin/content/detail/vw_detailukuran',$data);
    }

    public function addDetailUkuran(){
        $data = [
            "ukuran" => $this->input->post('ukuran'),
            "keterangan" => $this->input->post('keterangan'),
            "user_id" => $this->session->userdata('id')
        ];

        $hasil = $this->mdl->addDetailUkuran($data);
        if($hasil){
            $this->session->set_flashdata('success','Data Ukuran Berhasil Ditambahkan');
            redirect('admin/detailukuran');
        }else{
            $this->session->set_flashdata('success','Data Ukuran Gagal Ditambahkan');
            redirect('admin/detailukuran');
        }
    }

    public function hapus_ukuran($id){
        $this->mdl->hapus_ukuran($id);
    }

    public function getUkuranById($id){
        $hasil = $this->mdl->getDataById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function edit_ukuran($id){
        $data = [
            "ukuran" => $this->input->post('ukuran'),
            "keterangan" => $this->input->post('keterangan'),
            "user_id" => $this->session->userdata('id')
        ];

        $hasil = $this->mdl->edit_ukuran($data,$id);
        if($hasil){
            $this->session->set_flashdata('success','Data Ukuran Berhasil Diupdate');
            redirect('admin/detailukuran');
        }else{
            $this->session->set_flashdata('success','Data Ukuran Gagal Diupdate');
            redirect('admin/detailukuran');
        }
    }
}


?>