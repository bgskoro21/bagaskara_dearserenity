<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="<?= base_url('assets/img/Logo DearSerenity.png') ?>" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/') ?>">HOME</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">ABOUT US</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('user/season') ?>">SEASON</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('user/products') ?>">PRODUCTS</a>
        </li>
        <?php if($this->session->userdata('username')): ?>
          <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/login/login/handle_logout')?>">LOGOUT</a>
        </li>
        <?php else : ?>
          <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/login')?>">LOGIN</a>
        </li>
        <?php endif; ?> 
      </ul>
    </div>
  </div>
</nav>