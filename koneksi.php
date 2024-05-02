<?php

class database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "test";
    protected $koneksi;

    // Corrected the constructor method name
    public function __construct()
    {
        $this->koneksi = new mysqli($this->host, $this->user, $this->pass, $this->db);
        // Corrected the condition to check for connection
        if ($this->koneksi->connect_error) {
            die("Tidak dapat tersambung ke database: " . $this->koneksi->connect_error);
        }
        return $this->koneksi;
    }
}
?>
