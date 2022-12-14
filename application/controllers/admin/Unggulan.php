<?php 

class Unggulan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cBarang','mdl',TRUE);
        $this->load->model('M_Unggulan','mdlUnggulan',TRUE);
    }

    public function index(){
        $data['title']= 'Produk Unggulan';
        $data['products'] = $this->mdl->getBarangDisetujui();
        $data['featureds'] = $this->mdlUnggulan->getAllFeatured();
        return $this->template->load_admin('admin/content/unggulan/vw_unggulan',$data);
    }

    public function add_unggulan(){
        $data = [
            'barang_id' => $this->input->post('barang_id'),
            'user_id' => $this->session->userdata('id')
        ];

        $hasil = $this->mdlUnggulan->add_featured($data);
        if($hasil){
            $this->session->set_flashdata('success','Data Produk Unggulan Berhasil Ditambahkan');
            redirect('admin/unggulan');
        }else{
            $this->session->set_flashdata('success','Data Produk Unggulan Gagal Ditambahkan');
            redirect('admin/unggulan');
        }


    }

    public function hapus_unggulan($id){
        $this->mdlUnggulan->hapus_featured($id);
    }

    public function getUnggulanById($id){
        $hasil = $this->mdlUnggulan->getDataById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }
    
    public function edit_unggulan($id){
        $data = [
            'barang_id' => $this->input->post('barang_id'),
            'user_id' => $this->session->userdata('id')
        ];

        $hasil = $this->mdlUnggulan->edit_featured($data,$id);
        if($hasil){
            $this->session->set_flashdata('success','Data Produk Unggulan Berhasil Ditambahkan');
            redirect('admin/unggulan');
        }else{
            $this->session->set_flashdata('success','Data Produk Unggulan Gagal Ditambahkan');
            redirect('admin/unggulan');
        }


    }

}


?>