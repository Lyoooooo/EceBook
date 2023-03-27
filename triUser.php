<?php
include "fonction.php";
session_start();


if (!empty($_POST["idd"])) {
    $pdo = connexion();
    $txt = $_POST["idd"];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE nom LIKE '%$txt%' OR texte LIKE '%$txt%' LIMIT 10");
    $stmt->execute();
}
$user = $stmt->fetchAll();

    if (count($posts) > 0) {
        foreach ($posts as $post) {
            post($post);
        }
    } else {?>
        <div style="background-color: red; height: 40px;">Erreur, aucun post trouvé</div>

        <?php
    }

?>