<div class="row">
  <div class="col">
    <div class="card shadow mb-3">
      <div class="card-body">
        <div>
          <span class="h4"><?= strtoupper($judul); ?></span>
          <button class="btn btn-primary btn-sm float-end" type="button" onclick="tambah()">Tambah <i class="fa-solid fa-circle-plus"></i></button>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="table-standar" class="table table-striped table-hover table-bordered">
            <thead class="bg-warning text-center">
              <tr>
                <th width="5%">No</th>
                <th>Kode Kategori</th>
                <th>Kategori</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($kategori as $k) : ?>
                <tr>
                  <td class="text-end"><?= $no; ?></td>
                  <td><?= $k->kode_kategori; ?></td>
                  <td><?= $k->nama_kategori; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-warning mb-3" onclick="update_kategori('<?= $k->kode_kategori; ?>')">Update <i class="fa-solid fa-rotate"></i></button>
                    <?php $cek = $this->db->get_where("menu", ["kategori_menu" => $k->kode_kategori])->row(); ?>
                    <?php if ($cek) : ?>
                      <button type="button" class="btn btn-sm btn-danger mb-3" disabled>Hapus <i class="fa-solid fa-circle-minus"></i></button>
                    <?php else : ?>
                      <button type="button" class="btn btn-sm btn-danger mb-3" onclick="hapus('<?= $k->kode_kategori; ?>', '<?= $k->nama_kategori; ?>')">Hapus <i class="fa-solid fa-circle-minus"></i></button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php $no++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-kategori">
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-3">
              <label>Kode <span class="text-danger">*</span></label>
            </div>
            <div class="col-9">
              <input class="form-control" type="text" id="kode" name="kode" readonly placeholder="AUTO">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-3">
              <label>Kategori <span class="text-danger">*</span></label>
            </div>
            <div class="col-9">
              <input class="form-control" type="text" id="kategori" name="kategori" onkeyup="paragraf(this.value)">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary btn-sm" id="btnsimpan" onclick="simpan()">Simpan</button>
          <button type="button" class="btn btn-warning btn-sm" id="btnupdate" onclick="update()">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function tambah() {
    $("#modal_kategori").modal("show");
    $(".modal-title").text("Tambah Kategori");
    $("#kode").val('');
    $("#kategori").val('');
    $("#btnsimpan").show();
    $("#btnupdate").hide();
  }

  function update_kategori(kode) {
    $("#modal_kategori").modal("show");
    $(".modal-title").text("Update Kategori");
    $.ajax({
      url: "<?= site_url('Master/data_kategori/') ?>" + kode,
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $("#kode").val(kode);
        $("#kategori").val(data.nama_kategori);
      }
    });
    $("#btnsimpan").hide();
    $("#btnupdate").show();
  }

  function paragraf(nama) {
    str = nama.toLowerCase().replace(/\b[a-z]/g, function(letter) {
      return letter.toUpperCase();
    });
    $("#kategori").val(str);
  }

  function simpan() {
    var kategori = $("#kategori").val();
    $("#modal_kategori").modal("hide");
    if (kategori == '') {} else {
      $.ajax({
        url: "<?= site_url('Master/cek_kategori/') ?>" + kategori,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          if (data.status == 1) {
            Swal.fire({
              icon: 'error',
              title: 'KATEGORI',
              text: 'Sudah digunakan, silahkan isi yang lain!',
            }).then((value) => {
              $("#kategori").val('');
              tambah();
            });
          } else {
            $.ajax({
              url: "<?= site_url('Master/simpan_kategori/') ?>" + kategori,
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                if (data.status == 1) {
                  Swal.fire({
                    icon: 'success',
                    title: 'KATEGORI',
                    text: 'Berhasil simpan!',
                  }).then((value) => {
                    location.href = "<?= site_url('Master/kategori') ?>";
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'KATEGORI',
                    text: 'Gagal simpan!',
                  });
                }
              }
            });
          }
        }
      });
    }
  }

  function update() {
    var kode = $("#kode").val();
    var kategori = $("#kategori").val();
    $("#modal_kategori").modal("hide");
    Swal.fire({
      title: 'UPDATE',
      text: "Update kategori " + kategori + "?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Update!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "<?= site_url('Master/update_kategori/') ?>" + kode,
          data: $("#form-kategori").serialize(),
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            if (data.status == 1) {
              Swal.fire({
                icon: 'success',
                title: 'KATEGORI',
                text: 'Berhasil update!',
              }).then((value) => {
                location.href = "<?= site_url('Master/kategori') ?>";
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'KATEGORI',
                text: 'Gagal update!',
              });
            }
          }
        });
      }
    })
  }

  function hapus(kode, nama) {
    Swal.fire({
      title: 'HAPUS',
      text: "Hapus kategori " + nama + "?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "<?= site_url('Master/hapus_kategori/') ?>" + kode,
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            if (data.status == 1) {
              Swal.fire({
                icon: 'success',
                title: 'KATEGORI',
                text: 'Berhasil hapus!',
              }).then((value) => {
                location.href = "<?= site_url('Master/kategori') ?>";
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'KATEGORI',
                text: 'Gagal hapus!',
              });
            }
          }
        });
      }
    })
  }
</script>