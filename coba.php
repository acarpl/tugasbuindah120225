<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "user_management"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil nama dan gaji karyawan yang memiliki gaji lebih tinggi dari rata-rata
$sql = "SELECT name, salary
        FROM employees
        WHERE salary > (SELECT AVG(salary) FROM employees)";
$result = $conn->query($sql);

// Menampilkan hasil query bertingkat
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Nama: " . $row['name'] . " - Gaji: " . number_format($row['salary'], 2) . "<br>";
    }
} else {
    echo "Tidak ada karyawan dengan gaji di atas rata-rata.";
}

// Menutup koneksi
$conn->close();
?>
