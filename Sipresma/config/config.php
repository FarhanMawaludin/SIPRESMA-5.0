<?php
$host = "LAPTOP-CACRPO0M\SQLEXPRESS";
$dbname = "PBLSIPRESMA";
$username = "";
$password = "";

try {
    $conn = new PDO("sqlsrv:Server=$host;Database=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    die();
}

?>