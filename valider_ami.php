<?php
include "fonctionRequete.php";
try {
    $pdo = new PDO('mysql:dbname=ecebook;host=127.0.0.1', 'root', '');
    $pdo->exec("SET CHARACTER SET utf8mb4");
} catch (PDOException $e) {
    $pdo = new PDO('mysql:dbname=ecebook;host=127.0.0.1;port=3307', 'root', '');
    $pdo->exec("SET CHARACTER SET utf8mb4");
}
$idu = $_GET['idu'];
$ida = $_GET['ida'];;
ajoutami($ida, $idu, "index.php");
// header("Location: index.php");
