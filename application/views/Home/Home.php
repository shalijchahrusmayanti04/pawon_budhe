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
                <p style="width: 100%;" class="badge text-bg-warning">Rp. <span id="harga<?= $no; ?>" name="harga[]"><?= number_format($m->harga_menu); ?></span></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Qty</span>
                <input type="text" name="qty[]" id="qty<?= $no; ?>" class="form-control text-end" value="1" min="1" onkeyup="u_qty('<?= $no; ?>', '<?= $m->harga_menu; ?>')">
              </div>
            </div>
            <div class="col-4">
              <button type="button" class="btn btn-danger text-center" style="width: 100%;" id="btnpesan<?= $no; ?>" title="Pesan <?= $m->nama_menu ?>" onclick="pesanin('<?= $no; ?>', '<?= $m->kode_menu; ?>', '<?= $m->harga_menu; ?>')"><i class="fa-solid fa-cart-shopping"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php $no++;
  endforeach; ?>
</div>

<div class="modal fade" id="modal_pesan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">KERANJANG</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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

  function u_qty(id, harga) {
    var qtyx = $("#qty" + id).val();
    if (qtyx == '') {
      qty = 0;
      $("#btnpesan" + id).attr("disabled", true);
    } else {
      qty = Number(parseInt(qtyx.replaceAll(',', '')));
      $("#btnpesan" + id).attr("disabled", false);
    }
    $("#qty" + id).val(formatRupiah(qty));
    var new_harga = qty * harga;
    $("#harga" + id).text(formatRupiah(new_harga));
  }

  function pesanin(id, kode, harga) {
    var qtyx = $("#qty" + id).val();
    var qty = Number(parseInt(qtyx.replaceAll(',', '')));
    $("#jmlpesanan").addClass("position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle");
    $("#jmlpesanan").text(qtyx);
  }

  function keranjang() {
    $("#modal_pesan").modal("show");
  }
</script>