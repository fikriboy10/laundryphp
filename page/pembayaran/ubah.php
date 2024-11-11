<?php 

// ambil nilai id dari url
$id = $_GET['id'];
// menampilkan data jenis berdasarkan id
$result = mysqli_query($conn, "SELECT * FROM tb_pembayaran WHERE kd_pembayaran = '$id'");
$row = mysqli_fetch_assoc($result);

  $jenis_pembayaran = $row['jenis_pembayaran'];

// jika tombol ubah ditekan
if (isset($_POST['ubah'])) {
  $jenis_pembayaran = htmlentities(strip_tags(trim($_POST["jenis_pembayaran"])));
  $pesan_error = "";

  // mengecek jenis laundry
  // jika jenis laundry yang diinputkan tidak sama dengan nama jenis laundry yg lama, maka 
  if ($row['jenis_pembayaran'] !== $jenis_pembayaran) {
    // menampilkan data jenis laundry sesuai dengan inputan jenis laundry
    $query_pembayaran = mysqli_query($conn, "SELECT * FROM tb_pembayaran WHERE jenis_pembayaran = '$jenis_pembayaran'");
    $result_pembayaran = mysqli_num_rows($query_pembayaran);

    // cek apakah jenis laundry ada yang
    if ($result_pembayaran > 0) {
      $pesan_error = "Jenis Pembayaran <b>$jenis_pembayaran</b> sudah ada <br>";
    }
  }

  // jika tidak terdapat pesan error
  if ($pesan_error == "") {
    $query = mysqli_query($conn, "UPDATE `tb_pembayaran` SET `jenis_pembayaran = '$jenis_pembayaran' WHERE `tb_pembayaran`.`kd_pembayaran` = $id");
    if ($query) {
      echo "
      <script>
        alert('Data pembayaran $jenis_pembayaran berhasil diubah');
        window.location.href = '?page=pembayaran';
      </script>
      ";
    }else{
      // jika gagal disimpan
      $pesan_error .= "Data gagal disimpan !";
    }
  // jika ada error
  }else{
    $pesan_error .= "Data gagal disimpan !";
  }

}else{
  $pesan_error = "";
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
                      <li class="breadcrumb-item active">Edit Jenis Pembayaran</li>
                  </ol>
              </div>
              <h4 class="page-title">Edit Jenis Pembayaran</h4>
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
                <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Pembayaran Laundry</label>
                <div class="col-sm-10">
                  <input class="form-control"type="text"id="example-text-input" name="jenis_pembayaran" placeholder="Masukkan jenis pembayaran" value="<?= $jenis_pembayaran; ?>" required autofocus/>
                </div>
              </div>


              <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
              <a href="?page=jenis" class="btn btn-warning">Kembali</a>
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
