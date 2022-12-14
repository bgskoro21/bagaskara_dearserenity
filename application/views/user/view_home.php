<!-- Hero -->
<section style="margin-top: 73px;">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach($heros as $key => $hero): ?>
        <?php if($key==0): ?>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" class="active" aria-current="true" aria-label="Slide <?= $key+1 ?>"></button>
        <?php else : ?>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $key ?>" aria-label="Slide <?= $key+1 ?>"></button>
        <?php endif; ?>
        <?php endforeach ?>
    </div>
    <div class="carousel-inner">
        <?php foreach($heros as $key => $hero): ?>
        <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
        <img src="<?= base_url($hero['hero_pic']) ?>" class="d-block w-100 img-fluid" style="height:90vh">
        </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</section>
<!-- End Hero -->
<section class="section mb-4">
    <div class="container my-3 py-4">
        <h6 class="text-center fw-bold mb-4">NEWEST PRODUCTS</h6>
        <div class="row d-flex justify-content-between">
            <?php foreach($newest as $new): ?>
            <div class="col-md-4">
                <div class="card p-2">
                    <?php if($new['model1_pic']): ?>
                    <img src="<?= $new['model1_pic'] ?>" class="card-img-top" alt="...">
                    <?php else : ?>
                    <img src="<?= base_url($new['foto_barang']) ?>" class="card-img-top" alt="...">
                    <?php endif ?>
                    <div class="card-body">
                        <p class="card-text text-center fw-bold"><?= strtoupper($new['nama_season'])  ?></p>
                        <p class="card-text text-center" style="margin-top: -12px;"><?= $new['nama_barang'] ?></p>
                        <p class="card-text text-center fw-bold" style="margin-top: -10px;">Rp. <?= $new['harga_barang'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <center><a href="<?= base_url('user/products') ?>"><button class="btn btn-outline-dark mt-5 btn-shop px-4">Shop All</button></a></center>
    </div>
</section>

<section class="section-new mt-4">
    <div class="container my-3 py-4">
        <h6 class="text-center fw-bold mb-4">FEATURED PRODUCTS</h6>
        <div class="row d-flex justify-content-between">
            <?php foreach($featureds as $featured): ?>
            <div class="col-md-4 mb-2">
                <div class="card p-2">
                    <?php if($featured['model1_pic']): ?>
                    <img src="<?= $featured['model1_pic'] ?>" class="card-img-top img-fluid" alt="...">
                    <?php else : ?>
                    <img src="<?= $featured['foto_barang'] ?>" class="card-img-top img-fluid" alt="...">
                    <?php endif ?>
                    <div class="card-body">
                        <p class="card-text text-center fw-bold"><?= $featured['nama_season'] ?></p>
                        <p class="card-text text-center" style="margin-top: -12px;"><?= $featured['nama_barang'] ?></p>
                        <p class="card-text text-center fw-bold" style="margin-top: -10px;">Rp. <?= $featured['harga_barang'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <center><a href="<?= base_url('user/products') ?>"><button class="btn btn-outline-dark mt-5 btn-shop px-4">Shop All</button></a></center>
        <div style="height: 30px ;"></div>
        <div class="row mt-5">
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img src="<?= base_url('/assets/img/truck.png')?>" class="img-fluid">
                <p class="mt-4 fw-bold">Free Shipping and Returns</p>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img src="<?= base_url('/assets/img/gembok.png')?>" class="img-fluid" style="width:21px">
                <p class="mt-4 fw-bold">Secured Payments</p>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img src="<?= base_url('/assets/img/checklist.png')?>" class="img-fluid">
                <p class="mt-4 fw-bold">Customer Service</p>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 4000
        })
    })

    
</script>


