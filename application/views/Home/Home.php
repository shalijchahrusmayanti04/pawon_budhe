<style>
  #btnpesan1.hover {}
</style>

<div class="row justify-content-center" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="500">
  <?php $no = 1;
  foreach ($menu as $m) : ?>
    <div class="col-3 mb-3">
      <div class="card shadow h-100">
        <img src="<?= base_url('assets/img/menu/') . $m->gambar_menu; ?>" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title" title="<?= $m->nama_menu; ?>"><?= mb_strimwidth($m->nama_menu, 0, 21, "..."); ?></h5>
          <p><?= $m->nama_kategori; ?></p>
          <div class="h3">
            <span class="badge text-bg-warning">Rp. <?= number_format($m->harga_menu); ?></span>
            <button type="button" class="btn btn-danger float-end" id="btnpesan<?= $no; ?>" title="Pesan"><i class="fa-solid fa-cart-shopping"></i></button>
          </div>
        </div>
      </div>
    </div>
  <?php $no++;
  endforeach; ?>
</div>