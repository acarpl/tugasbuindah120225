<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function & Stored Procedure</title>
    <style>
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Rata-Rata Gaji dan Karyawan dengan Gaji Lebih dari Batas</h2>

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

// Menggunakan Function avg_salary
$sql_avg_salary = "SELECT avg_salary() AS avg_salary";
$result_avg = $conn->query($sql_avg_salary);

if ($result_avg->num_rows > 0) {
    $row = $result_avg->fetch_assoc();
    echo "<p style='text-align:center;'>Rata-rata Gaji Karyawan: " . number_format($row['avg_salary'], 2) . "</p>";
}

// Menggunakan Stored Procedure get_employees_by_salary
$salary_limit = 5000; // Batas gaji
$sql_sp = "CALL get_employees_by_salary($salary_limit)";
$result_sp = $conn->query($sql_sp);

if ($result_sp->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nama</th><th>Gaji</th></tr>";
    while ($row = $result_sp->fetch_assoc()) {
        echo "<tr><td>" . $row['name'] . "</td><td>" . number_format($row['salary'], 2) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Tidak ada karyawan dengan gaji lebih dari $salary_limit.</p>";
}

// Menutup koneksi
$conn->close();
?>

</body>
</html>
