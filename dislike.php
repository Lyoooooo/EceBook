<?php
include "fonction.php";
session_start();
$idu = $_SESSION["idu"];
// Récupérer l'identifiant du post  à partir des données POST
$postId = $_POST['postId'];

//Se connecter à la base de données
$pdo = connexion();

//Vérifier si le post est déja disliké 
$verif = $pdo->prepare("SELECT * FROM jaime WHERE idu = ? AND idp = ?");
$verif->execute(array($idu, $postId));
$verif = $verif->fetch();

$recup = $pdo->prepare("SELECT * FROM post WHERE idp = ?");
$recup->execute(array($postId));
$recup = $recup->fetch();
//si le post n'est pas disliké
if ($verif == false) {
    //Mettre à jour la base de données pour incrémenter le nombre de dislike pour le post 
    $totalDislikes = $recup["dislike"] + 1;
    $stmt = $pdo->prepare("UPDATE post SET dislike = ? WHERE idp = ?");
    $stmt->execute(array($totalDislikes, $postId));
    $req = $pdo->prepare("INSERT INTO jaime (idp,idu,ld) VALUES (?,?,2)");
    $req->execute(array($postId, $idu));
} else {
    //si le post est disliké 
    if($verif["ld"] == 1){
        $totalDislikes = $recup["dislike"] + 1;
        $like = $recup["likes"];
        $totalLikes = $like - 1;

        $stmt = $pdo->prepare("UPDATE jaime SET ld = 2 WHERE idp = ?");
        $stmt->execute(array($postId));

        $stmt2 = $pdo->prepare("UPDATE post SET dislike = ?, likes = ? WHERE idp = ?");
        $stmt2->execute(array($totalDislikes, $totalLikes, $postId));
        
    }else if($verif["ld"] == 2){
        $totalDislikes = $recup["dislike"] - 1; //enlève 1 au nombre de dislikes
        
        $req = $pdo->prepare("DELETE FROM jaime WHERE idu = ? AND idp = ?");
        $req->execute(array($idu, $postId));

        $stmt = $pdo->prepare("UPDATE post SET dislike = ? WHERE idp = ?");
        $stmt->execute(array($totalDislikes, $postId));
    }
}
