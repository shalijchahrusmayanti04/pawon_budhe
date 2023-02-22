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
    ];
    $this->template->load('Template/Template_Home', 'Home/Home', $data);
  }
}
