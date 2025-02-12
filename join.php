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

// Query JOIN untuk mengambil nama, gaji, dan nama departemen
$sql = "SELECT employees.name, employees.salary, departments.department_name
        FROM employees
        JOIN departments ON employees.department_id = departments.id";
$result = $conn->query($sql);

// Menampilkan hasil JOIN
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Nama: " . $row['name'] . " - Gaji: " . number_format($row['salary'], 2) . " - Departemen: " . $row['department_name'] . "<br>";
    }
} else {
    echo "Tidak ada data.";
}

// Menutup koneksi
$conn->close();
?>
