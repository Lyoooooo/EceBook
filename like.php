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
//si le post n'est pas liké
if($verif == false) 
{
    //Mettre à jour la base de données pour incrémenter le nombre de like pour le post 
    $recup = $pdo->prepare("SELECT * FROM post WHERE idp = ?");
    $recup->execute(array($postId));
    $recup = $recup->fetch();
    $totalLikes = $recup["likes"] + 1;
    if($recup["dislike"]==0)
    {
        $totalDislikes = 0;
    }else{
        $totalDislikes = $recup["dislike"]-1;
    }
    $stmt = $pdo->prepare("UPDATE post SET likes = ?, dislike = ? WHERE idp = ?");
    $stmt->execute(array($totalLikes, $totalDislikes, $postId));
    $req = $pdo->prepare("INSERT INTO jaime (idp,idu, ld) VALUES (?,?, 1)"); //insérer dans favoris l'id de l'annonce et celui de l'utilisateur
    $req->execute(array($postId, $idu));
}else{
    //si le post est liké
    $recup = $pdo->prepare("SELECT * FROM post WHERE idp = ?");
    $recup->execute(array($postId));
    $recup = $recup->fetch();
    $totalLikes = $recup["likes"] - 1; //enlève 1 au nombre de likes 
    $req = $pdo->prepare("UPDATE post SET likes = ? WHERE idp = ?");
    $req->execute(array($totalLikes, $postId));
    $req = $pdo->prepare("DELETE FROM jaime WHERE idu = ? AND idp = ?"); //supprime l'annonce de la table favoris dans la bdd
    $req->execute(array($idu, $postId));
}

