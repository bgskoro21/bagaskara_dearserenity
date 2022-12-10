<?php 

class Harga extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Harga','mdl',TRUE);
    }

    public function index(){
        $data['prices'] = $this->mdl->getAllHarga();
        $data['title'] = 'Rentang Harga';
        return $this->template->load_admin('admin/content/harga/vw_harga',$data);
    }

    public function addHarga(){
        $data = [
            "harga_min" => $this->input->post('harga_min'),
            "harga_max" => $this->input->post('harga_max'),
            "keterangan" => $this->input->post('keterangan'),
            'user_id' => $this->session->userdata('id')
        ];

        $hasil = $this->mdl->add_harga($data);
        if($hasil){
            redirect('admin/harga');
        }
    }

    public function hapus_harga($id){
        $this->mdl->hapus_harga($id);
    }

    public function getHargaById($id){
        $hasil = $this->mdl->getDataById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function edit_harga($id){
        $data = [
            "harga_min" => $this->input->post('harga_min'),
            "harga_max" => $this->input->post('harga_max'),
            "keterangan" => $this->input->post('keterangan'),
            'user_id' => $this->session->userdata('id')
        ];

        $hasil = $this->mdl->edit_harga($data,$id);
        if($hasil){
            redirect('admin/harga');
        }
    }
}


?>