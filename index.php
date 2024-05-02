<?php
require_once('koneksi.php');
require_once('sql.php');

$obj = new crud();

// Handle form submission for insertion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];

    // Insert data into the database
    $inserted = $obj->insertData($nim, $nama_mahasiswa);

    // Check if insertion was successful
    if ($inserted) {
        // Redirect to avoid resubmission when refreshing the page
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo '<div class="alert alert-danger">Data gagal disimpan</div>';
    }
}

// Handle deletion of data
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];

    // Delete data from the database
    $deleted = $obj->deleteData($id_to_delete);

    // Check if deletion was successful
    if ($deleted) {
        // Redirect to avoid resubmission when refreshing the page
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo '<div class="alert alert-danger">Gagal menghapus data</div>';
    }
}

// Ambil data mahasiswa dari database
$sql = "SELECT * FROM tb_mahasiswa";
$result = $obj->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tutorial PHP : CRUD OOP PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tutorial PHP : CRUD OOP PHP - RDDT93.CO.ID</h6>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nim">NIM </label>
                                <input type="text" class="form-control" id="nim" name="nim" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_mahasiswa">NAMA MAHASISWA</label>
                                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="mt-4 btn btn-md btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tampilkan data mahasiswa -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama Mahasiswa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1; // Initialize counter
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $counter++ . "</td>
                                            <td>" . $row["nim"] . "</td>
                                            <td>" . $row["nama_mahasiswa"] . "</td>
                                            <td>
                                                
                                                <a href='update.php?nim=" .$row['nim'] . "' class='btn btn-sm btn-primary'>Edit</a>
                                                <a href='delete.php?nim=" .$row['nim']. "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Belum ada data mahasiswa</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>