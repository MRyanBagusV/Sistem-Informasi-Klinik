<?php
include_once '../includes/koneksi.php';

if (isset($_GET['id'])) {

  
  $sql= mysqli_query ($koneksi,"DELETE FROM pasien WHERE No_RM ='". $_GET['id']."'");

  
  if ($sql) {
  
    echo "<script>alert('Data berhasil dihapus'); window.location.href='../pages/pasien.php'</script>";
  } else {
    
    echo "<script>alert('Data gagal dihapus'); window.location.href='../pages/pasien.php'</script>";
  }
} else {
 
  header('Location:../pages/pasien.php');
}
?>
