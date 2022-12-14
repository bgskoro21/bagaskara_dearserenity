<section style="margin-top: 72px;" class="shadow-sm mb-2">
    <div class="container py-4">
        <div class="row d-flex">
            <div class="col-md-7">
                <img src="<?= base_url($detail['foto_barang']) ?>" class="img-fluid">
            </div>
            <div class="col-md-5">
                <h3 class="fw-bold"><?= $detail['nama_barang']  ?></h3>
                <h4 class="fw-bold" style="color:salmon">Rp. <?= $detail['harga_barang']  ?></h4>
                <p class="ket_ukuran">Size : <?= $detail['ukuran'] ?></p>
                <div class="ukuran">
                    <?php foreach($ukuran as $uk): ?>
                        <div class="frame-ukuran link_ukuran d-inline-block" data-ukuran="<?= $uk['ukuran'] ?>" data-bid='<?= $detail['barang_id'] ?>'>
                            <p class="pb-0 text-center text-ukuran"><?= $uk['ukuran'] ?></p>
                        </div>
                    <?php endforeach; ?>    
                </div>
                <p class="mt-2">Stok : <?= $detail['stok']  ?></p>
                <div class="row d-flex mt-5">
                    <div class="col-md-2 p-0">
                        <input type="number" id="jumlah" min='1' name="jumlah" value="1">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-dark" id="btn-chart">ADD TO CHART</button>
                    </div>
                    <div class="col-md-2 border d-flex align-items-center justify-content-center">
                        <i class='bx bx-heart fs-3'></i>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                        <i class='bx bx-share-alt fs-3' ></i>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col p-0">
                        <button class="btn btn-outline-dark w-100 py-3 fw-bold">BUY IT NOW</button>
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col-md-5 d-flex align-items-center">
                        <i class='bx bxs-package fs-3 me-2'></i> <span class="fw-bold" style="font-size: 14px;">FREE DELIVERY</span>
                    </div>
                    <div class="col-md-5 d-flex align-items-center">
                        <i class='bx bx-medal fs-2 me-2'></i><span class="fw-bold" style="font-size:14px;">100% ORIGINAL</span>
                    </div>
                </div>
                <div class="row mt-5 d-flex flex-column justify-content-center align-items-center">
                    <div class="col d-flex align-items-center">
                        <i class='bx bxs-truck fs-4 me-2' ></i><span style='font-size:12px;'> Gratis Ongkir</span>
                    </div>
                    <div class="col d-flex align-items-center mt-2">
                         <i class='bx bx-shield-quarter fs-4 me-2'></i><span style='font-size:12px;'> Proteksi Keamanan Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script>
    $('#jumlah').on('change',function(){
        var jumlah = $(this).val()
        console.log(jumlah)
    })

    $('.link_ukuran').on('click',function(){
        var ukuran = $(this).data('ukuran');
        var barang_id = $(this).data('bid');
        $('.ket_ukuran').html(`Size : ${ukuran}`)
        location.href = `http://localhost:8080/DearSerenity/user/products/detail?size=${ukuran}&id=${barang_id}`
    })
</script>
