<?php

require_once "layouts/header.php";
require_once "app/koneksi.php";



$jenis = "";
if(isset($_GET['jenis'])){
  $jenis = $_GET['jenis'];
}
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- tombah tambah data -->
        <div class="row">
          <div class="col-md-6">
            <!-- Judul Halaman -->
            <h4>Data Inventaris <?php echo $jenis;?></h4>
          </div>
          <?php
              if ($jenis == "Kembali"){
                ?>
                <div class="col-md-6 text-right">
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#formModalKembali">TAMBAH</a>
                </div>
                <?php
              }else{
                ?>
                <div class="col-md-6 text-right">
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#formModal">TAMBAH</a>
                </div>
                <?php
              }
          ?>
          
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th>Nama Karyawan</th>
              <th>Detail Barang</th>
              <th>Tanggal Terima</th>
              <th>Kondisi Terima</th>
              <?php
              if ($jenis == "Kembali"){
                ?>
              <th>Tanggal Kembali</th>
              <th>Kondisi Kembali</th>
                <?php
              }
              ?>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $sql = "";
            if ($jenis == "Terima"){
              $sql = "SELECT it.*, b.detail_barang detail_barang, k.nama_karyawan nama_karyawan FROM karyawan k JOIN inventaris_terima it ON k.id=it.id_karyawan JOIN barang b ON b.id=it.id_barang ";
            }else{
              $sql = "SELECT ik.*, b.detail_barang detail_barang, k.nama_karyawan nama_karyawan, it.tgl_terima tgl_terima, it.kondisi_terima kondisi_terima FROM karyawan k JOIN inventaris_terima it ON k.id=it.id_karyawan JOIN barang b ON b.id=it.id_barang JOIN inventaris_kembali ik ON it.id=ik.id_inventaris_terima";
            }
            $pemasok = $conn->query($sql);
            while ($data = $pemasok->fetch_assoc()) :
              $json_d = $data['detail_barang'];
              $json_d = str_replace("{", "", $json_d);
              $json_d = str_replace("}", "", $json_d);
              $json_d = str_replace('"', "", $json_d);
              $json_d = str_replace(',', "<br>", $json_d);
              $json_d = str_replace(':', " = ", $json_d);
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['nama_karyawan'] ?></td>
                <td><?= $json_d ?></td>
                <td><?= $data['tgl_terima'] ?></td>
                <td><?= $data['kondisi_terima'] ?></td>
                <?php
                if ($jenis == "Kembali"){
                  ?>
                <td><?= $data['tgl_kembali'] ?></td>
                <td><?= $data['kondisi_kembali'] ?></td>
                  <?php
                }
                ?>
                <td class="text-center">
                  <!-- <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a> -->
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_inventaris.php?id=<?= $data["id"] ?>&jenis=<?= $jenis ?>`, `Data Inventaris Karyawan: <?= $data["nama_karyawan"] ?>`)'>
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
<div class="modal fade" id="formModalKembali" tabindex="-1" role="dialog" aria-labelledby="formModalKembaliLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- atur form disini -->
    <form action="tambah_inventaris.php?jenis=<?php echo $jenis;?>" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalKembaliLabel">Tambah Inventaris <?php echo $jenis;?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_inventaris.php?jenis=<?php echo $jenis;?>', 'Tambah Data Inventaris')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">

        <div class="form-group">
          <label for="id">Data Inventaris</label>
          <select name="id" id="id" class="form-control">
            <?php
            $aset = $conn->query("SELECT it.id id, k.nama_karyawan nama, b.merk merk, it.tgl_terima tgl FROM karyawan k JOIN inventaris_terima it ON k.id=it.id_karyawan JOIN barang b ON b.id=it.id_barang");
            while ($data = $aset->fetch_assoc()) :?>
              <option value="<?= $data['id'] ?>">Nama : <?= $data['nama'] ?> , Merk : <?= $data['merk'] ?> , Tanggal Terima : <?= $data['tgl'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="tgl">Tanggal Kembali</label>
          <input type="date" name="tgl" id="tgl" class="form-control">
        </div>

        <div class="form-group">
          <label for="kondisi">Kondisi Barang</label>
          <select name="kondisi" id="kondisi" class="form-control">
            <option value="Sangat Bagus">Sangat Bagus</option>
            <option value="Bagus">Bagus</option>
            <option value="Cukup">Cukup</option>
            <option value="Rusak">Rusak</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_inventaris.php?jenis=<?php echo $jenis;?>','Tambah Data Karyawan')">Batal</button>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </div>
    </form>
  </div>
</div>


<!-- Form Modal untuk tambah dan Edit Data -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- atur form disini -->
    <form action="tambah_inventaris.php?jenis=<?php echo $jenis;?>" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Inventaris <?php echo $jenis;?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_inventaris.php?jenis=<?php echo $jenis;?>', 'Tambah Data Inventaris')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">

        <div class="form-group">
          <label for="od">Nama Karyawan</label>
          <select name="id" id="id" class="form-control">
            <?php
            $aset = $conn->query("SELECT * FROM karyawan");
            while ($data = $aset->fetch_assoc()) :?>
              <option value="<?= $data['id'] ?>"><?= $data['nama_karyawan'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="lokasi">Nama Barang</label>
          <select name="lokasi" id="lokasi" class="form-control">
            <?php
            $aset = $conn->query("SELECT * FROM barang");
            while ($data = $aset->fetch_assoc()) :
              $json_d = $data['detail_barang'];
              $json_d = str_replace("{", "", $json_d);
              $json_d = str_replace("}", "", $json_d);
              $json_d = str_replace('"', "", $json_d);
              $json_d = str_replace(',', "<br>", $json_d);
              $json_d = str_replace(':', " = ", $json_d);
            ?>
              <option value="<?= $data['id'] ?>"><?=$data['merk']?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="tgl">Tanggal Terima</label>
          <input type="date" name="tgl" id="tgl" class="form-control">
        </div>

        <div class="form-group">
          <label for="kondisi">Kondisi Barang</label>
          <select name="kondisi" id="kondisi" class="form-control">
            <option value="Sangat Bagus">Sangat Bagus</option>
            <option value="Bagus">Bagus</option>
            <option value="Cukup">Cukup</option>
            <option value="Rusak">Rusak</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_inventaris.php?jenis=<?php echo $jenis;?>','Tambah Data Karyawan')">Batal</button>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </div>
    </form>
  </div>
</div>

<!-- coding untuk form edit -->
<script>
  // fungsi untuk edit siswa
  function editForm(data) {
    // parse json data menjadi objek
    console.log(data);
    data = JSON.parse(data);
    let editAction = 'update_karyawan.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Karyawan');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#nama').val(data.nama_karyawan);
    $('#ttl').val(data.ttl);
    $('#alamat').val(data.alamat);
    $('#email_p').val(data.email_pribadi);
    $('#email_k').val(data.email_kantor);
    $('#lokasi').val(data.id_lokasi);
    $('#status_k').val(data.status_karyawan);
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