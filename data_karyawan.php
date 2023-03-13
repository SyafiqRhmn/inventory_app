<?php

require_once "layouts/header.php";
require_once "app/koneksi.php";

?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- tombah tambah data -->
        <div class="row">
          <div class="col-md-6">
            <!-- Judul Halaman -->
            <h4>Data Karyawan</h4>
          </div>
          <div class="col-md-6 text-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#formModal">TAMBAH</a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama</th>
              <th>Tempat, Tanggal Lahit</th>
              <th>Alamat</th>
              <th>Email Pribadi</th>
              <th>Email Kantor</th>
              <th>Lokasi Kerja</th>
              <th>Hubungan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $pemasok = $conn->query("SELECT k.*, lk.lokasi, cp.* FROM karyawan k JOIN lokasi_kerja lk ON k.id_lokasi=lk.id JOIN contact_person cp ON cp.id_karyawan=k.id");
            while ($data = $pemasok->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['nama_karyawan'] ?></td>
                <td><?= $data['ttl'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['email_pribadi'] ?></td>
                <td><?= $data['email_kantor'] ?></td>
                <td><?= $data['lokasi'] ?></td>
                <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#formModalHubungan" onclick='showHubunganForm(`<?= json_encode($data) ?>`)'>DETAIL</a></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_karyawan.php?id=<?= $data["id"] ?>`, `Karyawan: <?= $data["nama_karyawan"] ?>`)'>
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Modal -->

<!-- Form Modal untuk tambah dan Edit Data -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <!-- atur form disini -->
    <form action="tambah_karyawan.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Karyawan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_karyawan.php', 'Tambah Data Karyawan')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">
            <h5><b>Data Karyawan</b></h5>
            <!-- edit untuk mengubah isi form -->
            <input type="hidden" name="id" id="id" value="">

            <div class="form-group">
              <label for="no_ktp">No KTP</label>
              <input type="text" name="no_ktp" id="no_ktp" class="form-control">
            </div>

            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control">
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="tmp_lhr">Tempat Lahir</label>
                <input type="text" name="tmp_lhr" id="tmp_lhr" class="form-control">
              </div>

              <div class="col-sm-6">
                <label for="tgl_lhr">Tanggal Lahir</label>
                <input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="email_p">Email Pribadi</label>
                <input type="email" name="email_p" id="email_p" class="form-control">
              </div>

              <div class="col-sm-6">
                <label for="email_k">Email Kantor</label>
                <input type="email" name="email_k" id="email_k" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="no_wa">No Whatsapp</label>
                <input type="text" name="no_wa" id="no_wa" class="form-control">
              </div>

              <div class="col-sm-6">
                <label for="tgl_msk_krj">Tanggal Masuk Kerja</label>
                <input type="date" name="tgl_msk_krj" id="tgl_msk_krj" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="lokasi">Lokasi Kerja</label>
                <select name="lokasi" id="lokasi" class="form-control">
                  <?php
                  $aset = $conn->query("SELECT * FROM lokasi_kerja");
                  while ($data = $aset->fetch_assoc()) :?>
                    <option value="<?= $data['id'] ?>"><?= $data['lokasi'] ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="col-sm-6">
                <label for="status_k">Status Karyawan</label>
                <select name="status_k" id="status_k" class="form-control">
                  <option value="A">Aktif</option>
                  <option value="I">Tidak Aktif</option>
                </select>
              </div>
            </div>
            <h5><b>Data Keluarga</b></h5>

            <div class="form-group">
              <label for="nama_k">Nama Keluarga</label>
              <input type="text" name="nama_k" id="nama_k" class="form-control">
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label for="no_hp">No HP Keluarga</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control">
              </div>

              <div class="col-sm-6">
                <label for="hub_k">Hubungan Keluarga</label>
                <select name="hub_k" id="hub_k" class="form-control">
                  <option value="suami">Suami</option>
                  <option value="istri">Istri</option>
                </select>
              </div>
            </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_karyawan.php','Tambah Data Karyawan')">Batal</button>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </div>
    </form>
  </div>
</div>

<!-- Form Modal untuk tambah dan Edit Data -->
<div class="modal fade" id="formModalHubungan" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <!-- atur form disini -->
    <form action="data_karyawan.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Lihat Hubungan Data Karyawan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_karyawan.php', 'Tambah Data Karyawan')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">
            <h5><b>Data Keluarga</b></h5>

            <div class="form-group">
              <label for="nama_kk">Nama Keluarga</label>
              <input type="text" name="nama_kk" id="nama_kk" class="form-control" disabled>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label for="no_hpp">No HP Keluarga</label>
                <input type="text" name="no_hpp" id="no_hpp" class="form-control" disabled>
              </div>

              <div class="col-sm-6">
                <label for="hub_kk">Hubungan Keluarga</label>
                <select name="hub_kk" id="hub_kk" class="form-control" disabled>
                  <option value="suami">Suami</option>
                  <option value="istri">Istri</option>
                </select>
              </div>
            </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <input type="submit" class="btn btn-primary" value="OK">
      </div>
    </form>
  </div>
</div>

<!-- coding untuk form edit -->
<script>
  // fungsi untuk edit siswa
  function editForm(data) {
    // parse json data menjadi objek
    data = JSON.parse(data);
    let editAction = 'update_karyawan.php';
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Karyawan');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#nama').val(data.nama_karyawan);
    $('#no_ktp').val(data.no_ktp);
    $('#ttl').val(data.ttl);
    $('#alamat').val(data.alamat);
    $('#email_p').val(data.email_pribadi);
    $('#email_k').val(data.email_kantor);
    $('#lokasi').val(data.id_lokasi);
    $('#status_k').val(data.status_karyawan);

    
    $('#no_hp').val(data.no_hp);
    $('#nama_k').val(data.nama);
    $('#no_wa').val(data.no_wa);
    $('#hub_k').val(data.hub_keluarga);
    $('#tgl_msk_krj').val(data.tgl_masuk_kerja.split(" ")[0]);
    $split = data.ttl.split(", ");
    $('#tmp_lhr').val($split[0]);
    $('#tgl_lhr').val($split[1]);

  }

  function showHubunganForm(data) {
    // parse json data menjadi objek
    console.log(data);
    data = JSON.parse(data);
    $('#nama_kk').val(data.nama);
    $('#no_hpp').val(data.no_hp);
    $('#hub_kk').val(data.hub_keluarga);
  }

  // datatable
  $(function() {
    $("#datatable").DataTable({
      "responsive": true,
      "lengthChange": false,
      "pageLength": 5,
      // "scrollY": 500,
      // "scrollX": true,
      "scrollCollapse": true,
      "autoWidth": false,
      "ordering": false,
      "info": false
    });
  });
</script>

<?php require_once "layouts/footer.php" ?>