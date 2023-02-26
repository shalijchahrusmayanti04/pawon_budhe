<?php
class M_code extends CI_Model
{
  function kategori()
  {
    $get = $this->db->query("SELECT kode_kategori AS kode FROM kategori ORDER BY kode_kategori DESC LIMIT 1");
    if ($get->num_rows() > 0) {
      $row = $get->row();
      $n = (substr($row->kode, 3)) + 1;
      $no = sprintf("%'.04d", $n);
    } else {
      $no = "0001";
    }
    $kode_kategori = "KAT" . $no;
    return $kode_kategori;
  }

  function menu()
  {
    $get = $this->db->query("SELECT kode_kategori AS kode FROM kategori ORDER BY kode_kategori DESC LIMIT 1");
    if ($get->num_rows() > 0) {
      $row = $get->row();
      $n = (substr($row->kode, 3)) + 1;
      $no = sprintf("%'.04d", $n);
    } else {
      $no = "0001";
    }
    $kode_kategori = "KAT" . $no;
    return $kode_kategori;
  }
}
