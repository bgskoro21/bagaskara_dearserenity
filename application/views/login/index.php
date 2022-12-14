<section class="login-background">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height:100vh">
            <div class="col-lg-4 col-md-8 bg-white p-4 d-flex flex-column justify-content-center align-items-center">
                <h2 class="fw-bold mb-5">LOGIN</h2>
                <?php if($this->session->flashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show col-lg-6 mb-3" role="alert">
                <?php echo $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif ?>
                <form action="<?= base_url('/login/handle_login') ?>" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control input-form" id="floatingInput" placeholder="name@example.com" autofocus>
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control input-form" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <center><button class="btn btn-outline-dark mt-5 px-5">LOGIN</button></center>
                </form>
                <p class="mt-3" style="font-size: 11px;"><strong>Don't Have an Account?</strong> <a href="<?= base_url('/registrasi') ?>">Sign Up</a></p>
            </div>
        </div>
    </div>
</section>