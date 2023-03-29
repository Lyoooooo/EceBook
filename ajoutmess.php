<?php
include "fonction.php";
session_start();
connecte();
$pdo = connexion();
$idreceveur = $_GET["idenvoyeur"];
$idu = $_SESSION["idu"];
$mess = $_POST["mess"];
$stmt = $pdo->prepare("INSERT INTO messages VALUES (?,?,?,?,?)");
$stmt->execute([NULL,$idu,$idreceveur,date("Y-m-d H:i:s"),$mess]);
header("refresh:0;url=message.php?idenvoyeur=$idreceveur");
?>