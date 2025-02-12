<?php
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "user_management"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$action = $_POST['action'];
$sql = "";

// Menentukan query berdasarkan pilihan
switch ($action) {
    case 'sum':
        $sql = "SELECT SUM(salary) AS total_salary FROM employees";
        break;
    case 'avg':
        $sql = "SELECT AVG(salary) AS average_salary FROM employees";
        break;
    case 'max':
        $sql = "SELECT MAX(salary) AS highest_salary FROM employees";
        break;
    case 'min':
        $sql = "SELECT MIN(salary) AS lowest_salary FROM employees";
        break;
    default:
        die("Pilihan tidak valid.");
}

// Menjalankan query
$result = $conn->query($sql);

// Menampilkan hasil agregat
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h3>Hasil Agregat:</h3>";

    if ($action == 'sum') {
        echo "Total Gaji: " . number_format($row['total_salary'], 2);
    } elseif ($action == 'avg') {
        echo "Rata-rata Gaji: " . number_format($row['average_salary'], 2);
    } elseif ($action == 'max') {
        echo "Gaji Tertinggi: " . number_format($row['highest_salary'], 2);
    } elseif ($action == 'min') {
        echo "Gaji Terendah: " . number_format($row['lowest_salary'], 2);
    }
} else {
    echo "Tidak ada data dalam tabel.";
}

// Menutup koneksi database
$conn->close();
?>
