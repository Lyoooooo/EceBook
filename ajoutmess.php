<?php
include "fonction.php";
session_start();
$pdo = connexion();
// $idp = $_GET["idp"];
$idreceveur = $_GET["idenvoyeur"];
$idu = $_SESSION["idu"];
// if($idp == 0){
    // $idreceveur = $idenvoyeur;
// }
//else{
//     $stmt = $pdo->prepare("SELECT * FROM produit WHERE idp=?");
//     $stmt->execute([$idp]);
//     $ligne = $stmt->fetch();
    // $idreceveur = $ligne["idu"];
// }
$mess = $_POST["mess"];
$stmt = $pdo->prepare("INSERT INTO messages VALUES (?,?,?,?,?)");
$stmt->execute([NULL,$idu,$idreceveur,date("Y-m-d H:i:s"),$mess]);
header("refresh:0;url=message.php?idenvoyeur=$idreceveur");
?>