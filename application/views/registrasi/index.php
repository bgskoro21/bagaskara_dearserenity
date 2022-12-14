<section class="registrasi-background">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-6 bg-white p-4">
                <h2 class="text-center fw-bold mb-3">REGISTRASI</h1>
                <form action="<?= base_url('registrasi/registrasi/add_user') ?>" method="post" id="form-user">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap" required>
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <div class="invalid-feedback nameError">
                        
                    </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <label for="email">Email</label>
                        <div class="invalid-feedback emailError">

                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                        <div class="invalid-feedback usernameError">
                            
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback passwordError">
                            
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Alamat" name="alamat" style="height: 100px" id="alamat" required></textarea>
                        <label for="alamat">Alamat</label>
                        <div class="invalid-feedback alamatError">
                            
                        </div>
                    </div>
                    <center><button class="btn btn-outline-dark mt-3 px-5" type="submit">REGISTRASI</button></center>
                </form>
                <p class="mt-3 text-center" style="font-size: 11px;"><strong>Do You Have an Account?</strong> <a href="<?= base_url('/login') ?>">Login</a></p>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
<script>
    $('#form-user').validate({
            rules: {
                nama_lengkap : {
                    required: true,
                },
                alamat : {
                    required: true,
                },
                username: {
                    required:true,
                    minlength:8
                },
                email:{
                    email:true,
                    required:true
                },
                password:{
                    required:true,
                    minlength:8
                }
            },
            messages:{
                nama_lengkap:{
                    required: 'Nama Lengkap Harus Diisi!',
                },
                alamat:{
                    required: 'Alamat Harus Diisi!',
                },
                username:{
                    required: 'Username harus diisi!',
                    minlength: 'Username minimal 8 karakter'
                },
                password:{
                    required: 'Password harus diisi!',
                    minlength: 'Password minimal 8 karakter'
                },
                email:{
                    required:'Email Harus Diisi!',
                    email:'Isi email dengan email yang valid'
                }
            },
            errorElement: "div",
                errorPlacement: function ( error, element ) {
                    error.addClass( "invalid-feedback" );
                    error.insertAfter( element );
                },
            highlight: function(element) {
                $(element).removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        })
</script>