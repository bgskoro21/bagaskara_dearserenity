<section class="m-3">
    <h1>Data Barang</h1>
        <?php if($this->session->userdata('level') != 'Manager') : ?>
        <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <?php endif ?>
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
                <th scope="col">Foto Barang</th>
                <th scope="col">Season</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($barang as $br) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><?php echo $br['nama_barang'] ?></td>
                    <td class="align-middle"><img src="<?= base_url($br['foto_barang']) ?>" class="img-fluid foto-produk"></td>
                    <td class="align-middle"><?php echo $br['nama_season'] ?></td>
                    <td class="align-middle"><?php echo $br['nama_category'] ?></td>
                    <td class="align-middle"><?php echo $br['harga_barang'] ?></td>
                    <td class="align-middle">
                      <?php if($this->session->userdata('level') == 'Manager'): ?>
                      <?php if($br['status'] == 'Belum Disetujui'): ?>
                      <button class="btn btn-primary btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $br['id'] ?>">
                        <?php echo $br['status'] ?>
                      </button>
                      <?php elseif($br['status'] == 'Disetujui') : ?>
                        <button class="btn btn-success btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $br['id'] ?>">
                        <?php echo $br['status'] ?>
                        </button>
                      <?php else : ?>
                        <button class="btn btn-danger btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $br['id'] ?>">
                        <?php echo $br['status'] ?>
                        </button>
                      <?php endif ?>
                      <?php else : ?>
                      <?php echo $br['status'] ?>
                      <?php endif ?>
                    </td>
                    <td class="align-middle">
                        <a href="<?= base_url('admin/barang/showdetailbarang/'.$br['id']) ?>"><button class="btn btn-warning btn-sm" data-id="<?= $br['id'] ?>"><i class='bx bx-show text-white'></i></button></a>
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
            <form action="<?= base_url('admin/barang/addDataBarang') ?>" method="post" id="form-barang" enctype="multipart/form-data">
            <?php if($this->session->userdata('level') != 'Manager') : ?>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required>
                <label for="nama_barang">Nama Barang</label>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Input Season" name="season_id" id="season_id">
                  <?php foreach($seasons as $season) : ?>
                  <option value="<?= $season['id'] ?>"><?= $season['nama_season'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="floatingInput">Pilih Season</label>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Input Kategory" name="category_id" id="category_id">
                  <?php foreach($categories as $category) : ?>
                  <option value="<?= $category['id'] ?>"><?= $category['nama_category'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="floatingInput">Pilih Kategori</label>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Input Rentang Harga" name="harga_id" id="harga_id">
                  <?php foreach($prices as $price) : ?>
                  <option value="<?= $price['id'] ?>"><?= $price['keterangan'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="floatingInput">Pilih Rentang Harga</label>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Input Galeri" name="gallery_id" id="gallery_id">
                  <?php foreach($galleries as $gallery) : ?>
                  <option value="<?= $gallery['id'] ?>"><?= $gallery['judul'] ?></option>
                  <?php endforeach; ?>
              </select>
              <label for="floatingInput">Pilih Album</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="harga_barang" name="harga_barang" placeholder="Harga" required>
                <label for="harga_barang">Harga Barang</label>
            </div>
            <div class="form-floating mb-2">
                <textarea class="form-control" placeholder="Deskripsi Barang" name="desc_barang" style="height: 100px" id="desc_barang" required></textarea>
                <label for="desc_barang">Deskripsi Barang</label>
            </div>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label" id="photo_barang">Upload Foto Barang</label>
                <input class="form-control" type="file" id="formFile" name="photo_barang">
                <img src="" class="img-fluid img-sm mt-2 img-preview" style='width:100px'/>
            </div>
            <div class="form-floating mb-2">
              <select class="form-select" aria-label="Status" name="status" id="status" hidden>
                  <option value="Belum Disetujui">Belum Disetujui</option>
                  <option value="Disetujui">Disetujui</option>
                  <option value="Ditolak">Ditolak</option>
              </select>
            </div>
            <?php else : ?>
              <div class="form-floating mb-2">
              <select class="form-select" aria-label="Status" name="status" id="status">
                  <option value="Belum Disetujui">Belum Disetujui</option>
                  <option value="Disetujui">Disetujui</option>
                  <option value="Ditolak">Ditolak</option>
              </select>
              <label for="floatingInput">Status</label>
            </div>
            <?php endif ?>
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
        location.href='<?= base_url('/admin/barang') ?>'
    }
    async function hapusDataBarang(id){
            let conf = confirm('Anda Yakin Menghapus Data Ini?')
            if(conf){
                await fetch('<?= base_url('admin/barang/hapusDataBarang/')?>'+id)
                setRefresh();
            }else{
                return false
            }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Data Barang')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','barang/editdatabarang/'+id)

    $.ajax({
      url: '<?= base_url('admin/barang/edit/') ?>'+id,
      success: function(data){
        const json = JSON.parse(data)
        console.log(json[0]);
        $('#nama_barang').val(json[0].nama_barang)
        $('#season_id').val(json[0].season_id)
        $('#category_id').val(json[0].category_id)
        $('#gallery_id').val(json[0].gallery_id)
        $('#harga_barang').val(json[0].harga_barang)
        $('#harga_id').val(json[0].harga_id)
        $('#desc_barang').val(json[0].desc_barang)
        $('#status').val(json[0].status)
        $('.img-preview').attr('src','<?= base_url() ?>'+json[0].foto_barang)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Data Barang')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('admin/barang/adddatabarang')?>')

        $('#nama_barang').val('')
        $('#season_id').val('')
        $('#gallery_id').val('')
        $('#category_id').val('')
        $('#harga_barang').val('')
        $('#harga_id').val('')
        $('#desc_barang').val('')
        $('.img-preview').attr('src', '')
      })
    
      $(document).ready( function () {
        $('#table-id').DataTable();
      });

      $('#form-barang').validate({
            rules: {
                nama_barang : {
                    required: true,
                },
                season_id : {
                    required: true,
                },
                category_id: {
                    required:true,
                },
                harga_id: {
                    required:true,
                },
                gallery_id:{
                  required:true
                },
                harga_barang:{
                  required:true,
                  number:true
                },
                desc_barang:{
                  required:true
                }
            },
            messages:{
              nama_barang : {
                    required: 'Nama Barang Harus Diisi!',
                },
                season_id : {
                    required: 'Season Harus Dipilih!',
                },
                category_id: {
                    required:'Kategori Harus Dipilih!',
                },
                harga_id: {
                    required:'Rentang Harga Harus Dipilih!',
                },
                gallery_id:{
                  required:'Album Harus Dipilih!'
                },
                harga_barang:{
                  required:'Harga Barang Harus Diisi!',
                  number:'Harga Harus Diisi Dengan Angka!'
                },
                desc_barang:{
                  required:'Deskripsi Barang Harus Diisi!'
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