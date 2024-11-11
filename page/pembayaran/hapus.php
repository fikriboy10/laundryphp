<?php 

// menangkap nilai id dari url
$id = $_GET['id'];
// mengambil data dari tb_jenis berdasarkan id
$query = mysqli_query($conn, "SELECT * FROM tb_pembayaran WHERE kd_pembayaran = $id");
$row = mysqli_fetch_assoc($query);
$jenis_pembayaran = $row['jenis_pembayaran'];

// menghapus data jenis laundry
$result = mysqli_query($conn, "DELETE FROM tb_pembayaran WHERE kd_pembayaran = $id");

if ($result) {
  echo "
  <script>
    alert('Data dengan Jenis $jenis_pembayaran berhasil dihapus');
    window.location.href = '?page=pembayaran';
  </script>
";
}

?>