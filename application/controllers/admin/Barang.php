<?php 

class Barang extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cBarang','mdl',TRUE);
        $this->load->model('M_Season','modelSeason',TRUE);
        $this->load->model('M_Category','modelCategory',TRUE);
        $this->load->model('M_Harga','modelHarga',TRUE);
        $this->load->model('M_Gallery','modelGallery',TRUE);
        if(!$this->session->userdata('username')){
            redirect('login');
        }
    }

    public function index(){
        $data['barang'] = $this->mdl->getBarang();
        $data['seasons'] = $this->modelSeason->getDataSeason();
        $data['prices'] = $this->modelHarga->getAllHarga();
        $data['categories'] = $this->modelCategory->getAllCategory();
        $data['galleries'] = $this->modelGallery->getAllGallery();
        // $data['page_number'] = $this->uri->segment(4);
        $data['title'] = 'Data Barang';
        return $this->template->load_admin('admin/content/cbarang/vw_databarang',$data);
    }

    public function addDataBarang(){
        $data = [
            "nama_barang" => $this->input->post('nama_barang'),
            "harga_barang" => $this->input->post('harga_barang'),
            "desc_barang" => $this->input->post('desc_barang'),
            'gallery_id' => $this->input->post('gallery_id'),
            "user_id" => $this->session->userdata('id'),
            "season_id" => $this->input->post('season_id'),
            "harga_id" => $this->input->post('harga_id'),
            "category_id" => $this->input->post('category_id'),
        ];

        // var_dump($data);
        
        $config['upload_path'] = './assets/images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('photo_barang')){
            $data['error'] = $this->upload->display_errors();
        }else{
            $uploaded_data = $this->upload->data('file_name');
        }

        $data['foto_barang'] = "/assets/images/".$uploaded_data;

        $hasil = $this->mdl->tambahDataBarang($data);
        if($hasil){
            $this->session->set_flashdata('success','Data Barang Berhasil Ditambahkan!');
            redirect('admin/barang');
        }else{
            $this->session->set_flashdata('success','Data Barang Gagal Ditambahkan!');
            redirect('admin/barang');
        }
    }

    public function hapusDataBarang($id){
        $gambarLama = $this->mdl->getGambarLama($id);
        $explode = explode('/', $gambarLama['foto_barang']);
        $hasil = $this->mdl->hapusDataBarang($id);
        if($hasil){
            unlink('./assets/images/'.$explode[3]);
        }
    }

    public function edit($id){
        $hasil = $this->mdl->getDataById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function editDataBarang($id){

        $gambarLama = $this->mdl->getGambarLama($id);
        $explode = explode('/', $gambarLama['foto_barang']);
        // var_dump($explode);

        if($this->session->userdata('level') != 'Manager'){
            $data = [
                "nama_barang" => $this->input->post('nama_barang'),
                "harga_barang" => $this->input->post('harga_barang'),
                "desc_barang" => $this->input->post('desc_barang'),
                'gallery_id' => $this->input->post('gallery_id'),
                "user_id" => $this->session->userdata('id'),
                "season_id" => $this->input->post('season_id'),
                "harga_id" => $this->input->post('harga_id'),
                "category_id" => $this->input->post('category_id')
            ];
        
        $config['upload_path'] = './assets/images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('photo_barang')){
            $hasil = $this->mdl->editDataBarang($data,$id);
        }else{
            if($gambarLama != null){
                unlink('./assets/images/'.$explode[3]);
            }
            $uploaded_data = $this->upload->data('file_name');
            $data['foto_barang'] = "/assets/images/".$uploaded_data;
        }
    }
        $data['status'] = $this->input->post('status');
        $hasil = $this->mdl->editDataBarang($data,$id);
        if($hasil){
            $this->session->set_flashdata('success','Data Barang Berhasil Diupdate!');
            redirect('admin/barang');
        }else{
            $this->session->set_flashdata('success','Data Barang Gagal Diupdate!');
            redirect('admin/barang');
        }
    }

    public function showDetailBarang($id){
        $data['title'] = 'Detail Barang';
        $data['barang'] = $this->mdl->detailBarang($id);
        if($data['barang']){
           return $this->template->load_admin('admin/content/cbarang/vw_detailbarang',$data);
        }
    }
}

?>