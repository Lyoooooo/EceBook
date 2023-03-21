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

if (isset($_POST["bouton"])) {
  extract($_POST);
  $sql = "UPDATE user SET nom=?, pnom=?, mdp=?, naissance=?, promo=?, ville=?, descrip=?, interet=? WHERE idu=?";
  $pdo->prepare($sql)->execute([$nom, $pnom, $mdp, $naissance, $promo, $ville, $descrip, $interet, $idu]);
  header("location:index.php");
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
  <title>Modification de mon profil</title>
</head>

<body>
<br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1">
            </div>

            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div id="mid"><br>
                <h3>Modifier Profil</h3><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault01" class="form-label">Nom</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="pnom" class="form-control" id="second" value="<?= $user["nom"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault02" class="form-label">Prénom</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                            <input type="text" name="nom" class="form-control" id="second" value="<?= $user["pnom"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault02" class="form-label">Mot de Passe</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="mdp" class="form-control" id="second" value="<?= $user["mdp"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault02" class="form-label">Date de naissance</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="naissance" class="form-control" id="second" value="<?= $user["naissance"] ?>"required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefaultUsername" class="form-label">Adresse mail</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                    <input type="text" name="mail" class="form-control" id="second" aria-describedby="inputGroupPrepend2" value="<?= $user["mail"] ?>" disabled required>
                                </div>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault04" class="form-label">Promo</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="promo" class="form-control" id="second" value="<?= $user["promo"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="6" class="form-label">Ville</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="ville" class="form-control" id="second" value="<?= $user["ville"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault04" class="form-label">Description</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="descrip" class="form-control" id="second" value="<?= $user["descrip"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-4" id="legende">
                                <label id="pn" for="validationDefault05" class="form-label">Interet</label><span class="etoile">*</span>
                            </div>
                            <div class="col-6">
                                <input type="text" name="interet" class="form-control" id="second" value="<?= $user["interet"] ?>" required>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                </div><br>


                <div>  
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-warning" name="bouton2" style="margin-left:15%"><a href="modifmdp.php" style="text-decoration:none">Modifier mon mot de passe</a></button><br><br>
                            </div>
                            <div class="col-3">
                            </div>
                        </div>
                    </div>
                </div><br>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <input class="btn btn-success text-center" type="submit" value="Modifier" name="bouton"><br><br>
                </div>

                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1">
            </div>

        </div>
    </div><br><br>
  <?php
  footer();
  ?>

  <body>

</html>