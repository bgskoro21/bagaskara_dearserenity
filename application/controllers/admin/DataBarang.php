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
        $data['barang'] = $this->mdl->getBarang();
        $data['dafbarang'] = $this->modelBarang->getBarangDisetujui();
        $data['sizes'] = $this->modelDetail->getAllUkuran();
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
            $this->session->set_flashdata('success','Data Barang Berhasil Ditambahkan');
            redirect('admin/databarang');
        }else{
            $this->session->set_flashdata('success','Data Barang Berhasil Ditambahkan');
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
            $this->session->set_flashdata('success','Data Barang Berhasil Diubah');
            redirect('admin/databarang');
        }else{
            $this->session->set_flashdata('success','Data Barang Berhasil Diubah');
            redirect('admin/databarang');
        }
    }
}

?>