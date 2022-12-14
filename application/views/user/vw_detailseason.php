<section class="d-flex justify-content-center align-items-center" style="background-image: url('<?= base_url($season['hero_season']) ?>'); background-size:cover; height:480px; margin-top:73px;">
    <h1 class="text-white d-block">"<?= strtoupper($season['tema_season'])  ?>"</h1>
</section>
<section class="my-4 d-flex justify-content-center align-items-center">
    <img src="<?= base_url($season['logo_season']) ?>" class="img-fluid logo-season">
</section>
<section class="mb-4 section-desc p-3">
    <div class="container">
        <p class="text-center fs-5"><?= $season['desc_season'] ?></p>
    </div>
</section>
<section class="mb-4">
    <div class="container">
    <div class="row d-flex justify-content-center">
        <?php foreach($barang as $br): ?>
        <div class="col-md-3 mb-1">
         <div class="card">
            <img src="<?= base_url($br['foto_barang']) ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <center><a href="#" class="btn btn-outline-dark px-4"><?= $br['nama_barang'] ?></a></center>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>
    </div>
</section>