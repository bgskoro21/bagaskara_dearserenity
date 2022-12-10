<section class="m-3">
    <h1>Detail Harga</h1>
        <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <table class="table" style="width: 60%;">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Product Unggulan</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($featureds as $featured) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><?php echo $featured['nama_barang'] ?></td>
                    <td class="align-middle">
                        <?php if($featured['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $featured['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataUkuran(<?= $featured['id'] ?>)"><i class='bx bx-trash'></i></button>
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
            <form action="<?= base_url('/admin/unggulan/add_unggulan')?>" method="post">
                <div class="form-floating mb-2">
                <select class="form-select" aria-label="Input Produk Unggulan" name="barang_id" id="barang_id">
                    <?php foreach($products as $product) : ?>
                    <option value="<?= $product['id'] ?>"><?= $product['nama_barang'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="floatingInput">Pilih Produk Unggulan</label>
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
        location.href = '<?= base_url('admin/unggulan') ?>';
    }
    async function hapusDataUkuran(id){
        // console.log(id)
        let conf = confirm('Apakah anda yakin ingin menghapus season ini?')
        if(conf){
            await fetch('<?= base_url('admin/unggulan/hapus_unggulan/') ?>'+id);
            setRefresh()
        }else{
            return false;
        }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Produk Unggulan')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','<?= base_url('/admin/unggulan/edit_unggulan/') ?>'+id)

    $.ajax({
      url: '<?= base_url('admin/unggulan/getUnggulanById/') ?>'+id,
      success: function(data){
        // console.log(data)
        const json = JSON.parse(data)
        console.log(json);
        $('#barang_id').val(json.barang_id)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Produk Unggulan')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('admin/unggulan/add_unggulan ') ?>')

    $('#barang_id').val('')
  })
</script>