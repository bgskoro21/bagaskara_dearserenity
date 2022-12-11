<section class="m-3">
    <h1>Daftar Ukuran</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <?php if($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show col-lg-6 mb-3" role="alert">
        <?php echo $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
        <table class="table" id="table-id">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Ukuran</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($sizes as $size) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><?php echo $size['ukuran'] ?></td>
                    <td class="align-middle"><?php echo $size['keterangan'] ?></td>
                    <td class="align-middle">
                        <?php if($size['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $size['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataUkuran(<?= $size['id'] ?>)"><i class='bx bx-trash'></i></button>
                        <?php endif; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Ukuran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('/admin/detailukuran/addDetailUkuran')?>" method="post" id="form-ukuran">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="ukuran" required>
                    <label for="ukuran">Ukuran</label>
                </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan" required>
                <label for="keterangan">Keterangan</label>
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
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

<script>
    function setRefresh(){
        location.href = '<?= base_url('admin/detailukuran') ?>';
    }
    async function hapusDataUkuran(id){
        // console.log(id)
        let conf = confirm('Apakah anda yakin ingin menghapus season ini?')
        if(conf){
            await fetch('<?= base_url('admin/detailukuran/hapus_ukuran/') ?>'+id);
            setRefresh()
        }else{
            return false;
        }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Season')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','detailukuran/edit_ukuran/'+id)

    $.ajax({
      url: '<?= base_url('admin/detailukuran/getUkuranById/') ?>'+id,
      success: function(data){
        // console.log(data)
        const json = JSON.parse(data)
        console.log(json);
        $('#ukuran').val(json.ukuran)
        $('#keterangan').val(json.keterangan)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Detail Ukuran')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','detailukuran/addDataUkuran')

    $('#ukuran').val('')
    $('#keterangan').val('')

  })

  $(document).ready( function () {
        $('#table-id').DataTable();
      });

      $('#form-ukuran').validate({
            rules: {
                ukuran : {
                    required: true,
                },
                keterangan:{
                    required: true
                }
            },
            messages:{
                ukuran : {
                    required: 'Ukuran Harus Diisi!',
                },
                keterangan:{
                    required: 'Keterangan Ukuran Harus Diisi!'
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