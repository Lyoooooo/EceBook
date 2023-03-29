<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="securite.js"></script>
    <script> src="https://smtpjs.com/v3/smtp.js%22%3E"</script>
</head>
<body>
    
</body>
</html>

<?php
include "fonctionRequete.php";
session_start();
try {
    $pdo = new PDO('mysql:dbname=ecebook;host=127.0.0.1', 'root', '');
    $pdo->exec("SET CHARACTER SET utf8mb4");
  } catch (PDOException $e) {
    $pdo = new PDO('mysql:dbname=ecebook;host=127.0.0.1;port=3307', 'root', '');
    $pdo->exec("SET CHARACTER SET utf8mb4");
  }

  include "fonction.php";
mainHeader();
if(isset($_POST["ok"])){
   

    if(isset($_POST) && !empty($_POST)){
      
      $stmt = $pdo->prepare('SELECT * FROM user WHERE (pnom LIKE :pnom OR nom LIKE :nom) AND idu!= :user_id ORDER BY nom ASC');
      $stmt->bindValue(':pnom', '%' . $_POST['search'] . '%');
      $stmt->bindValue(':nom', '%' . $_POST['search'] . '%');      
      $stmt->bindValue(':user_id', $_SESSION['idu']);
      $stmt->execute();
      $result = $stmt->fetchAll();
  


    ?> <h2 class="text-center"style="color:#FF621F;">Recherche</h2>

<?php 
if(count($result) > 0){
    foreach($result as $ligne){
        if($ligne['idu'] !== $_SESSION['idu']){
            $friend_id = $ligne['idu'];
            $stmt = $pdo->prepare('SELECT * FROM ami WHERE (idu1 = :user_id AND idu2= :friend_id) OR (idu1 = :friend_id AND idu2= :user_id) AND valide=1');
            $stmt->bindValue(':user_id', $_SESSION['idu']);
            $stmt->bindValue(':friend_id', $friend_id);
            $stmt->execute();
            $is_friend = $stmt->fetch();
?>

<br>

<div class="container" style="max-width: 800px; margin: 0 auto; border: 1px solid #FF621F;">
    <div class="profile" style="display: flex; align-items: center;">
        <div class="profile-img">
            <?php if ($ligne["pp"] == NULL) { ?>
                <a href="profil.php?u=<?= $ligne["idu"]?>">
                    <img src="images/pp/pp.jpg" alt="..." width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
                </a>
            <?php } else { ?>
                <img src="<?= $ligne["pp"] ?>" alt="Photo de @<?= $ligne["mail"] ?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
            <?php } ?>
        </div>
        <div class='card-body'>
            <p class="mt-2 mb-2"><?= $ligne["pnom"] ?> <?= $ligne["nom"] ?> </p> 
            <form method="POST" action="" class="ms-auto">
                <?php if(!$is_friend ){ ?>
                    <input type="hidden" id="nom" value="<?= $ligne['nom'] ?>">
                    <input type="hidden" id="prenom" value="<?= $ligne['pnom'] ?>">
                    <input type="hidden" id="mailu" value="<?= $ligne['mail'] ?>">
                    <input type="hidden" name="idu" id="idu" value="<?= $_SESSION['idu'] ?>">
                    <input type="hidden" name="ida" id="ida" value="<?= $friend_id ?>">
                    <input type="hidden" name="page" value="index.php">
                    <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm ms-5 mt-2 mb-4" onclick="mailAmi()">Ajouter en ami </button>
                <?php } else {?>
                    <p>Vous êtes ami!</p>
                <?php } ?>
            </form>                    
        </div>
    </div>
</div>
<br><br>

<?php 
        } 
    }
} else {
    echo "Aucun resultat";
}
    }
}
?>

        </div>
        
        <?= footer();?>
      