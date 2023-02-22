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
<?php endforeach;
  }
}
