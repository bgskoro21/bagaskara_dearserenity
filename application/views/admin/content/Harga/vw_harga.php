<section class="m-3">
    <h1>Detail Harga</h1>
        <button type="button" class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <table class="table" id="table-id">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Harga Minimal</th>
                <th scope="col">Harga Maksimal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($prices as $price) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><?php echo $price['harga_min'] ?></td>
                    <td class="align-middle"><?php echo $price['harga_max'] ?></td>
                    <td class="align-middle"><?php echo $price['keterangan'] ?></td>
                    <td class="align-middle">
                        <?php if($price['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $price['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataUkuran(<?= $price['id'] ?>)"><i class='bx bx-trash'></i></button>
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
            <form action="<?= base_url('/admin/harga/addHarga')?>" method="post">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="harga_min" name="harga_min" placeholder="harga_min" required>
                    <label for="harga_min">Harga Minimal</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="harga_max" name="harga_max" placeholder="harga_max" required>
                    <label for="harga_max">Harga Maksimal</label>
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
<script>
    function setRefresh(){
        location.href = '<?= base_url('admin/harga') ?>';
    }
    async function hapusDataUkuran(id){
        // console.log(id)
        let conf = confirm('Apakah anda yakin ingin menghapus season ini?')
        if(conf){
            await fetch('<?= base_url('admin/harga/hapus_harga/') ?>'+id);
            setRefresh()
        }else{
            return false;
        }
    }

    $('#harga_min').on('keyup',function(){
        let min = $('#harga_min').val()
        let max = $('#harga_max').val()

        $('#keterangan').val('Rp. '+min+' s/d '+'Rp. '+max);
    })

    $('#harga_max').on('keyup',function(){
        let min = $('#harga_min').val()
        let max = $('#harga_max').val()

        $('#keterangan').val('Rp. '+min+' s/d '+'Rp. '+max);
    })

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Harga')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','<?= base_url('/admin/harga/edit_harga/') ?>'+id)

    $.ajax({
      url: '<?= base_url('admin/harga/getHargaById/') ?>'+id,
      success: function(data){
        // console.log(data)
        const json = JSON.parse(data)
        console.log(json);
        $('#harga_min').val(json.harga_min)
        $('#harga_max').val(json.harga_max)
        $('#keterangan').val(json.keterangan)
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Harga')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('admin/harga/addHarga ') ?>')

    $('#harga_min').val('')
    $('#harga_max').val('')
    $('#keterangan').val('')
  })

  $(document).ready( function () {
        $('#table-id').DataTable();
      });
</script>