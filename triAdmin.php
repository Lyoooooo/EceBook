<?php
include "fonction.php";
session_start();
// if (connecte() == False) {
//   header("location:index.php");
// }
// $idu = $_SESSION["idu"];

if (!empty($_POST["idd"])) {
    $pdo = connexion();
    if($_POST["idd"] == "date"){
        $stmt = $pdo->prepare("SELECT * FROM post ORDER BY date desc LIMIT 10");
        $stmt->execute();
    }else if($_POST["idd"] == "fav"){
        $stmt = $pdo->prepare("SELECT * FROM post ORDER BY likes desc LIMIT 10");
        $stmt->execute();
    }else if($_POST["idd"] == "actu"){
        $stmt = $pdo->prepare("SELECT * FROM post WHERE type=? ORDER BY likes desc LIMIT 10");
        $stmt->execute(["Actualité"]);
    }else if($_POST["idd"] == "event"){
        $stmt = $pdo->prepare("SELECT * FROM post WHERE type=? ORDER BY likes desc LIMIT 10");
        $stmt->execute(["Evènement"]);
    }else{
        $txt = $_POST["idd"];
        $stmt = $pdo->prepare("SELECT * FROM post WHERE titre LIKE '%$txt%' OR texte LIKE '%$txt%' LIMIT 10");
        
        //$stmt->bindParam(1, $txt);
        //$stmt->bindParam(2, $_POST["idd"]);
        
        $stmt->execute();
    }
    $posts = $stmt->fetchAll();
?>
    <?php
    if (count($posts) > 0) {
        foreach ($posts as $post) {
            post($post);
        }
    } else { ?>
        <div style="background-color: red; height: 40px;">Erreur, aucun post trouvé</div>
<?php
    }
}
?>