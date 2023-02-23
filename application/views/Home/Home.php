<div class="row justify-content-center" id="body-card">
  <?php $no = 1;
  foreach ($menu as $m) : ?>
    <div class="col-3 mb-3">
      <div class="card shadow h-100" data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="500">
        <img src="<?= base_url('assets/img/menu/') . $m->gambar_menu; ?>" class="card-img-top">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title" title="<?= $m->nama_menu; ?>"><?= mb_strimwidth($m->nama_menu, 0, 21, "..."); ?></h5>
              <p><?= $m->nama_kategori; ?></p>
              <div class="h3">
                <span style="width: 100%;" class="badge text-bg-warning">Rp. <?= number_format($m->harga_menu); ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Qty</span>
                <input type="text" name="qty[]" id="qty<?= $no; ?>" class="form-control text-end" value="1" min="1">
              </div>
            </div>
            <div class="col-4">
              <button type="button" class="btn btn-danger text-center" style="width: 100%;" id="btnpesan<?= $no; ?>" title="Pesan <?= $m->nama_menu ?>" onclick="pesanin('<?= $no; ?>', '<?= $m->kode_menu; ?>', '<?= $m->nama_menu; ?>')"><i class="fa-solid fa-cart-shopping"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php $no++;
  endforeach; ?>
</div>

<script>
  function cari(param) {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("body-card").innerHTML = this.responseText;
        AOS.init();
      }
    };
    xhttp.open("GET", "<?php echo base_url(); ?>Home/isi/" + param, true);
    xhttp.send();
  }
</script>