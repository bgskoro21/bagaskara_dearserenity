<section style="margin-top:73px;">
<?php foreach($seasons as $season): ?>
<section class="d-flex justify-content-center align-items-center" style="background-image: url('<?= base_url($season['hero_season']) ?>'); background-size:cover; height:500px;">
    <a href="<?= base_url('user/season/showdetailseason/'.$season['id']) ?>" class="text-decoration-none"><h1 class="text-white"><?= strtoupper($season['nama_season'])  ?></h1></a>
</section>
<?php endforeach ?>
</section>