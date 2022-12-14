<section class="m-3">
    <h1>Daftar Season</h1>
    <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
    </button>
    <?php if($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show col-lg-6 mb-3" role="alert">
        <?php echo $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>
    <div class="row">
        <?php foreach($seasons as $season) : ?>
        <div class="col-md-4 column-card mb-4">
            <div class="card shadow-sm">
                <img src="<?= base_url($season['hero_season'])?>" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title"><?= $season['nama_season']?></h5>
                <h4 class="card-title"><?= $season['tema_season']?></h4>
                <p class="card-text" style="font-size: 12px;"><?= $season['desc_season'] ?></p>
                </div>
            </div>
            <div class="tombol-container">
                    <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $season['id'] ?>"><i class='bx bx-edit'></i></button>
                    <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataSeason(<?= $season['id']?>)"><i class='bx bx-trash'></i></button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Season</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('/admin/season/add_season')?>" method="post" enctype="multipart/form-data" id="form-season">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="nama_season" name="nama_season" placeholder="Nama Season" required>
                <label for="nama_barang">Nama Season</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="tema_season" name="tema_season" placeholder="Tema Season" required>
                <label for="tema_barang">Tema Season</label>
            </div>
            <div class="form-floating mb-2">
                <textarea class="form-control" placeholder="Deskripsi Season" name="desc_season" style="height: 100px" id="desc_season" required></textarea>
                <label for="desc_season">Deskripsi Season</label>
            </div>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label" id="logo_season">Upload Logo Season</label>
                <input class="form-control" type="file" id="formFile" name="logo_season">
                <img src="" class="img-fluid img-sm mt-2 img-preview" style='width:100px'/>
            </div>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label" id="hero_season">Upload Hero Season</label>
                <input class="form-control" type="file" id="formFile" name="hero_season">
                <img src="" class="img-fluid img-sm mt-2 hero-preview" style='width:100px'/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
          </div>
        </div>
      </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

<script>
    function setRefresh(){
        location.href = '<?= base_url('admin/season') ?>';
    }
    async function hapusDataSeason(id){
        // console.log(id)
        let conf = confirm('Apakah anda yakin ingin menghapus season ini?')
        if(conf){
            location.href = '<?= base_url('admin/season/hapus_season/') ?>'+id
            // setRefresh()
        }else{
            return false;
        }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Season')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','season/editdataseason/'+id)

    $.ajax({
      url: '<?= base_url('admin/season/editseason/') ?>'+id,
      success: function(data){
        const json = JSON.parse(data)
        console.log(json);
        $('#nama_season').val(json.nama_season)
        $('#tema_season').val(json.tema_season)
        $('#user_id').val(json.user_id)
        $('#desc_season').val(json.desc_season)
        $('.img-preview').attr('src', '<?= base_url() ?>'+json.logo_season);
        $('.hero-preview').attr('src', '<?= base_url() ?>'+json.hero_season);
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Season')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','season/add_season')

    $('#nama_season').val('')
    $('#tema_season').val('')
    $('#user_id').val('')
    $('#desc_season').val('')
    $('.img-preview').attr('src', '');
  })

  $('#form-season').validate({
            rules: {
                nama_season : {
                    required: true,
                },
                tema_season : {
                    required: true,
                },
                desc_season : {
                    required: true,
                },
            },
            messages:{
                nama_season : {
                    required: 'Nama Season Harus Diisi!',
                },
                tema_season : {
                    required: 'Tema Season Harus Diisi',
                },
                desc_season : {
                    required: 'Deskripsi Season Harus Diisi',
                },
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