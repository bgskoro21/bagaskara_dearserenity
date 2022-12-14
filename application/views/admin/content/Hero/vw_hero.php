<section class="m-3">
    <h1>Data Hero</h1>
        <div>
                <?php if($this->session->userdata('level') != 'Manager'): ?>
                <button type="button" class="btn btn-primary mb-3 btn-tambah d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
                <?php endif ?>
                <a href="<?= base_url('admin/hero/preview') ?>"><button type="button" class="btn btn-success mb-3 btn-tambah d-inline-block">
                <i class='bx bx-show text-white'></i> Preview
                </button></a>
        </div>
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
                <th scope="col">Hero</th>
                <th scope="col">Status</th>
                <?php if($this->session->userdata('level') != 'Manager'): ?>
                <th scope="col">Aksi</th>
                <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach($heros as $hero) : ?>
                <tr>
                    <th scope="row" class="align-middle"><?php echo $no ?></th>
                    <td class="align-middle"><img src="<?= base_url($hero['hero_pic']) ?>" class="img-fluid foto-produk"></td>
                    <td class="align-middle">
                    <?php if($this->session->userdata('level') == 'Manager'): ?>
                      <?php if($hero['status'] == 'Belum Disetujui'): ?>
                      <button class="btn btn-primary btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $hero['id'] ?>">
                        <?php echo $hero['status'] ?>
                      </button>
                      <?php elseif($hero['status'] == 'Disetujui') : ?>
                        <button class="btn btn-success btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $hero['id'] ?>">
                        <?php echo $hero['status'] ?>
                        </button>
                      <?php else : ?>
                        <button class="btn btn-danger btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $hero['id'] ?>">
                        <?php echo $hero['status'] ?>
                        </button>
                      <?php endif ?>
                      <?php else : ?>
                      <?php echo $hero['status'] ?>
                      <?php endif ?>
                    </td>
                    <?php if($this->session->userdata('level') != 'Manager'):  ?>
                    <td class="align-middle">
                        <?php if($hero['user_id'] == $this->session->userdata('id')): ?>
                        <button class="btn btn-success btn-sm btn-edit" data-bs-target="#exampleModal" data-bs-toggle="modal" data-id="<?= $hero['id'] ?>"><i class='bx bx-edit'></i></button>
                        <button class="btn btn-danger btn-sm" id="btn_hapus" onclick="hapusDataBarang(<?= $hero['id'] ?>)"><i class='bx bx-trash'></i></button>
                        <?php endif; ?>
                    </td>
                    <?php endif ?>
                </tr>
                <?php $no++ ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Hero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('admin/hero/add_hero') ?>" method="post" enctype="multipart/form-data">
            <?php if($this->session->userdata('level') != 'Manager'): ?>
            <div class="mb-2 upload-file">
                <label for="formFile" class="form-label">Upload Hero</label>
                <input class="form-control" type="file" id="formFile" name="hero_pic">
                <img src="" class="img-fluid img-sm mt-2 img-preview" style='width:100px'/>
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
<script>
    function setRefresh(){
        location.href='<?= base_url('/admin/hero') ?>'
    }
    async function hapusDataBarang(id){
            let conf = confirm('Anda Yakin Menghapus Data Ini?')
            if(conf){
              location.href='<?= base_url('admin/hero/hapus_hero/')?>'+id
            }else{
                return false
            }
    }

    $('.btn-edit').on('click', function(){
    $('#exampleModalLabel').html('Ubah Hero')
    $('.modal-footer button[type=submit]').html('Ubah Data')
    const id = $(this).data('id')
    $('.modal-body form').attr('action','<?= base_url('admin/hero/edit_hero/') ?>'+id)

    $.ajax({
      url: '<?= base_url('admin/hero/getdatabyid/') ?>'+id,
      success: function(data){
        const json = JSON.parse(data)
        console.log(json);
        $('.img-preview').attr('src','<?= base_url() ?>'+json.hero_pic)
        $('#status').val(json.status);
      }
    })
  })

  $('.btn-tambah').on('click', function(){
    $('#exampleModalLabel').html('Tambah Hero')
    $('.modal-footer button[type=submit]').html('Tambah Data')
    $('.modal-body form').attr('action','<?= base_url('admin/hero/add_hero')?>')
        $('.img-preview').attr('src', '')
      })

      $(document).ready( function () {
        $('#table-id').DataTable();
      });
</script>