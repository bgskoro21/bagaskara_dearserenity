<?php 


class Products extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cBarang','mdl',TRUE);
        $this->load->model('M_Barang','mdlBarang',TRUE);
        $this->load->model('M_Category','mdlCategory',TRUE);
        $this->load->model('M_Season','mdlSeason',TRUE);
        $this->load->model('M_Harga','mdlHarga',TRUE);
        $this->load->model('M_Detail','mdlUkuran',TRUE);
    }

    public function index(){
        $data['title'] = 'Products';
        $data['products'] = $this->mdl->getBarangDisetujui();
        $data['categories'] = $this->mdlCategory->getAllCategory();
        $data['seasons'] = $this->mdlSeason->getDataSeason();
        $data['prices'] = $this->mdlHarga->getAllHarga();
        return $this->template->load('user/vw_products.php',$data);
    }

    public function search(){
        $output = '';
        $query = $this->input->post('keyword');
        $data = $this->mdl->search_data($query);
        // echo count($data);
        if(count($data) > 0)
        {
        foreach($data as $row)
        {
            $output .= '
            <div class="col-md-3 mb-2">
            <div class="card">
                <img src="'.base_url($row['foto_barang']).'" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-bold">'.$row['nama_barang'].'</h6>
                    <p class="card-text">Rp. '.$row['harga_barang'].'</p>
                    <a href="#" class="btn btn-dark">Lihat Detail</a>
                </div>
            </div>
            </div>
            ';
        }
        }
        else
        {
        $output .= '<p>No Data Found</p>';
        }
        echo $output;
        }

        public function searchByCategory(){
            $output = '';
            $query = $this->input->post('category');
            $data = $this->mdl->searchByCategory($query);
            // echo json_encode($data);
            // // echo count($data);
            if(count($data) > 0)
            {
            foreach($data as $row)
            {
                $output .= '
                <div class="col-md-3 mb-2">
                <div class="card">
                    <img src="'.base_url($row['foto_barang']).'" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">'.$row['nama_barang'].'</h6>
                        <p class="card-text">Rp. '.$row['harga_barang'].'</p>
                        <a href="'.base_url('user/products/detail?size=M&id='.$row['id']).'" class="btn btn-dark">Lihat Detail</a>
                    </div>
                </div>
                </div>
                ';
            }
            }
            else
            {
            $output .= '<p>No Data Found</p>';
            }
            echo $output;
            }

            public function searchBySeason(){
                $output = '';
                $query = $this->input->post('season');
                $data = $this->mdl->searchBySeason($query);
                // echo json_encode($data);
                // // echo count($data);
                if(count($data) > 0)
                {
                foreach($data as $row)
                {
                    $output .= '
                    <div class="col-md-3 mb-2">
                    <div class="card">
                        <img src="'.base_url($row['foto_barang']).'" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">'.$row['nama_barang'].'</h6>
                            <p class="card-text">Rp. '.$row['harga_barang'].'</p>
                            <a href="'.base_url('user/products/detail?size=M&id='.$row['id']).'" class="btn btn-dark">Lihat Detail</a>
                        </div>
                    </div>
                    </div>
                    ';
                }
                }
                else
                {
                $output .= '<p>No Data Found</p>';
                }
                echo $output;
            }

            public function searchByHarga(){
                $output = '';
                $query = $this->input->post('harga');
                $data = $this->mdl->searchByHarga($query);
                // echo json_encode($data);
                // // echo count($data);
                if(count($data) > 0)
                {
                foreach($data as $row)
                {
                    $output .= '
                    <div class="col-md-3 mb-2">
                    <div class="card">
                        <img src="'.base_url($row['foto_barang']).'" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">'.$row['nama_barang'].'</h6>
                            <p class="card-text">Rp. '.$row['harga_barang'].'</p>
                            <a href="'.base_url('user/products/detail?size=M&id='.$row['id']).'" class="btn btn-dark">Lihat Detail</a>
                        </div>
                    </div>
                    </div>
                    ';
                }
                }
                else
                {
                $output .= '<p>No Data Found</p>';
                }
                echo $output;
            }

    public function detail(){
        $params = $this->input->get('size',TRUE);
        $id = $this->input->get('id',TRUE);
        $data['title'] = 'Detail Produk';
        $data['detail'] = $this->mdlBarang->getDetail($params,$id);
        $data['ukuran'] = $this->mdlBarang->getUkuranByBarangId($id);
        return $this->template->load('user/vw_detailproduk',$data);
    }
}

?>