<section class="m-3">
    <h1>Detail Harga</h1>
        <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <table class="table" style="width: 60%;">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Catalog</th>
                <th scope="col">Model 1</th>
                <th scope="col">Model 2</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($galleries as $gallery) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><?= $gallery['judul'] ?></td>
                    <td class="align-middle"><img src="<?= $gallery['catalog_pic'] ?>" class="img-fluid foto-produk"></td>
                    <?php if($gallery['model1_pic'] != null): ?>
                    <td class="align-middle"><img src="<?= $gallery['model1_pic'] ?>" class="img-fluid foto-produk"></td>
                    <?php else :  ?>
                    <td class="align-middle">-</td>
                    <?php endif ?>    
                    <?php if($gallery['model2_pic']): ?>
                    <td class="align-middle"><img src="<?= $gallery['model2_pic'] ?>" class="img-fluid foto-produk"></td>
                    <?php else :  ?>
                    <td class="align-middle">-</td>
                    <?php endif ?>    
                    <td class="align-middle">
                        <?php if($gallery['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $gallery['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataUkuran(<?= $gallery['id'] ?>)"><i class='bx bx-trash'></i></button>
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
            <form action="<?= base_url('/admin/gallery/add_gallery')?>" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="judul" name="judul" placeholder="judul" required>
                <label for="judul">Judul Galeri</label>
            </div>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label" id="catalog_pic">Foto Catalog</label>
                <input class="form-control" type="file" id="formFile" name="catalog_pic">
                <img src="" class="img-fluid img-sm catalog-preview" style='width:100px'/>
            </div>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label" id="model1_pic">Foto Model 1</label>
                <input class="form-control" type="file" id="formFile" name="model1_pic">
                <img src="" class="img-fluid img-sm model1-preview" style='width:100px'/>
            </div>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label" id="model2_pic">Foto Model 2</label>
                <input class="form-control" type="file" id="formFile" name="model2_pic">
                <img src="" class="img-fluid img-sm model2-preview" style='width:100px'/>
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
        location.href = '<?= base_url('admin/gallery') ?>';
    }
    async function hapusDataUkuran(id){
        // console.log(id)
        let conf = confirm('Apakah anda yakin ingin menghapus gallery ini?')
        if(conf){
            await fetch('<?= base_url('admin/gallery/hapus_gallery/') ?>'+id);
            setRefresh()
        }else{
            return false;
        }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Harga')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','<?= base_url('/admin/gallery/edit_gallery/') ?>'+id)

    $.ajax({
      url: '<?= base_url('admin/gallery/getgallerybyid/') ?>'+id,
      success: function(data){
        // console.log(data)
        const json = JSON.parse(data)
        console.log(json);
        $('#judul').val(json.judul)
        $('.catalog-preview').attr('src', json.catalog_pic)
        $('.model1-preview').attr('src', json.model1_pic)
        $('.model2-preview').attr('src', json.model2_pic)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Gallery')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('admin/gallery/add_gallery ') ?>')

    $('#judul').val('')
    $('.catalog-preview').attr('src', '')
    $('.model1-preview').attr('src', '')
    $('.model2-preview').attr('src', '')
  })
</script>