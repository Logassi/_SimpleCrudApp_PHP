<?php

class crud extends database
{
    public function prepare($data)
    {
        $perintah = $this->koneksi->prepare($data);
        if(!$perintah) die("Terjadi kesalahan pada prepare statement: " . $this->koneksi->error);
        return $perintah;
    }

    public function query($data)
    {
        $perintah = $this->koneksi->query($data);
        if(!$perintah) die("Terjadi kesalahan sql: " . $this->koneksi->error);
        return $perintah;
    }

    public function tampilMahasiswa()
    {
        $sql ="SELECT nim, nama_mahasiswa FROM tb_mahasiswa";
        $perintah = $this->query($sql);
        return $perintah;
    }

    public function insertData($nim, $nama_mahasiswa)
    {
        $sql = "INSERT INTO tb_mahasiswa (nim, nama_mahasiswa) VALUES (?, ?)";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("ss", $param_nim, $param_nama);
            $param_nim = $nim;
            $param_nama = $nama_mahasiswa;
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        $stmt->close();
    }

    public function detailData($data)
    {
        $sql = "SELECT nim, nama_mahasiswa FROM tb_mahasiswa WHERE nim=?";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("i", $param_data);
            $param_data = $data;
            if($stmt->execute()) {
                $stmt->store_result();
                $stmt->bind_result($this->nim, $this->nama_mahasiswa);
                $stmt->fetch();
                if($stmt->num_rows == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        $stmt->close();
    }

    public function updateData($nim, $nama, $objNIM)
    {
        $sql = "UPDATE tb_mahasiswa SET nim=?, nama_mahasiswa=? WHERE nim=?";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("ssi", $param_nim, $param_nama, $param_data);
            $param_nim = $nim;
            $param_nama = $nama;
            $param_data = $objNIM;
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        $stmt->close();
    }

    public function deleteData($data)
    {
        $sql = "DELETE FROM tb_mahasiswa WHERE nim=?";
        if($stmt = $this->prepare($sql)) {
            $stmt->bind_param("i", $param_data);
            $param_data = $data;
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        $stmt->close();
    }
}
?>
