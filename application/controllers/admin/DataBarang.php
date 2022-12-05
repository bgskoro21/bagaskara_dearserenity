<?php 

class DataBarang extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang','mdl',TRUE);
        $this->load->model('M_cBarang','modelBarang',TRUE);
        $this->load->model('M_Detail','modelDetail',TRUE);
        if(!$this->session->userdata('username')){
            redirect('login');
        }
    }

    public function index(){
        // var_dump($this->uri->segment(1));
        $jumlah_data = $this->mdl->jumlah_data();
        $config['base_url'] = base_url().'/admin/databarang/index';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 5;
        // Bootstrap
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link bg-dark">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data['barang'] = $this->mdl->getBarang($config['per_page'], $from);
        $data['dafbarang'] = $this->modelBarang->getAllBarang();
        $data['sizes'] = $this->modelDetail->getAllUkuran();
        $data['page_number'] = $this->uri->segment(4);
        $data['title'] = 'Data Barang';
        return $this->template->load_admin('admin/content/barang/vw_databarang',$data);
    }

    public function addDataBarang(){
        $data = [
            "barang_id" => $this->input->post('barang_id'),
            "ukuran_id" => $this->input->post('ukuran_id'),
            "stok" => $this->input->post('stok'),
            "user_id" => $this->session->userdata('id'),
        ];

        $hasil = $this->mdl->tambahDataBarang($data);
        if($hasil){
            redirect('admin/databarang');
        }
    }

    public function hapusDataBarang($id){
       $this->mdl->hapusDataBarang($id);
    }

    public function edit($id){
        $hasil = $this->mdl->getDataById($id);
        if($hasil){
            echo json_encode($hasil);
        }
    }

    public function editDataBarang($id){

        $data = [
            "barang_id" => $this->input->post('barang_id'),
            "ukuran_id" => $this->input->post('ukuran_id'),
            "stok" => $this->input->post('stok'),
            "user_id" => $this->session->userdata('id'),
        ];

        $hasil = $this->mdl->editDataBarang($data,$id);

        if($hasil){
            redirect('admin/databarang');
        }
    }
}

?>