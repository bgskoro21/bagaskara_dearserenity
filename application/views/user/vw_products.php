<section style="margin-top:73px;">
    <div class="container">
        <h1 class="mt-2">All Products</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" name="keyword" id="keyword">
                    <button type="submit" class="input-group-text" id="basic-addon2">Search</button>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-3">
            <select class="form-select bg-dark text-white" aria-label="Default select example" id="category-select">
                <option value="0" selected>--Filter By Category--</option>
                <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['nama_category'] ?></option>
                <?php endforeach ?>
            </select>
            </div>
            <div class="col-md-3">
            <select class="form-select bg-dark text-white" aria-label="Default select example" id="season-select">
                <option value="0" selected>--Filter By Season--</option>
                <?php foreach($seasons as $season): ?>
                <option value="<?= $season['id'] ?>"><?= $season['nama_season'] ?></option>
                <?php endforeach ?>
            </select>
            </div>
            <div class="col-md-3">
            <select class="form-select bg-dark text-white" aria-label="Default select example" id="harga-select">
                <option value="0" selected>--Filter By Prices--</option>
                <?php foreach($prices as $price): ?>
                <option value="<?= $price['id'] ?>"><?= $price['keterangan'] ?></option>
                <?php endforeach ?>
            </select>
            </div>
        </div>
        <div class="row d-flex card-container">
            <?php foreach($products as $product) : ?>
            <div class="col-md-3 mb-2">
            <div class="card">
                <img src="<?= base_url($product['foto_barang']) ?>" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-bold"><?= $product['nama_barang']  ?></h6>
                    <p class="card-text">Rp. <?= $product['harga_barang']  ?></p>
                    <a href="<?= base_url('user/products/detail?size=M&id='.$product['id']) ?>" class="btn btn-dark">Lihat Detail</a>
                </div>
            </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script>
  function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>user/products/search",
   method:"POST",
   data:{keyword:query},
   success:function(data){
    $('.card-container').html(data);
    console.log(data)
   }
  })
 }
  $('#keyword').on('keyup',function(){
    var search = $(this).val();
    load_data(search)
  })

  function filterByCategory(category)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>user/products/searchByCategory",
   method:"POST",
   data:{category:category},
   success:function(data){
    $('.card-container').html(data);
    console.log(data)
   }
  })
 }
  function filterBySeason(season)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>user/products/searchBySeason",
   method:"POST",
   data:{season:season},
   success:function(data){
    $('.card-container').html(data);
    console.log(data)
   }
  })
 }

 function filterByHarga(harga){
    $.ajax({
   url:"<?php echo base_url(); ?>user/products/searchByHarga",
   method:"POST",
   data:{harga:harga},
   success:function(data){
    $('.card-container').html(data);
    console.log(data)
   }
  })
 }

  $('#category-select').on('change',function(){
    var category = $(this).val()
    console.log(category)
    filterByCategory(category)
    $('#season-select').val(0)
    $('#harga-select').val(0)
    // load_data(category)
  })

  $('#season-select').on('change',function(){
    var season = $(this).val()
    filterBySeason(season)
    $('#category-select').val(0)
    $('#harga-select').val(0)
    // load_data(category)
  })

  $('#harga-select').on('change',function(){
    var harga = $(this).val()
    // console.log(harga)
    filterByHarga(harga)
    $('#category-select').val(0)
    $('#season-select').val(0)
    // load_data(category)
  })
</script>