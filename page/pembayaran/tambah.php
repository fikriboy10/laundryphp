<?php 

// jika tombol tambah ditekan
if (isset($_POST['tambah'])) {
  $jenis_pembayaran = htmlentities(strip_tags(trim($_POST["jenis_pembayaran"])));
  $pesan_error = "";

  // mengecek apakah ada jenis laundry yg sama
  $query_pembayaran = mysqli_query($conn, "SELECT * FROM tb_pembayaran WHERE jenis_pembayaran = '$jenis_pembayaran'");
  $result_pembayaran = mysqli_num_rows($query_pembayaran);
  if ($result_pembayaran > 0) {
    $pesan_error .= "Jenis <b>$jenis_laundry</b> sudah ada <br>";
  }

  // jika tidak ada error
  if ($pesan_error == "") {
    $query = mysqli_query($conn, "INSERT INTO `tb_pembayaran` (`kd_pembayaran`, `jenis_pembayaran`) VALUES ('', '$jenis_pembayaran'");
    if ($query) {
      echo "
      <script>
        alert('Data dengan jenis $jenis_pembayaran berhasil ditambahkan');
        window.location.href = '?page=pembayaran';
      </script>
      ";

    // jika ada error
    }else{
      $pesan_error .= "Data gagal disimpan !";
    }
    
  }else{
    $pesan_error .= "Data gagal disimpan !";
  }

}else{
  $pesan_error = "";
  $jenis_pembayaran = "";
}

?>

<div class="page-content-wrapper">
<div class="container-fluid">

  <div class="row">
      <div class="col-sm-12">
          <div class="page-title-box">
              <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="index.php">Laundry</a></li>
                      <li class="breadcrumb-item active">Data Jenis Pembayaran</li>
                      <li class="breadcrumb-item active">Tambah Jenis Pembayaran</li>
                  </ol>
              </div>
              <h4 class="page-title">Tambah Jenis Pembayaran</h4>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-12">

      <!-- menampilkan notifikasi pesan error jika ada -->
      <?php if ($pesan_error !== "") : ?>
        <div class="alert alert-danger" role="alert">
          <?= $pesan_error; ?>
        </div>
      <?php endif; ?>

          <form action="" method="post">
          <div class="card m-b-100">
            <div class="card-body">

              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Layanan Pembayaran</label>
                <div class="col-sm-10">
                  <input class="form-control"type="text"id="example-text-input" name="jenis_pembayaran" placeholder="Masukkan jenis pembayaran" value="<?= $jenis_pembayaran; ?>" required autofocus/>
                </div>
              </div>


              <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
              <a href="?page=pembayaran" class="btn btn-warning">Kembali</a>
            </div>
          </div>
        </form>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
</div>
<br>
