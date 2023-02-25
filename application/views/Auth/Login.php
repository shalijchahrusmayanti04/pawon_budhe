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
            <div class="col">
              <input class="form-control" type="text" placeholder="Username..." id="username" name="username" onchange="cekusername(this.value)">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="input-group mb-3">
                <input class="form-control" type="password" placeholder="Password..." id="password" name="password">
                <span class="input-group-text" id="showp" onclick="showpass()"><i class="fa-solid fa-eye-slash"></i></span>
                <span class="input-group-text" id="hidep" onclick="showpass()"><i class="fa-solid fa-eye"></i></span>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col">
              <a href="<?= site_url('Auth/regist'); ?>" style="width: 100%;" class="btn btn-danger btn-sm" type="button"><i class="fa-solid fa-user-plus"></i> DAFTAR</a>
            </div>
            <div class="col">
              <button style="width: 100%;" class="btn btn-success btn-sm" type="button" onclick="login()"><i class="fa-solid fa-right-to-bracket"></i> LOGIN</button>
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
        url: "<?= site_url('Auth/cekusername_l/') ?>" + param,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          if (data.status == 1) {
            $("#username").val('');
            Swal.fire({
              icon: 'error',
              title: 'USERNAME',
              text: 'Tidak ditemukan, silahkan daftarkan terlebih dahulu!',
            })
          }
        }
      });
    }
  }

  function login() {
    var username = $("#username").val();
    var password = $("#password").val();
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

    if (username != '' && password != '') {
      $.ajax({
        url: "<?= site_url('Auth/cekpassword/') ?>" + username + "?password=" + password,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          if (data.status == 1) {
            $("#password").val('');
            Swal.fire({
              icon: 'error',
              title: 'PASSWORD',
              text: 'Tidak sama, silahkan masukan ulang!',
            });
          } else {
            let timerInterval
            Swal.fire({
              title: 'PROSES MASUK SISTEM',
              html: 'Tunggu beberapa saat!',
              timer: 1000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                location.href = "<?= site_url('Home') ?>";
              }
            })
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