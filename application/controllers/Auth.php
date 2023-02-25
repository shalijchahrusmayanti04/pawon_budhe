<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  /*
  LOGIN
  */
  public function index()
  {
    $data = [
      'judul' => "Selamat Datang",
    ];
    $this->template->load('Template/Template_auth', 'Auth/Login', $data);
  }

  public function cekusername_l($username)
  {
    $data = $this->db->get_where("user", ["username" => $username])->num_rows();
    if ($data < 1) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }

  public function cekpassword($username)
  {
    $data = $this->db->get_where("user", ["username" => $username])->row();
    $password = $this->input->get("password");
    if ($data->password == md5($password)) {
      $data_sess = [
        'username' => $data->username,
        'id_role' => $data->id_role,
        'status' => 1,
      ];
      $this->session->set_userdata($data_sess);
      echo json_encode(["status" => 0]);
    } else {
      echo json_encode(["status" => 1]);
    }
  }

  /*
  REGISTRASI
  */
  public function regist()
  {
    $data = [
      'judul' => "Selamat Datang",
    ];
    $this->template->load('Template/Template_auth', 'Auth/Regist', $data);
  }

  public function cekusername_r($username)
  {
    $data = $this->db->get_where("user", ["username" => $username])->num_rows();
    if ($data > 0) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }

  public function daftar()
  {
    $username = $this->input->post("username");
    $password = $this->input->post("password");
    $nama = $this->input->post("nama");
    $nohp = $this->input->post("nohp");
    $alamat = $this->input->post("alamat");
    $data = [
      'username' => $username,
      'password' => md5($password),
      'nama' => $nama,
      'nohp' => $nohp,
      'alamat' => $alamat,
      'tglbuat' => date("Y-m-d H:i:s"),
      'id_role' => 3,
    ];
    $cek = $this->db->insert("user", $data);
    if ($cek) {
      echo json_encode(["status" => 1]);
    } else {
      echo json_encode(["status" => 0]);
    }
  }
}
