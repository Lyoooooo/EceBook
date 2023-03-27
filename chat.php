<?php
include "fonction.php";
session_start();
$pdo = connexion();
if (connecte() == False) {
    header("refresh:0;url=connexion.php");
}
// $ida = $_GET["ida"];
// if($ida == 0){
//     $idreceveur = $_GET["idenvoyeur"];
// }else{
//     $stmt = $pdo->prepare("SELECT * FROM ami WHERE idu=idu1 OR idu=idu2 AND valide=1");
//     $stmt->execute([$idu1]);
//     $ligne = $stmt->fetch();
// }


// $ami = $pdo->prepare("SELECT idu2 FROM ami WHERE idu1=idu=? AND valide=1");


$idu = $_SESSION["idu"];
$idreceveur = $ligne["idu"];

$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
$stmt->execute([$idreceveur]);
$ligne3 = $stmt->fetch();

// $stmt2 = $pdo->prepare("SELECT * FROM user WHERE idreceveur=?");
// $nomsend = $ligne2["nom"];
// $pnomsend = $ligne2["pnom"];


$nomu = $_SESSION["nom"] . " " . $_SESSION["pnom"];
$nomr = $ligne3["nom"] . " " . $ligne3["pnom"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>

<body>
    <div class="body">
        <section class="msger">
            <header class="msger-header">
                <div class="msger-header-title">
                    <i class="fas fa-comment-alt"></i>Chat
                </div>
                <div class="msger-header-options">
                    <span><i class="fas fa-cog"></i></span>
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
</body>

</html>