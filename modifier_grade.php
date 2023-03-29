<?php
include "fonction.php";
$pdo = connexion();
// Connexion à la base de données

// Récupération des valeurs du formulaire
if (isset($_POST['mail']) && isset($_POST['statut'])) {
    $mail = $_POST['mail'];
    $statut = $_POST['statut'];

    // Définition du nouveau grade en fonction du statut
    if ($statut == "Elève") {
        $nouveau_grade = 1;
    } else if ($statut == "Professeur") {
        $nouveau_grade = 2;
    }

    // Exécution de la requête SQL
    $stmt = $pdo->prepare("UPDATE user SET grade = ? WHERE mail = ?");
    $stmt->execute([$nouveau_grade, $mail]);

    if ($stmt->rowCount() > 0) {
        echo "Grade mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du grade.";
    }
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}
