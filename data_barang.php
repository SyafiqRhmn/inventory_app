<?php
require_once "layouts/header.php";
require_once "app/koneksi.php";

$idType = 1;
if (isset($_POST['idType'])) {
  $idType = $_POST['idType'];
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
            <h4>Data Barang Inventaris</h4>
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
              <th>Merk</th>
              <th>Detail barang</th>
              <th>Tipe</th>
              <th>Kondisi</th>
              <!-- <th>Foto</th> -->
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $pemasok = $conn->query("SELECT b.*, tb.tipe FROM barang b JOIN tipe_barang tb ON b.id_tipe=tb.id");
            while ($data = $pemasok->fetch_assoc()) :

              $json_d = $data['detail_barang'];
              $json_d = str_replace("{", "", $json_d);
              $json_d = str_replace("}", "", $json_d);
              $json_d = str_replace('"', "", $json_d);
              $json_d = str_replace(',', "<br>", $json_d);
              $json_d = str_replace(':', " = ", $json_d);
              $data['detail_barang'] = json_decode($data['detail_barang']);
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['merk'] ?></td>
                <td><?= $json_d ?></td>
                <td><?= $data['tipe'] ?></td>
                <td><?= $data['kondisi_barang'] ?></td>
                <!-- <td><?= $data['foto_barang'] ?></td> -->
                <td class="text-center">
                  <!-- <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a> -->
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_barang.php?id=<?= $data["id"] ?>`, `Barang: <?= $data["merk"] ?>`)'>
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
    <form action="tambah_barang.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Inventaris Barang</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_barang.php', 'Tambah Data Barang')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="tipe">Tipe Barang <?php echo $idType;?></label>
          <select name="tipe" id="tipe" class="form-control" onchange="show_value('tipe')">
            <?php
            $aset = $conn->query("SELECT * FROM tipe_barang");
            while ($data = $aset->fetch_assoc()) :?>
              <option value="<?= $data['id']?>"><?= $data['tipe'] ?></option>
            <?php endwhile; ?>
          </select>
          <script>
            function show_value(input_id) {
                selected_value = document.getElementById(input_id).value;
                console.log(selected_value);
                if(selected_value == "1"){
                  $('#id2').css('visibility','hidden');
                  $('#id2').css('display','none');
                  $('#id1').css('visibility','visible');
                  $('#id1').show();
                }else{
                  $('#id1').css('visibility','hidden');
                  $('#id1').css('display','none');
                  $('#id2').css('visibility','visible');
                  $('#id2').show();
                }
                $('#id').val(selected_value);
                $(window).on('load', function() {
                  $("#formModal").modal('show');
                });
            }
          </script>
        </div>
        <div id = "id1">
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="merk">Merk Laptop</label>
              <input type="text" name="merk" id="merk" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="sn">S/N Laptop</label>
                <input type="text" name="sn" id="sn" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="model_l">Model Laptop</label>
              <input type="text" name="model_l" id="model_l" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="proc">Processor Laptop</label>
              <input type="text" name="proc" id="proc" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="memory">Memory RAM</label>
              <input type="text" name="memory" id="memory" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="hardisk">Ukuran HDD/SSD</label>
              <input type="text" name="hardisk" id="hardisk" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="monitor">Ukuran Monitor</label>
              <input type="text" name="monitor" id="monitor" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="so">Sistem Operasi & Lisensi</label>
              <input type="text" name="so" id="so" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="mac">MAC Address</label>
              <input type="text" name="mac" id="mac" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="ip">IP</label>
              <input type="text" name="ip" id="ip" class="form-control">
            </div>
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
        <div id = "id2" style="visibility: hidden; display: none;">
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="merk_h">Merk Handphone</label>
              <input type="text" name="merk_h" id="merk_h" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="model_h">Model Handphone</label>
                <input type="text" name="model_h" id="model_h" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="memory_r">Memory RAM</label>
              <input type="text" name="memory_r" id="memory_r" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="memory_i">Memory Internal</label>
              <input type="text" name="memory_i" id="memory_i" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="warna">Warna</label>
              <input type="text" name="warna" id="warna" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="versi_os">Versi OS</label>
              <input type="text" name="versi_os" id="versi_os" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="thn_p">Tahun Pengeluaran</label>
                <input type="text" name="thn_p" id="thn_p" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="kondisi_h">Kondisi Barang</label>
              <select name="kondisi_h" id="kondisi_h" class="form-control">
                <option value="Sangat Bagus">Sangat Bagus</option>
                <option value="Bagus">Bagus</option>
                <option value="Cukup">Cukup</option>
                <option value="Rusak">Rusak</option>
              </select>
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_barang.php','Tambah Data Barang')">Batal</button>
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
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Karyawan');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    if(data.id_tipe == "1"){
      $('#id2').css('visibility','hidden');
      $('#id2').css('display','none');
      $('#id1').css('visibility','visible');
      $('#id1').show();
      $('#merk').val(data.merk);
      $('#kondisi').val(data.kondisi_barang);
    }else{
      $('#id1').css('visibility','hidden');
      $('#id1').css('display','none');
      $('#id2').css('visibility','visible');
      $('#id2').show();
      $('#merk_h').val(data.merk);
      $('#kondisi_h').val(data.kondisi_barang);
    }

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id_tipe);
    $('#tipe').val(data.id_tipe);
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