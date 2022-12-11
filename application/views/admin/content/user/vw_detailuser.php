<section class="m-3">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-md-2">
            <?php if($user['foto_profile']): ?>
            <img src="<?= $user['foto_profile'] ?>" alt="">
            <?php else : ?>
            <img src="<?= base_url('assets/img/Dearserenity/Season II/Season II Logo.png') ?>" class="img-fluid">
            <?php endif; ?>
        </div>
        <div class="col-md-2">
            <p>Nama Lengkap</p>
            <p>Username</p>
            <p>Email</p>
            <p>Alamat</p>
            <p>Level</p>
            <p>Terdaftar</p>
        </div>
        <div class="col-md-1 d-flex flex-column justify-content-center align-items-center">
            <p>:</p>
            <p>:</p>
            <p>:</p>
            <p>:</p>
            <p>:</p>
            <p>:</p>
        </div>
        <div class="col-md-2">
            <p><?= $user['nama_lengkap'] ?></p>
            <p><?= $user['username'] ?></p>
            <p><?= $user['email'] ?></p>
            <p><?= $user['alamat'] ?></p>
            <p><?= $user['level'] ?></p>
            <p><?= $user['created_at'] ?></p>
        </div>
    </div>
</section>