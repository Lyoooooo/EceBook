<?php
include "fonction.php";
session_start();
mainHeader();
if (connecte() == False) {
    header("location:connexion.php");
}
$pdo = connexion();


// PHP de chat
$idu = $_SESSION["idu"];
if (isset($_GET["idenvoyeur"])) {
    $idreceveur = $_GET["idenvoyeur"];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
    $stmt->execute([$idreceveur]);
    $ligne3 = $stmt->fetch();
    $nomr = $ligne3["nom"] . " " . $ligne3["pnom"];
}
$nomu = $_SESSION["nom"] . " " . $_SESSION["prenom"];

$ami = $pdo->prepare("SELECT * FROM ami WHERE idu1=? OR idu2=? AND valide=1");
$ami->execute([$idu, $idu]);
$listAmi = $ami->fetchAll();

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


<body style="background-color:#FFE2D6"><br>

<h3>Messagerie</h3><br>

    
    <div class="container">
        <div class="row">
            <div class="col-1">
            </div>

            <div class="col-10">
            <div class="boxe">

            
                <div id="mid">
                    <div class="row">

                        <!-- Colonne des amis -->
                        <div id="separation" class="col-3" style="overflow-y: scroll;scrollbar-width: thin; text-align: center"><br>
                            <div style="font-weight:bold; font-size: x-large">Vos amis :</div>
                        <br>
                        <hr>
                            <?php
                            $pdo = connexion();
                            if (count($listAmi) > 0) {
                                foreach ($listAmi as $friend) {
                                    if ($friend["idu1"] == $idu) {

                                        $contact = $pdo->prepare("SELECT * FROM user WHERE idu=?");
                                        $contact->execute([$friend["idu2"]]);
                                        $boug = $contact->fetch();
                                    } else {
                                        $contact = $pdo->prepare("SELECT * FROM user WHERE idu=?");
                                        $contact->execute([$friend["idu1"]]);
                                        $boug = $contact->fetch();
                                    }
                                    $nom = $boug["nom"];
                                    $pnom = $boug["pnom"];
                            ?>
                                    <div class="amiMessage">
                                        <a href="message.php?idenvoyeur=<?php echo $boug["idu"] ?>" style="color: black;">
                                            <?php echo ("$pnom $nom") ?>
                                            <br>
                                            <hr>
                                        </a>
                                    </div>
                                <?php }
                            } else {
                                ?> <div>
                                    Vous n'avez pas encore d'amis. N'hésitez pas à en ajouter pour discuter !
                                </div><?php
                                    } ?>
                        </div>


                        <!-- Colonne Messagerie -->
                        <div class="col-9">

                            <div class="body">
                                <?php if (isset($_GET["idenvoyeur"])) { ?>
                                <section class="msger">
                                    <header class="msger-header">
                                        <div class="msger-header-title">
                                            <?php echo "$nomr" ?>
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
                                                            <div class="msg-info-name"><?php echo $nomr ?></div>
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

                                    <form method="post" class="msger-inputarea" action="ajoutmess.php?idenvoyeur=<?php echo "$idreceveur" ?>">
                                        <input type="text" class="msger-input" name="mess" placeholder="Entre ton message..." required>
                                        <button type="submit" class="msger-send-btn" name="Bouton">Envoyer</button>
                                    </form>
                                </section>
                                <?php }else{
                                    ?>
                                    <div style="text-align:center; font-weight:bold; font-size: large">
                                        <img src="images/mess.png" alt="" width='150'>
                                        <br>
                                        Sélectionnez un ami pour commencer à discuter !
                                    </div>
                                <?php } ?>
                            </div>

                        </div>




                    </div>
                </div>
                </div> <!-- div central -->
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