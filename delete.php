<?php
require_once('koneksi.php');
require_once('sql.php');

$obj = new crud;

// Jika ada parameter GET nim
if (isset($_GET['nim'])) {
    $nim_to_delete = $_GET['nim'];
    
    // Panggil method untuk menghapus data
    if ($obj->deleteData($nim_to_delete)) {
        echo '<div class="alert alert-success">Data berhasil dihapus</div>';
    } else {
        echo '<div class="alert alert-danger">Data gagal dihapus</div>';
    }
}
?>
