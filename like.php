<?php
include "fonction.php";
session_start();
$idu = $_SESSION["idu"];
// Récupérer l'identifiant du post  à partir des données POST
$postId = $_POST['postId'];

//Se connecter à la base de données
$pdo = connexion();

//Vérifier si le post est déja liké 
$verif = $pdo->prepare("SELECT * FROM jaime WHERE idu = ? AND idp = ?");
$verif->execute(array($idu, $postId));
$verif = $verif->fetch();

$recup = $pdo->prepare("SELECT * FROM post WHERE idp = ?");
$recup->execute(array($postId));
$recup = $recup->fetch();
//si le post n'est pas liké
if ($verif == false) {
    //Mettre à jour la base de données pour incrémenter le nombre de like pour le post 
    $totalLikes = $recup["likes"] + 1;
    $stmt = $pdo->prepare("UPDATE post SET likes = ? WHERE idp = ?");
    $stmt->execute(array($totalLikes, $postId));
    $req = $pdo->prepare("INSERT INTO jaime (idp,idu,ld) VALUES (?,?,2)");
    $req->execute(array($postId, $idu));
} else {
    //si le post est liké
    if($verif["ld"] == 2){
        $totalLikes = $recup["likes"] + 1;
        $dislike = $recup["dislike"];
        $totalDislikes = $dislike - 1;

        $stmt = $pdo->prepare("UPDATE jaime SET ld = 1 WHERE idp = ?");
        $stmt->execute(array($postId));

        $stmt2 = $pdo->prepare("UPDATE post SET likes = ?, dislike = ? WHERE idp = ?");
        $stmt2->execute(array($totalLikes, $totalDislikes, $postId));
        
    }else if($verif["ld"] == 1){
        $totalLikes = $recup["likes"] - 1; //enlève 1 au nombre de likes
        
        $req = $pdo->prepare("DELETE FROM jaime WHERE idu = ? AND idp = ?");
        $req->execute(array($idu, $postId));

        $stmt = $pdo->prepare("UPDATE post SET likes = ? WHERE idp = ?");
        $stmt->execute(array($totalLikes, $postId));
    }
}
