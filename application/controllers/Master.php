<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  /*
  KATEGORI
  */
  public function kategori()
  {
    $on = $this->session->userdata("status");
    if ($on == 1) {
      $data = [
        "judul" => "Data Kategori",
        "user" => $this->db->get_where("user", ['username' => $this->session->userdata("username")])->row(),
        "kategori" => $this->db->get("kategori")->result(),
        "menu" => $this->db->query("SELECT m.*, k.nama_kategori FROM menu m JOIN kategori k ON m.kategori_menu = k.kode_kategori")->result(),
      ];
      $this->template->load('Template/Template_Admin', 'Admin/Master/Kategori', $data);
    } else {
      redirect("Auth");
    }
  }

  public function cek_kategori($nama)
  {
    $cek = $this->db->get_where("kategori", ["nama_kategori" => $nama])->num_rows();
    if ($cek > 0) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }

  public function data_kategori($kode)
  {
    $cek = $this->db->get_where("kategori", ["kode_kategori" => $kode])->row();
    echo json_encode($cek);
  }

  public function simpan_kategori($nama)
  {
    $kode = $this->M_code->kategori();
    $data = [
      'kode_kategori' => $kode,
      'nama_kategori' => $nama,
    ];
    $cek = $this->db->insert("kategori", $data);
    if ($cek) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }

  public function update_kategori($kode)
  {
    $nama = $this->input->post("kategori");
    $cek = $this->db->query("UPDATE kategori SET nama_kategori = '$nama' WHERE kode_kategori = '$kode'");
    if ($cek) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }

  public function hapus_kategori($kode)
  {
    $cek = $this->db->query("DELETE FROM kategori WHERE kode_kategori = '$kode'");
    if ($cek) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }
}
