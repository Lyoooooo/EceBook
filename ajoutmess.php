<?php
include "fonction.php";
session_start();
$pdo = connexion();
// $idp = $_GET["idp"];
$idenvoyeur = $_GET["idenvoyeur"];
$idu = $_SESSION["idu"];
// if($idp == 0){
    // $idreceveur = $idenvoyeur;
// }
//else{
//     $stmt = $pdo->prepare("SELECT * FROM produit WHERE idp=?");
//     $stmt->execute([$idp]);
//     $ligne = $stmt->fetch();
    $idreceveur = $ligne["idu"];
// }
$mess = $_POST["texte"];
$stmt = $pdo->prepare("INSERT INTO messages VALUES (?,?,?,?,?)");
$stmt->execute([NULL,$idu,$idreceveur,$mess,date("Y-m-d H:i:s")]);
header("refresh:0;url=message.php?idenvoyeur=$idenvoyeur");
?>