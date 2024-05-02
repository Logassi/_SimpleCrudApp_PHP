<?php
require_once('koneksi.php');
require_once('sql.php');

$obj = new crud;
if(!$obj->detailData($_GET['nim'])){
    die("Error : NIM Mahasiswa tidak di kenali");
}

// Jika ada permintaan POST dari form update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mahasiswa'];
    
    

    // Panggil method untuk melakukan update data
    if ($obj->updateData($nim, $nama, $obj->nim)) {

        echo '<div class="alert alert-success">Data berhasil diperbarui</div>';
    } else {
        echo '<div class="alert alert-danger">Data gagal diperbarui</div>';
    }
}

// Ambil data mahasiswa yang akan diupdate
// if (isset($_GET['nim'])) {
//     $nim_to_update = $_GET['nim'];
//     $sql = "SELECT nim, nama_mahasiswa FROM tb_mahasiswa WHERE nim='$nim_to_update'";
//     $result = $koneksi->query($sql);
//     $row = $result->fetch_assoc();
// }


?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Data Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h2>Update Data Mahasiswa</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <input type="hidden" name="nim" value="<?php echo $obj->nim; ?>">
            <div class="form-group">
                <label>NIM :</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $obj->nim; ?>" >
                <!-- <input type="text" class="form-control" name="nim" value="<?php //echo $row["nim"]; ?>" readonly> -->
            </div>
            <div class="form-group">
                <label>Nama Mahasiswa :</label>
                <input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $obj->nama_mahasiswa; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>


</html>
