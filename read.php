<?php
require_once('koneksi.php');
require_once('sql.php');

// Instantiate the crud class
$obj = new crud();

// Ambil data mahasiswa dari database
$sql = "SELECT * FROM tb_mahasiswa";
$result = $obj->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tampil Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Data Mahasiswa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nim</th>
                    <th>Nama Mahasiswa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["nim"] . "</td>
                                <td>" . $row["nama"] . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Belum ada data mahasiswa</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
