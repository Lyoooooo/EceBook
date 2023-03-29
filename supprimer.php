<?php
include "fonction.php";
session_start();
connecte();
// Vérifie si le bouton "supprimer" a été cliqué  
// Connexion à la base de données

try {
    $pdo = connexion();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idu = $_SESSION["idu"];


// Supprimer l'utilisateur
$req_user = "DELETE FROM user WHERE idu = :idu";
$statement_user = $pdo->prepare($req_user);
$statement_user->execute(array(':idu' => $idu));

// Supprimer ses posts
$req_user = "DELETE FROM post WHERE idu = :idu";
$statement_user = $pdo->prepare($req_user);
$statement_user->execute(array(':idu' => $idu));

// Supprimer ses amis
$req_user = "DELETE FROM ami WHERE idu1 = :idu";
$statement_user = $pdo->prepare($req_user);
$statement_user->execute(array(':idu' => $idu));
$req_user = "DELETE FROM ami WHERE idu2 = :idu";
$statement_user = $pdo->prepare($req_user);
$statement_user->execute(array(':idu' => $idu));

if ($_SESSION["idu"] == $idu) { //Si c'est l'utilisateur qui demande la suppression de son compte
    header("location:deconnexion.php");
}

?>
<script>
    window.history.back();
</script>