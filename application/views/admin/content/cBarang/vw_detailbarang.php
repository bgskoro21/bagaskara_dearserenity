<section class="m-3">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card">
                <img src="<?= $barang['foto_barang']?>" class="card-img-top img-fluid img-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= strtoupper($barang['nama_season'])?></h5>
                    <h4><?= strtoupper($barang['nama_barang'])?></h4>
                    <p class="text-muted" style="font-size: 11px;">Input By. <?= $barang['nama_lengkap']?></p>
                    <p class="card-text"><?= $barang['desc_barang']?></p>
                    <h5>Rp. <?= $barang['harga_barang']?></h5>
                    <a href="<?= base_url('admin/barang')?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>