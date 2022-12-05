<section class="m-3">
    <h1>Data Barang</h1>
        <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Foto Barang</th>
                <th scope="col">Season</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php $number = $no + $page_number ?>
                <?php foreach($barang as $br) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $number ?></th>
                    <td class="align-middle"><?php echo $br['nama_barang'] ?></td>
                    <td class="align-middle"><img src="<?= $br['foto_barang'] ?>" class="img-fluid foto-produk"></td>
                    <td class="align-middle"><?php echo $br['nama_season'] ?></td>
                    <td class="align-middle"><?php echo $br['harga_barang'] ?></td>
                    <td class="align-middle">
                        <a href="<?= base_url('admin/barang/showdetailbarang/'.$br['id']) ?>"><button class="btn btn-warning btn-sm" data-id="<?= $br['id'] ?>"><i class='bx bx-show text-white'></i></button></a>
                        <?php if($br['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $br['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataBarang(<?= $br['id'] ?>)"><i class='bx bx-trash'></i></button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $number++ ?>
                <?php endforeach; ?>
            </tbody>
            </table>
            <?php echo $this->pagination->create_links(); ?>
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
            <form action="<?= base_url('admin/barang/addDataBarang') ?>" method="post" enctype="multipart/form-data">
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
        $('#harga_barang').val(json[0].harga_barang)
        $('#desc_barang').val(json[0].desc_barang)
        $('.img-preview').attr('src',json[0].foto_barang)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Data Barang')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('admin/barang/adddatabarang')?>')

        $('#nama_barang').val('')
        $('#season_id').val('')
        $('#harga_barang').val('')
        $('#desc_barang').val('')
        $('.img-preview').attr('src', '')
      })
</script>