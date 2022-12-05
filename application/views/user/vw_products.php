<section>
    <div class="container">
        <h1 class="mt-2">All Products</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2">Search</span>
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <?php foreach($products as $product) : ?>
            <div class="col-md-3 mb-2">
            <div class="card">
                <img src="<?= $product['foto_barang'] ?>" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-bold"><?= $product['nama_barang']  ?></h6>
                    <p class="card-text">Rp. <?= $product['harga_barang']  ?></p>
                    <a href="#" class="btn btn-dark">Lihat Detail</a>
                </div>
            </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>