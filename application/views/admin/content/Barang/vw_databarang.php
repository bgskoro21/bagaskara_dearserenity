<section class="m-3">
    <h1>Data Barang Master</h1>
        <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                <th scope="col">Nama Barang</th>
                <th scope="col">Ukuran</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($barang as $br) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><?php echo $br['nama_barang'] ?></td>
                    <td class="align-middle"><?php echo $br['ukuran'] ?></td>
                    <td class="align-middle"><?php echo $br['stok'] ?></td>
                    <td class="align-middle">
                        <?php if($br['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $br['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataBarang(<?= $br['id'] ?>)"><i class='bx bx-trash'></i></button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $no++ ?>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
</section>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('/admin/databarang/addDataBarang')?>" method="post" id="form-master" enctype="multipart/form-data">
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Input Barang" name="barang_id" id="barang_id">
                  <?php foreach($dafbarang as $barang) : ?>
                  <option value="<?= $barang['id'] ?>"><?= $barang['nama_barang'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="floatingInput">Pilih Barang</label>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Input Ukuran" name="ukuran_id" id="ukuran_id">
                  <?php foreach($sizes as $size) : ?>
                  <option value="<?= $size['id'] ?>"><?= $size['ukuran'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="floatingInput">Pilih Ukuran</label>
            </div>
            <div class="form-floating mb-2">
                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Barang" required>
                <label for="stok">Stok Barang</label>
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
        location.href='<?= base_url('/admin/databarang') ?>'
    }
    async function hapusDataBarang(id){
            let conf = confirm('Anda Yakin Menghapus Data Ini?')
            if(conf){
                await fetch('<?= base_url('admin/databarang/hapusDataBarang/')?>'+id)
                setRefresh();
            }else{
                return false
            }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Data Pemasukkan')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','databarang/editdatabarang/'+id)

    $.ajax({
      url: '<?= base_url('admin/databarang/edit/') ?>'+id,
      success: function(data){
        const json = JSON.parse(data)
        console.log(json[0]);
        $('#barang_id').val(json[0].barang_id)
        $('#user_id').val(json[0].user_id)
        $('#stok').val(json[0].stok)
        $('#ukuran_id').val(json[0].ukuran_id)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Data Barang')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('/admin/databarang/addDataBarang')?>')

        $('#barang_id').val('')
        $('#stok').val('')
        $('#ukuran_id').val('')
        $('.img-preview').attr('src', '')
      })

      $(document).ready( function () {
        $('#table-id').DataTable();
      });

      $('#form-master').validate({
            rules: {
                barang_id : {
                    required: true,
                },
                ukuran_id : {
                    required: true,
                },
                stok: {
                    required:true,
                },
            },
            messages:{
                barang_id:{
                    required: 'Barang harus dipilih!',
                },
                ukuran_id:{
                    required: 'Ukuran harus dipilih!',
                },
                stok:{
                    required: 'Stok harus diisi!',
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