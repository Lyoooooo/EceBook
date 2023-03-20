<?php
include "fonction.php";
$pdo = connexion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
    <title>Incription</title>
</head>

<body id="second">
    <form action="" method="post">

        <div class="row g-3 position-absolute top-50 start-50 translate-middle rounded shadow text-center" id="primal">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="insc1-tab" data-bs-toggle="tab" data-bs-target="#insc1-tab-pane" type="button" role="tab" aria-controls="insc1-tab-pane" aria-selected="true"></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="insc2-tab" data-bs-toggle="tab" data-bs-target="#insc2-tab-pane" type="button" role="tab" aria-controls="insc2-tab-pane" aria-selected="false"></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="insc3-tab" data-bs-toggle="tab" data-bs-target="#insc3-tab-pane" type="button" role="tab" aria-controls="insc3-tab-pane" aria-selected="false"></button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- page 1 -->

                <div class="tab-pane fade show active" id="insc1-tab-pane" role="tabpanel" aria-labelledby="insc1-tab" tabindex="0">
                    <input type="email" id="email" name="email" placeholder="Adresse mail" required><span class="etoile">*</span><br><br>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required><span class="etoile">*</span><br><br>
                    <!-- <button type="button" data-bs-toggle="tab" data-bs-target="#insc2-tab-pane">Suivant</button> -->
                    <!-- <input type="submit" class="btn btn-primary" onclick="document.getElementById('insc1-tab').classList.remove('active'); document.getElementById('insc2-tab').classList.add('active'); document.getElementById('insc1-tab-pane').classList.remove('show', 'active'); document.getElementById('insc2-tab-pane').classList.add('show', 'active');" value="Suivant"> -->


                    <!-- <button class="btn btn-primary" type="button" onclick="document.getElementById('insc1-tab').classList.remove('active'); document.getElementById('insc2-tab').classList.add('active'); document.getElementById('insc1-tab-pane').classList.remove('show', 'active'); document.getElementById('insc2-tab-pane').classList.add('show', 'active');">Suivant</button> -->
                    <input type="submit" class="btn btn-primary" value="Suivant" onclick="document.getElementById('insc1-tab').classList.remove('active'); document.getElementById('insc2-tab').classList.add('active'); document.getElementById('insc1-tab-pane').classList.remove('show', 'active'); document.getElementById('insc2-tab-pane').classList.add('show', 'active');">

                </div>

                <!-- page 2 -->

                <div class="tab-pane fade" id="insc2-tab-pane" role="tabpanel" aria-labelledby="insc2-tab" tabindex="0">
                    <input type="text" id="name" name="nom" required placeholder="nom"><span class="etoile">*</span><br>
                    <input type="text" id="prenom" name="prenom" required placeholder="prenom"><span class="etoile">*</span><br>
                    <input type="date" name="naissance" id="naissance" required>selectionné votre date de naissance <span class="etoile">*</span><br>
                    <input type="text" name="ville" id="ville" required placeholder="Ville de résidence"><span class="etoile">*</span><br>
                    <label for="classe">Classe: </label><br>
                    <input type="checkbox" name="ING1" id="ING1">ING1 &nbsp;
                    <input type="checkbox" name="ING2" id="ING2">ING2 &nbsp;
                    <input type="checkbox" name="ING3" id="ING3">ING3 &nbsp;
                    <input type="checkbox" name="ING4" id="ING4">ING4 &nbsp;
                    <input type="checkbox" name="ING5" id="ING5">ING5 &nbsp;
                    <input type="checkbox" name="B1" id="B1">B1 &nbsp;
                    <input type="checkbox" name="B2" id="B2">B2 &nbsp;
                    <input type="checkbox" name="B3" id="B3">B3 &nbsp;
                    <br>

                    <input type="text" name="description" id="description" required placeholder="Entré une descritpion de vous:" minlength="25" maxlength="255"><span class="etoile">*</span><br>
                    <input type="text" name="interet" id="interet" required placeholder="Vos centre d'interet" minlength="25" maxlength="255"><span class="etoile">*</span><br>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Chargé votre photo de profil</label> <span class="etoile">*</span>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <br>
                    <!-- <input type="submit" class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#insc3-tab-pane" value="Suivant"> -->
                    <!-- <button class="btn btn-primary" type="button" data-bs-toggle="tab" data-bs-target="#insc3-tab-pane">Suivant</button> <br> -->

                    <button class="btn btn-primary" type="button" onclick="document.getElementById('insc2-tab').classList.remove('active'); document.getElementById('insc3-tab').classList.add('active'); document.getElementById('insc2-tab-pane').classList.remove('show', 'active'); document.getElementById('insc3-tab-pane').classList.add('show', 'active');">Suivant</button>

                </div>

                <!-- page 3 -->

                <div class="tab-pane fade" id="insc3-tab-pane" role="tabpanel" aria-labelledby="insc3-tab" tabindex="0">
                    <p>Veuillez vérifier votre boîte de réception pour compléter votre inscription.</p>
                    <button type="button" class="btn btn-primary"><a href="connexion.php">connexion</a></button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>