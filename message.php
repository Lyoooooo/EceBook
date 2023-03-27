<?php
include "fonction.php";
session_start();
mainHeader();
if (connecte() == False) {
  header("location:connexion.php");
}
$pdo = connexion();


// $idu = $_SESSION["idu"];
// $stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
// $stmt->execute([$idu]);
// $user = $stmt->fetch();

// $ami = $pdo->prepare("SELECT idu2 FROM ami WHERE idu1=[] AND valide=1");

// $ida = $_GET["ida"];
// if($ida == 0){
//     $idrec = $_GET["idenvoyeur"];
// }else{
//     $stmt = $pdo->prepare("SELECT * FROM produit WHERE idp=?");
//     $stmt->execute([$idp]);
//     $ligne = $stmt->fetch();
//     $idrec = $ligne["idu"];    
// }





// PHP de chat

$idu = $_SESSION["idu"];
$idreceveur = $_GET["idenvoyeur"];

$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
$stmt->execute([$idreceveur]);
$ligne3 = $stmt->fetch();

// $nomu = $_SESSION["nom"] . " " . $_SESSION["pnom"];
$nomr = $ligne3["nom"] . " " . $ligne3["pnom"];


$stmt = $pdo->prepare("SELECT DISTINCT idenvoyeur FROM messages WHERE idreceveur=?");
$stmt->execute([$idu]);
while ($ligne = $stmt->fetch()) {
    $idenvoyeur = $ligne["idenvoyeur"];
    if($idenvoyeur != $idu){
    $stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
    $stmt->execute([$idenvoyeur]);
    $ligne2 = $stmt->fetch();
    $nomsend = $ligne2["nom"];
    $pnomsend = $ligne2["pnom"];
    $stmt = $pdo->prepare("SELECT * FROM messages WHERE (idenvoyeur = ? AND idreceveur = ?) OR ( idreceveur = ? AND  idenvoyeur = ?) ORDER BY dates DESC");
    $stmt->execute([$idu, $idenvoyeur, $idenvoyeur, $idu]);
    $ligne3 = $stmt->fetch();
    $message = $ligne3["texte"];
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Messagerie</title>
</head>
<body>

<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-1">
        </div>

        <div class="col-10">
            <div id="mid">
                <div class="row">

                    <!-- Colonne des amis -->
                    <div id="separation" class="col-3">


                        <a href="message.php?idenvoyeur=<?php echo "$idenvoyeur" ?>" style="color: black;">
                            <?php echo "$nomsend $pnomsend" ?>
                            <br>
                        </a>
                    </div>


                    <!-- Colonne Messagerie -->
                    <div class="col-9">

                        <div class="body">
                            <section class="msger">
                                <header class="msger-header">
                                    <div class="msger-header-title">
                                        <?php echo "$nomsend $pnomsend" ?>
                                    </div>
                                </header>

                                <main class="msger-chat" id="messageBody">
                                    <?php
                                    $stmt = $pdo->prepare("SELECT * FROM messages WHERE (idenvoyeur = ? AND idreceveur = ?) OR (idenvoyeur = ? AND idreceveur = ?) ORDER BY dates ASC");
                                    $stmt->execute([$idu, $idreceveur, $idreceveur, $idu]);
                                    while ($ligne2 = $stmt->fetch()) {
                                        $time = $ligne2["dates"];
                                        $message = $ligne2["texte"];
                                        if ($ligne2["idreceveur"] == $idu) { ?>
                                            <div class="msg left-msg">

                                                <div class="msg-bubble">
                                                    <div class="msg-info">
                                                        <div class="msg-info-name"><?php echo "$nomr" ?></div>
                                                        <div class="msg-info-time"><?php echo "$time" ?></div>
                                                    </div>

                                                    <div class="msg-text" style="word-wrap: break-word;">
                                                        <?php echo "$message" ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="msg right-msg">


                                                <div class="msg-bubble">
                                                    <div class="msg-info">
                                                        <div class="msg-info-name"><?php echo "$nomu" ?></div>
                                                        <div class="msg-info-time"><?php echo "$time" ?></div>
                                                    </div>

                                                    <div class="msg-text" style="word-wrap: break-word;">
                                                        <?php echo "$message" ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                    <script>
                                        var messageBody = document.querySelector('#messageBody');
                                        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                                    </script>


                                </main>

                                <form method="post" class="msger-inputarea" action="ajoutmess.php?idsenvoyeur=<?php echo"$idreceveur"?>">
                                    <input type="text" class="msger-input" name="mess" placeholder="Entre ton message..." required>
                                    <button type="submit" class="msger-send-btn" name="Bouton">Envoyer</button>
                                </form>
                            </section>

                        </div>

                    </div>



                    
                </div>
            </div>
        </div>

        <div class="col-1">
        </div>

    </div>
</div><br><br>










    <?php
    footer();
    ?>

    
</body>
</html>