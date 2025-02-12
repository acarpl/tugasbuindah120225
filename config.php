<?php
$servername = "localhost";
$username = "root"; // Gunakan admin_user jika ingin batasan
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $action = $_POST["action"];
    $privilege = $_POST["privilege"];

    if ($action == "grant") {
        $sql = "GRANT $privilege ON user_management.* TO '$user'@'localhost'";
    } elseif ($action == "revoke") {
        $sql = "REVOKE $privilege ON user_management.* FROM '$user'@'localhost'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Akses berhasil diperbarui untuk $user";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
