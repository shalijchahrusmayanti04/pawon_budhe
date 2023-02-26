<form id="form-tambah" method="post">
  <div class="row">
    <div class="col">
      <div class="card shadow mb-3">
        <div class="card-body">
          <div>
            <span class="h4"><?= strtoupper($judul); ?></span>
            <a type="button" class="btn btn-danger btn-sm float-end" href="<?= site_url('Master/menu'); ?>">Kembali <i class="fa-solid fa-circle-chevron-left"></i></a>
          </div>
          <hr>
          <div class="row mb-3">
            <div class="col">
              <div class="form-group row">
                <div class="col-3">
                  <img id="preview_img" class="profile-user-img img-fluid" src="<?= base_url('assets/img/menu/default.jfif'); ?>" alt="User profile picture">
                </div>
                <div class="col-9">
                  <div class="input-group">
                    <div class="custom-file">
                      <label for="formFile" class="form-label">Gambar</label>
                      <input class="form-control" type="file" id="filefoto" name="filefoto">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col m-auto">
              <div class="form-group row">
                <label class="control-label col-3">Kode</label>
                <div class="col-9">
                  <input type="text" name="kode_menu" id="kode_menu" placeholder="AUTO" readonly class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <div class="form-group row">
                <label class="control-label col-3">Nama <span class="text-danger">*</span></label>
                <div class="col-9">
                  <input type="text" name="nama_menu" id="nama_menu" class="form-control" onchange="ceknama(this.value)" onkeyup="paragraf(this.value)">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group row">
                <label class="control-label col-3">Harga <span class="text-danger">*</span></label>
                <div class="col-9">
                  <input type="text" name="harga_menu" id="harga_menu" class="form-control text-end" onkeyup="format_currency()" value="0">
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <div class="form-group row">
                <label class="control-label col-3">Kategori <span class="text-danger">*</span></label>
                <div class="col-9">
                  <select name="kategori_menu" id="kategori_menu" class="form-control select2_all" data-placeholder="Pilih...">
                    <option value="">Pilih...</option>
                    <?php foreach ($kategori as $k) : ?>
                      <option value="<?= $k->kode_kategori; ?>"><?= $k->nama_kategori; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col m-auto">
              <button type="button" class="btn btn-primary btn-sm float-end position-absolute" style="right: 20px; bottom: 30px;" onclick="simpan()">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  function ceknama(param) {
    $.ajax({
      url: "<?= site_url('Master/ceknama_meu/?nama=') ?>" + param,
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        if (data.status == 1) {
          $("#nama_menu").val('');
          Swal.fire({
            icon: 'error',
            title: 'NAMA',
            text: 'Sudah digunakan, silahkan isi yang lain!',
          });
        }
      }
    });
  }

  function paragraf(nama) {
    str = nama.toLowerCase().replace(/\b[a-z]/g, function(letter) {
      return letter.toUpperCase();
    });
    $("#nama_menu").val(str);
  }

  function format_currency() {
    if ($("#harga_menu").val() == '') {
      var harga_menu = 0;
    } else {
      var harga_menu = Number(parseInt(($("#harga_menu").val()).replaceAll(',', '')));
    }
    $("#harga_menu").val(formatRupiah(harga_menu));
  }

  function simpan() {
    var nama_menu = $("#nama_menu").val();
    var harga_menux = $("#harga_menu").val();
    var harga_menu = Number(parseInt(harga_menux.replaceAll(',', '')));
    var kategori_menu = $("#kategori_menu").val();
    if (nama_menu != '' && harga_menu > 0 && kategori_menu != null) {
      var form = $('#form-tambah')[0];
      var data = new FormData(form);
      $.ajax({
        url: "<?= site_url('Master/simpan_menu/') ?>",
        type: "POST",
        enctype: 'multipart/form-data',
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(data) {
          if (data.status == 1) {
            Swal.fire({
              icon: 'success',
              title: 'MENU',
              text: 'Berhasil simpan!',
            }).then((value) => {
              location.href = "<?= site_url('Master/menu') ?>";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'MENU',
              text: 'Gagal simpan!',
            });
          }
        }
      });
    } else {
      Swal.fire({
        icon: 'info',
        title: 'TAMBAH MENU',
        text: 'Data belum lengkap!',
      });
    }
  }
</script>