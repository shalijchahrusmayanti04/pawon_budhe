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

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">

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
  <nav class="navbar navbar-expand-lg bg-warning">
    <div class="container">
      <a class="navbar-brand" href="<?= site_url('Admin'); ?>" title="Beranda">
        <img src="<?= base_url('assets/img/logo.jpeg'); ?>" style="border-radius: 50%; width: 50px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <?php if ($this->uri->segment(1) == 'Admin') : ?>
              <a class="nav-link active" aria-current="page" href="<?= site_url('Admin'); ?>">Beranda</a>
            <?php else : ?>
              <a class="nav-link" aria-current="page" href="<?= site_url('Admin'); ?>">Beranda</a>
            <?php endif; ?>
          </li>
          <li class="nav-item dropdown">
            <?php if ($this->uri->segment(1) == 'Master') : ?>
              <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Master
              </a>
            <?php else : ?>
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Master
              </a>
            <?php endif; ?>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= site_url('Master/kategori'); ?>">Kategori</a></li>
              <li><a class="dropdown-item" href="#">Menu</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item dropdown">
            <a class="btn btn-success text-white nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?= base_url('assets/img/user/') . $user->gambar; ?>" style="width: 20px; height: 50%; border-radius: 50%; background-repeat: no-repeat; background-position: center; background-size: cover;"> <?= $user->username; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Profil</a></li>
              <li><a class="dropdown-item" href="#">Ubah Password</a></li>
              <li><a class="dropdown-item" type="button" onclick="keluar()">Keluar</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-3">
    <?= $content; ?>
  </div>

  <!-- bootstrap js -->
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
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

    $("#table-standar").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "scrollCollapse": false,
      "paging": true,
      "oLanguage": {
        "sEmptyTable": "<div class='text-center'>Data Kosong</div>",
        "sInfoEmpty": "",
        "sInfoFiltered": " - Dipilih dari _END_ data",
        "sSearch": "Pencarian Data : ",
        "sInfo": "Data (_START_ - _END_)",
        "sLengthMenu": "_MENU_ Baris",
        "sLoadingRecords": "Loading...",
        "sProcessing": "Tunggu Sebentar... Loading...",
        "sZeroRecords": "Tida ada data",
        "oPaginate": {
          "sPrevious": "Sebelumnya",
          "sNext": "Berikutnya"
        },
      },
      "aLengthMenu": [
        [5, 15, 20, -1],
        [5, 15, 20, "Semua"]
      ],
    });
  </script>
</body>

</html>