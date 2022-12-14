<div class="sidebar close">
      <div class="logo-details">
        <img src="<?= base_url('assets/img/Season II Logo.png') ?>" alt="Eyzel" />
        <span class="logo_name">DearSerenity</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="<?= base_url('admin')?>">
            <i class="bx bx-grid-alt"></i>
            <span class="link_name">Dashboard</span>
          </a>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin')?>">Dashboard</a></li>
          </ul>
        </li>
        <?php if($this->session->userdata('level') == 'Super Admin') : ?>
        <li>
          <a href="<?= base_url('admin/user')?>">
            <i class='bx bxs-user'></i>
            <span class="link_name">Data User</span>
          </a>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin/user')?>">Data User</a></li>
          </ul>
        </li>
        <?php endif ?>
        <?php if($this->session->userdata('level') != 'Manager') : ?>
        <li>
          <div class="iocn-link">
            <a href="<?= base_url('admin/databarang')?>">
              <i class='bx bx-briefcase'></i>
              <span class="link_name">Master Barang</span>
            </a>
            <i class="bx bxs-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin/databarang')?>">Master Barang</a></li>
            <li><a href="<?= base_url('admin/barang')?>">Data Barang</a></li>
            <li><a href="<?= base_url('admin/unggulan')?>">Produk Unggulan</a></li>
            <li><a href="<?= base_url('admin/gallery')?>">Galeri Produk</a></li>
          </ul>
        </li>
        <?php else: ?>
        <li>
          <a href="<?= base_url('admin/barang')?>">
            <i class='bx bx-briefcase'></i>
            <span class="link_name">Data Barang</span>
          </a>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin/barang')?>">Data Barang</a></li>
          </ul>
        </li>
        <?php endif; ?>
        <?php if($this->session->userdata('level') != 'Manager') : ?>
        <li>
          <div class="iocn-link">
            <a href="<?= base_url('admin/season')?>">
              <i class='bx bxs-t-shirt'></i>
              <span class="link_name">Season</span>
            </a>
            <i class="bx bxs-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin/season')?>">Season</a></li>
          </ul>
        </li>
        <li>
          <div class="iocn-link">
            <a href="<?= base_url('admin/category')?>">
              <i class='bx bx-category'></i>
              <span class="link_name">Detail Barang</span>
            </a>
            <i class="bx bxs-chevron-down arrow"></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin/category')?>">Detail Barang</a></li>
            <li><a href="<?= base_url('admin/category')?>">Kategori</a></li>
            <li><a href="<?= base_url('admin/detailukuran')?>">Detail Ukuran</a></li>
            <li><a href="<?= base_url('admin/harga')?>">Rentang Harga</a></li>
          </ul>
        </li>
        <?php endif; ?>
        <li>
          <a href="<?= base_url('admin/hero')?>">
          <i class='bx bx-home-smile'></i>
            <span class="link_name">Hero Homepage</span>
          </a>
          <ul class="sub-menu">
            <li><a class="link_name" href="<?= base_url('admin/hero')?>">Hero Homepage</a></li>
          </ul>
        </li>
        <li>
          <div class="profile-details">
            <div class="profile-content">
              <!-- <img src="logoeyzel.png" alt="profileImg" /> -->
            </div>
            <div class="name-job">
              <div class="profile_name"><?php echo $this->session->userdata('username'); ?></div>
              <div class="job"><?php echo $this->session->userdata('level'); ?></div>
            </div>
            <a href="<?= base_url('login/login/handle_logout') ?>">
              <i class="bx bx-log-out"></i>
            </a>
          </div>
        </li>
      </ul>
    </div>