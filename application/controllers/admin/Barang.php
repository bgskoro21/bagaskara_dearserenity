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
        // // var_dump($this->uri->segment(1));
        // $jumlah_data = $this->mdl->jumlah_data();
        // $config['base_url'] = base_url().'/admin/barang/index';
        // $config['total_rows'] = $jumlah_data;
        // $config['per_page'] = 5;
        // // Bootstrap
        // $config['first_link']       = 'First';
        // $config['last_link']        = 'Last';
        // $config['next_link']        = 'Next';
        // $config['prev_link']        = 'Prev';
        // $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        // $config['full_tag_close']   = '</ul></nav></div>';
        // $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        // $config['num_tag_close']    = '</span></li>';
        // $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link bg-dark">';
        // $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        // $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        // $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        // $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        // $config['prev_tagl_close']  = '</span>Next</li>';
        // $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        // $config['first_tagl_close'] = '</span></li>';
        // $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        // $config['last_tagl_close']  = '</span></li>';
        // $from = $this->uri->segment(4);
        // $this->pagination->initialize($config);
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

        $data['foto_barang'] = base_url("/assets/images/".$uploaded_data);

        $hasil = $this->mdl->tambahDataBarang($data);
        if($hasil){
            redirect('admin/barang');
        }
    }

    public function hapusDataBarang($id){
        $gambarLama = $this->mdl->getGambarLama($id);
        $explode = explode('/', $gambarLama['foto_barang']);
        $hasil = $this->mdl->hapusDataBarang($id);
        if($hasil){
            unlink('./assets/images/'.$explode[6]);
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
        
        $config['upload_path'] = './assets/images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload('photo_barang')){
            $hasil = $this->mdl->editDataBarang($data,$id);
        }else{
            if($gambarLama != null){
                unlink('./assets/images/'.$explode[6]);
            }
            $uploaded_data = $this->upload->data('file_name');
            $data['foto_barang'] = base_url("/assets/images/".$uploaded_data);
            $hasil = $this->mdl->editDataBarang($data,$id);
        }

        if($hasil){
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