<section class="m-3">
    <h1>Daftar User</h1>
    <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
    </button>
    <table class="table" id="table-id">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Foto Profile</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Alamat</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($users as $user) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <?php if($user['foto_profile']) : ?>
                    <td><img src="<?php echo $user['foto_profile'] ?>" alt="" class="img-fluid data-foto rounded-circle"></td>
                    <?php else : ?>
                    <td><img src="<?php echo base_url('/assets/img/Dearserenity/Season I/Season I Logo.png') ?>" alt="" class="img-fluid data-foto rounded-circle border"></td>
                    <?php endif; ?>
                    <td class="align-middle"><?php echo $user['nama_lengkap'] ?></td>
                    <td class="align-middle"><?= $user['alamat'] ?></td>
                    <td class="align-middle"><?php echo $user['level'] ?></td>
                    <td class="align-middle">
                        <a href="<?= base_url('/admin/user/show_detail/').$user['id'] ?>"><button class="btn btn-warning btn-sm btn-show"><i class='bx bx-show text-white'></i></button></a>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $user['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataUser(<?= $user['id'] ?>)"><i class='bx bx-trash'></i></button>
                    </td>
                </tr>
                <?php $no++ ?>
                <?php endforeach; ?>
            </tbody>
            </table>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto">
            <form action="<?= base_url('/admin/user/add_user')?>" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap" required>
                <label for="nama_lengkap">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-2">
                <textarea class="form-control" placeholder="Alamat" name="alamat" style="height: 100px" id="alamat" required></textarea>
                <label for="alamat">Alamat</label>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Level" name="level" id="level">
                  <option value="Super Admin">Super Admin</option>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
              </select>
              <label for="floatingInput">Level</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
          </div>
        </div>
</div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script>
    function setRefresh(){
        location.href = '<?= base_url('admin/user') ?>';
    }
    async function hapusDataUser(id){
        // console.log(id)
        let conf = confirm('Apakah anda yakin ingin menghapus user ini?')
        if(conf){
            await fetch('<?= base_url('/admin/user/hapus_user/') ?>'+id)
            setRefresh()
        }else{
            return false;
        }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah User')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','user/edit_user/'+id)

    $.ajax({
      url: '<?= base_url('admin/user/getdatabyid/') ?>'+id,
      success: function(data){
        const json = JSON.parse(data)
        console.log(json);
        $('#nama_lengkap').val(json.nama_lengkap);
        $('#email').val(json.email);
        $('#username').val(json.username);
        $('#password').val(json.password);
        $('#alamat').val(json.alamat);
        $('#level').val(json.level);
      }
    })
  })

  $(document).ready( function () {
        $('#table-id').DataTable();
      });
  
    $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah User')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('/admin/user/add_user')?>')

    $('#nama_lengkap').val('');
    $('#email').val('');
    $('#username').val('');
    $('#password').val('');
    $('#alamat').val('');
    $('#level').val('');
  })
</script>