<?php
include "fonction.php";

connecte();
$pdo = connexion();

$idu = $_SESSION["idu"];
$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
$stmt->execute([$idu]);
$user = $stmt->fetch();

if (isset($_POST["modif"])) {
    extract($_POST);
    $sql = "UPDATE user SET nom=?, pnom=?, naissance=?, promo=?, ville=?, descrip=?, interet=? WHERE idu=?";
    $pdo->prepare($sql)->execute([$nom, $pnom, $naissance, $promo, $ville, $descrip, $interet, $idu]);
    header("location:index.php");
}
mainHeader();
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

<body style="background-color:#f0dfd8">
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1">
            </div>

            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10">
                <div class="modif">


                    <div id="mid"><br>
                        <h3>Modifier Profil</h3><br>

                        <div class=text-end>
                            <form action="" method="post">
                        </div>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">reset</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">valider</button>
                                    </div>
                                </div>
                            </div>
                        </div><br>


                        <div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-4" id="legende">
                                        <label id="pn" for="validationDefault01" class="form-label">Nom</label><span class="etoile">*</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="nom" class="form-control" value="<?= $user["nom"] ?>" required>
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
                                        <input type="text" name="pnom" class="form-control" value="<?= $user["pnom"] ?>" required>
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
                                        <input type="date" name="naissance" class="form-control" value="<?= $user["naissance"] ?>" required>
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
                                            <input type="text" name="mail" class="form-control" aria-describedby="inputGroupPrepend2" value="<?= $user["mail"] ?>" disabled required>
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
                                        <label for="classe"></label><br>
                                        <input type="radio" name="promo" value="ING1" id="ING1" checked>ING1 &nbsp;
                                        <input type="radio" name="promo" value="ING2" id="ING2">ING2 &nbsp;
                                        <input type="radio" name="promo" value="ING3" id="ING3">ING3 &nbsp;
                                        <input type="radio" name="promo" value="ING4" id="ING4">ING4 &nbsp;
                                        <input type="radio" name="promo" value="ING5" id="ING5">ING5 &nbsp;
                                        <input type="radio" name="promo" value="B1" id="B1">B1 &nbsp;
                                        <input type="radio" name="promo" value="B2" id="B2">B2 &nbsp;
                                        <input type="radio" name="promo" value="B3" id="B3">B3 &nbsp;
                                        <br>
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
                                        <input type="text" name="ville" class="form-control" value="<?= $user["ville"] ?>">
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
                                        <input type="text" name="descrip" class="form-control" value="<?= $user["descrip"] ?>">
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
                                        <input type="text" name="interet" class="form-control" value="<?= $user["interet"] ?>">
                                    </div>
                                    <div class="col-2">
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        
                        <div class="d-grid gap-2 col-5 mx-auto m-5">
                            <input class="btn btn-success text-center" type="submit" value="Valider" name="modif">
                        </div>

                        <div class="d-grid gap-2 col-5 mx-auto m-3">
                            <button type="button" class="btn btn-warning" name="bouton2"><a href="modifmdp.php" style="text-decoration:none;color:white">Modifier mon mot de passe</a></button>
                        </div>

                        <div class="d-grid gap-2 col-5 mx-auto m-5">
                            <button type="button" class="btn btn-danger"><a href="supprimer.php" style="text-decoration:none;color:white">Supprimer mon compte</a></button>
                        </div>
                    </div>
                </div>
            </div><!-- col-8 etc...-->
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1">
            </div>

        </div> <!-- row -->
    </div><br><br><!-- container -->

    <?php
    footer();
    ?>

    <body>

</html>