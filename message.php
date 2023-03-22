<?php
include "fonction.php";
session_start();
mainHeader();
if (connecte() == False) {
  header("location:connexion.php");
}
$pdo = connexion();
$idu = $_SESSION["idu"];
$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
$stmt->execute([$idu]);
$user = $stmt->fetch();

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
                    <div id="separation" class="col-3">Liste AMIS</div>
                    <div class="col-9">MESSAGERIE</div>
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