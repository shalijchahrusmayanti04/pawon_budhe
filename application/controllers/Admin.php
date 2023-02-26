<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $on = $this->session->userdata("status");
    if ($on == 1) {
      $data = [
        "judul" => "Selamat Datang",
        "user" => $this->db->get_where("user", ['username' => $this->session->userdata("username")])->row(),
        "menu" => $this->db->query("SELECT m.*, k.nama_kategori FROM menu m JOIN kategori k ON m.kategori_menu = k.kode_kategori")->result(),
      ];
      $this->template->load('Template/Template_Admin', 'Admin/Home', $data);
    } else {
      redirect("Auth");
    }
  }
}
