<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul; ?></title>
  <!-- font-google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

  <!-- aos animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
  <style>
    /* For mobile phones: */
    [class*="col-"] {
      width: 100%;
    }

    @media only screen and (min-width: 768px) {

      /* For desktop: */
      .col-1 {
        width: 8.33%;
      }

      .col-2 {
        width: 16.66%;
      }

      .col-3 {
        width: 25%;
      }

      .col-4 {
        width: 33.33%;
      }

      .col-5 {
        width: 41.66%;
      }

      .col-6 {
        width: 50%;
      }

      .col-7 {
        width: 58.33%;
      }

      .col-8 {
        width: 66.66%;
      }

      .col-9 {
        width: 75%;
      }

      .col-10 {
        width: 83.33%;
      }

      .col-11 {
        width: 91.66%;
      }

      .col-12 {
        width: 100%;
      }
    }
  </style>
  <nav class="navbar bg-warning">
    <div class="container">
      <a class="navbar-brand">
        <img src="<?= base_url('assets/img/logo.jpeg'); ?>" style="border-radius: 50%; width: 50px;">
      </a>
      <div class="row justify-content-center">
        <div class="col">
          <form class="d-flex" role="search">
            <button type="button" class="btn btn-dark position-relative" style="margin-right: 10px;" onclick="keranjang()" title="Keranjang"><i class="fa-solid fa-bag-shopping"></i><sup id="jmlpesanan"></sup></button>
            <input class="form-control me-2" type="search" placeholder="Cari..." onkeyup="cari(this.value)" autofocus>
            <div class="dropdown">
              <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url('assets/img/user/') . $user->gambar; ?>" style="width: 20px; height: 50%; border-radius: 50%; background-repeat: no-repeat; background-position: center; background-size: cover;"> <?= $user->username; ?>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                <li><a class="dropdown-item" type="button" onclick="keluar()">Keluar</a></li>
              </ul>
            </div>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mt-3">
    <?= $content; ?>
  </div>

  <!-- bootstrap js -->
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
  <!-- initial aos -->
  <script>
    AOS.init();
  </script>
  <!-- format rp -->
  <script>
    function formatRupiah(val) {
      var sign = 1;
      if (val < 0) {
        sign = -1;
        val = -val;
      }
      let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
      let len = num.toString().length;
      let result = '';
      let count = 1;
      for (let i = len - 1; i >= 0; i--) {
        result = num.toString()[i] + result;
        if (count % 3 === 0 && count !== 0 && i !== 0) {
          result = ',' + result;
        }
        count++;
      }
      if (val.toString().includes('.')) {
        result = result + '.' + val.toString().split('.')[1];
      }
      return sign < 0 ? '-' + result : result;
    }

    function keluar() {
      var username = '<?= $user->username; ?>';
      Swal.fire({
        title: 'KELUAR',
        text: "Yakin ingin keluar dari sistem?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "<?= site_url('Auth/keluar/') ?>" + username,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
              Swal.fire({
                icon: 'success',
                title: 'USER ' + username.toUpperCase(),
                text: 'Berhasil keluar!',
              }).then((value) => {
                location.href = "<?= site_url('Auth') ?>";
              })
            }
          });
        }
      })
    }
  </script>
</body>

</html>