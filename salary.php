<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Update gaji karyawan dengan ID 1
$sql = "UPDATE employees SET salary = 7500 WHERE id = 1";

if ($conn->query($sql) === TRUE) {
    echo "Gaji berhasil diperbarui. Trigger otomatis dijalankan!";
} else {
    echo "Error: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
