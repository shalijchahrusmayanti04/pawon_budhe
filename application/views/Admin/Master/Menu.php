<div class="row">
  <div class="col">
    <div class="card shadow mb-3">
      <div class="card-body">
        <div>
          <span class="h4"><?= strtoupper($judul); ?></span>
          <a href="<?= site_url('Master/form_tambah'); ?>" class="btn btn-primary btn-sm float-end" type="button">Tambah <i class="fa-solid fa-circle-plus"></i></a>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="table-standar" class="table table-striped table-hover table-bordered">
            <thead class="bg-warning">
              <tr>
                <th class="text-center" width="5%">No</th>
                <th class="text-center">Gambar</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Menu</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Harga</th>
                <th class="text-center" width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($menu as $m) : ?>
                <tr>
                  <td class="text-end"><?= $no; ?></td>
                  <td class="text-center">
                    <img src="<?= base_url('assets/img/menu/') . $m->gambar_menu; ?>" style="border-radius: 50%; width: 50px;">
                  </td>
                  <td><?= $m->kode_menu; ?></td>
                  <td><?= $m->nama_menu; ?></td>
                  <td><?= $m->nama_kategori; ?></td>
                  <td>Rp. <span class="text-end"><?= number_format($m->harga_menu); ?></span></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-warning mb-3" onclick="update_kategori('<?= $m->kode_menu; ?>')">Update <i class="fa-solid fa-rotate"></i></button>
                    <?php $cek = $this->db->get_where("menu", ["kategori_menu" => $m->kode_menu])->row(); ?>
                    <?php if ($cek) : ?>
                      <button type="button" class="btn btn-sm btn-danger mb-3" disabled>Hapus <i class="fa-solid fa-circle-minus"></i></button>
                    <?php else : ?>
                      <button type="button" class="btn btn-sm btn-danger mb-3" onclick="hapus('<?= $m->kode_menu; ?>', '<?= $m->nama_menu; ?>')">Hapus <i class="fa-solid fa-circle-minus"></i></button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php $no++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>