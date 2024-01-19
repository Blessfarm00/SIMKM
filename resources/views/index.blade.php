<?php
// index.php adalah file utama, di mana kita akan menentukan route

// Fungsi untuk menampilkan nomor antrian
function tampilkanNomorAntrian() {
  session_start();
  if (!isset($_SESSION['nomor_antrian'])) {
    $_SESSION['nomor_antrian'] = 0;
  }
  echo "Nomor Antrian saat ini: " . $_SESSION['nomor_antrian'];
}

// Fungsi untuk mengambil nomor antrian baru
function ambilNomorAntrian() {
  session_start();
  if (!isset($_SESSION['nomor_antrian'])) {
    $_SESSION['nomor_antrian'] = 1;
  } else {
    $_SESSION['nomor_antrian']++;
  }
}

// Menggunakan PHP_SELF untuk mengarahkan form ke halaman ini sendiri
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ambil_nomor_antrian'])) {
  ambilNomorAntrian();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Nomor Antrian</title>
</head>
<body>
  <h1>Nomor Antrian</h1>
  <?php tampilkanNomorAntrian(); ?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="ambil_nomor_antrian" value="Ambil Nomor Antrian">
  </form>
</body>
</html>
