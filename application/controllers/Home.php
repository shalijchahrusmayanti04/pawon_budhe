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
}
