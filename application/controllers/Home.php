<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = [
      'judul' => "Selamat Datang",
      "menu" => $this->db->query("SELECT m.*, k.nama_kategori FROM menu m JOIN kategori k ON m.kategori_menu = k.kode_kategori")->result(),
    ];
    $this->template->load('Template/Template_Home', 'Home/Home', $data);
  }

  public function isi($param)
  {
    $menu = $this->db->query("SELECT m.*, k.nama_kategori FROM menu m JOIN kategori k ON m.kategori_menu = k.kode_kategori WHERE m.nama_menu LIKE '%$param%' OR m.harga_menu LIKE '%$param%' OR k.nama_kategori LIKE '%$param%'")->result();
    $no = 1;
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
    endforeach;
  }
}
