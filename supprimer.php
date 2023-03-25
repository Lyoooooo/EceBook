<?php
include "fonction.php";
session_start();
// Vérifie si le bouton "supprimer" a été cliqué  
// Connexion à la base de données

try{
$pdo = connexion();
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
     
    $idu = $_GET["idu"];
    // Supprimer l'utilisateur
    $req_user = "DELETE FROM user WHERE idu = :idu";
    $statement_user = $pdo->prepare($req_user);
    $statement_user->execute(array(':idu'=>$idu));
            
    header('location:admin.php'); 
    
        
        

       
    
?>


