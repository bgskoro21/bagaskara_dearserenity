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
      <img src="<?= $hero['hero_pic'] ?>" class="d-block w-100">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 4000
        })
    })
</script>