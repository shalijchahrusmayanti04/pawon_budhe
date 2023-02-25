<form method="post" id="form-login">
  <div class="row justify-content-center" style="margin-top: 150px;">
    <div class="col-6">
      <div class="card shadow">
        <div class="card-header">
          <div class="row text-center">
            <div class="col-2">
              <img src="<?= base_url('assets/img/logo.jpeg'); ?>" style="border-radius: 50%; width: 50px;">
            </div>
            <div class="col-10 m-auto">
              <div class="h2 text-warning">PAWON BUDHE</div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-3">
              <label>Username <span class="text-danger">*</span></label>
            </div>
            <div class="col-9">
              <input class="form-control" type="text" id="username" name="username" onchange="cekusername(this.value)">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-3">
              <label>Password <span class="text-danger">*</span></label>
            </div>
            <div class="col-9">
              <div class="input-group">
                <input class="form-control" type="password" id="password" name="password">
                <span class="input-group-text" id="showp" onclick="showpass()"><i class="fa-solid fa-eye-slash"></i></span>
                <span class="input-group-text" id="hidep" onclick="showpass()"><i class="fa-solid fa-eye"></i></span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-3">
              <label>Nama</label>
            </div>
            <div class="col-9">
              <input class="form-control" type="text" id="nama" name="nama">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-3">
              <label>No Hp <span class="text-danger">*</span></label>
            </div>
            <div class="col-9">
              <input class="form-control" type="text" id="nohp" name="nohp">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-3">
              <label>Alamat</label>
            </div>
            <div class="col-9">
              <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col">
              <a href="<?= site_url('Auth'); ?>" style="width: 100%;" class="btn btn-danger btn-sm" type="button"><i class="fa-solid fa-right-to-bracket"></i> LOGIN</a>
            </div>
            <div class="col">
              <button style="width: 100%;" class="btn btn-success btn-sm" type="button" onclick="daftar()"><i class="fa-solid fa-user-plus"></i> DAFTAR</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
    $("#hidep").hide();
  });

  function showpass() {
    var x = document.getElementById('password');
    if (x.type === "password") {
      $("#hidep").show();
      $("#showp").hide();
      x.type = "text";
    } else {
      $("#hidep").hide();
      $("#showp").show();
      x.type = "password";
    }
  }

  function cekusername(param) {
    if (param != '') {
      $.ajax({
        url: "<?= site_url('Auth/cekusername_r/') ?>" + param,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          if (data.status == 1) {
            $("#username").val('');
            Swal.fire({
              icon: 'error',
              title: 'USERNAME',
              text: 'Sudah digunakan, silahkan isi yang lain!',
            })
          }
        }
      });
    }
  }

  function daftar() {
    var username = $("#username").val();
    var password = $("#password").val();
    var nohp = $("#nohp").val();
    if (username == '') {
      Swal.fire({
        icon: 'error',
        title: 'USERNAME',
        text: 'Tidak boleh kosong!',
      });
      return;
    }
    if (password == '') {
      Swal.fire({
        icon: 'error',
        title: 'PASSWORD',
        text: 'Tidak boleh kosong!',
      });
      return;
    }
    if (nohp == '') {
      Swal.fire({
        icon: 'error',
        title: 'NO HP',
        text: 'Tidak boleh kosong!',
      });
      return;
    }

    if (username != '' && password != '' && nohp != '') {
      $.ajax({
        url: "<?= site_url('Auth/daftar') ?>",
        type: "POST",
        data: $("#form-login").serialize(),
        dataType: "JSON",
        success: function(data) {
          if (data.status == 1) {
            Swal.fire({
              icon: 'success',
              title: 'USER ' + username.toUpperCase(),
              text: 'Berhasil didaftrakan!',
            }).then((value) => {
              location.href = "<?= site_url('Auth') ?>";
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'USER ' + username.toUpperCase(),
              text: 'Gagal didaftarkan!',
            });
          }
        }
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'DATA',
        text: 'Tidak lengkp!',
      });
    }
  }
</script>