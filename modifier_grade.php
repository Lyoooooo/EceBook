<?php
include "fonction.php";
$pdo = connexion();
$mail = $_GET['mail'];
$grade = $_GET['grade'];;

$stmt = $pdo->prepare("UPDATE user SET grade = ? WHERE mail = ?");
$stmt->execute([$grade, $mail]);
header("Location: connexion.php");
