<!-- <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="securite.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>poubelle</title>
</head>

<body id="second">
    <form action="" method="post">

        page 1

        <div class="tab-pane fade show active" id="insc1-tab-pane" role="tabpanel" aria-labelledby="insc1-tab" tabindex="0">

            <h1>Inscription</h1>
            <label for="validationDefault01" class="form-label">Entrez votre adresse mail</label> <span class="etoile">*</span><br>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="email" name="mail" class="form-control" id="mail" aria-describedby="inputGroupPrepend2" placeholder="Adresse mail" required>
            </div>
            <p id="email-error" style="display: none; color: red;">Adresse email invalide <br> Veuillez entrer une adresse e-mail valide de la forme prenom.non@edu.ece.fr/omnesintervenant.com</p>

            <script>
                const emailInput = document.querySelector("#mail");
                const submitButton = document.querySelector("input[type='submit']");
                const emailError = document.querySelector("#email-error");

                emailInput.addEventListener("input", () => {
                    const email = emailInput.value.trim();
                    const isValidEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email);
                    const isAllowedDomain = /.*@(edu\.ece\.fr|omnesintervenant\.com)$/.test(email);

                    if (!isValidEmail || !isAllowedDomain) {
                        emailError.style.display = "block";
                        submitButton.disabled = true;
                    } else {
                        emailError.style.display = "none";
                        submitButton.disabled = false;
                    }
                });
            </script>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Entrez votre mot de passe</label><span class="etoile">*</span>
                <input type="password" class="form-control" id="exampleInputPassword1" id="mdp" name="mdp" placeholder="Mot de passe" required>
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Suivant" name="val">
            <input type="submit" class="btn btn-primary mb-3" value="Suivant" onclick="document.getElementById('insc1-tab').classList.remove('active'); document.getElementById('insc2-tab').classList.add('active'); document.getElementById('insc1-tab-pane').classList.remove('show', 'active'); document.getElementById('insc2-tab-pane').classList.add('show', 'active');">

        </div>
        <?php
        // if (isset($_POST["val"])) {
        // extract($_POST);
        // }
        ?>
        </div>
    </form>
</body>

</html> -->













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
    <script src="securite.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Poubelle</title>
</head>

<body id="second">
    <form action="" method="post" onsubmit="convertToLowercase()">

        <div class="row g-3 position-absolute top-50 start-50 translate-middle rounded shadow text-center " id="primal">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link disabled" id="insc1-tab" data-bs-toggle="tab" data-bs-target="#insc1-tab-pane" type="button" role="tab" aria-controls="insc1-tab-pane" aria-selected="true"></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link disabled" id="insc2-tab" data-bs-toggle="tab" data-bs-target="#insc2-tab-pane" type="button" role="tab" aria-controls="insc2-tab-pane" aria-selected="false"></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link disabled" id="insc3-tab" data-bs-toggle="tab" data-bs-target="#insc3-tab-pane" type="button" role="tab" aria-controls="insc3-tab-pane" aria-selected="false"></button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- page 1 -->

                <div class="tab-pane fade show active" id="insc1-tab-pane" role="tabpanel" aria-labelledby="insc1-tab" tabindex="0">

                    <h1>Inscription</h1>
                    <label for="validationDefault01" class="form-label">Entrez votre adresse mail</label> <span class="etoile">*</span><br>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        <input type="email" name="mail" class="form-control" id="mail" aria-describedby="inputGroupPrepend2" placeholder="Adresse mail" required>
                    </div>

                    <p id="email-error" style="display: none; color: red;">Adresse email invalide <br> Veuillez entrer une adresse e-mail valide de la forme prenom.non@edu.ece.fr/omnesintervenant.com</p>


                    <!-- <script>
                        const emailInput = document.querySelector("#mail");
                        const submitButton = document.querySelector("input[type='submit']");
                        const emailError = document.querySelector("#email-error");

                        emailInput.addEventListener("input", () => {
                            const email = emailInput.value.trim();
                            const isValidEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email);
                            const isAllowedDomain = /.*@(edu\.ece\.fr|omnesintervenant\.com)$/.test(email);

                            if (!isValidEmail || !isAllowedDomain) {
                                emailError.style.display = "block";
                                submitButton.disabled = true;
                            } else {
                                emailError.style.display = "none";
                                submitButton.disabled = false;
                            }
                        });
                    </script> -->
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Entrez votre mot de passe</label><span class="etoile">*</span>
                        <input type="password" class="form-control" id="exampleInputPassword1" id="mdp" name="mdp" placeholder="Mot de passe" required>
                    </div>

                    <!-- <input type="submit" class="btn btn-primary mb-3" value="Suivant" name="val"> -->
                    <input type="submit" class="btn btn-primary mb-3" value="Suivant" onclick="document.getElementById('insc1-tab').classList.remove('active'); document.getElementById('insc2-tab').classList.add('active'); document.getElementById('insc1-tab-pane').classList.remove('show', 'active'); document.getElementById('insc2-tab-pane').classList.add('show', 'active');">

                </div>
                <!-- supprimer sinon pas de tab2  -->

                <!-- page 2 -->

                <div class="tab-pane fade " id="insc2-tab-pane" role="tabpanel" aria-labelledby="insc2-tab" tabindex="0">
                    <div class="text-start">
                        <!-- <label for="validationDefault01" class="form-label">Nom</label> <span class="etoile">*</span><br>
                        <input type="text" class="form-control" id="name" name="nom" required placeholder="Nom"><br>
                        <label for="validationDefault01" class="form-label">Prenom</label> <span class="etoile">*</span><br>
                        <input type="text" class="form-control" id="prenom" name="prenom" required placeholder="Prenom"><br>
                        <label for="validationDefault01" class="form-label">Selectionné votre date de naissance</label> <span class="etoile">*</span><br>
                        <input type="date" class="form-control" name="naissance" id="naissance" required><br>
                        <label for="validationDefault01" class="form-label">Rentré votre ville de residence</label> <span class="etoile">*</span><br>
                        <input type="text" class="form-control" name="ville" id="ville" required placeholder="Ville de résidence"><br> -->
                        <!-- <label for="classe">Rentré votre classe: </label><br> -->
                        <label for="validationDefault02" class="form-label">Vous etes un :</label><span class="etoile"> *</span><br>

                    </div>
                    <input class="form-check-input" type="radio" name="Poste" id="eleve" value="Elève" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Elève
                    </label>&nbsp;
                    <input class="form-check-input" type="radio" name="Poste" id="professeur" value="Professeur">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Professeur
                    </label> <br><br>

                    <div id="classe-selection">
                        <label for="classe" required>Selectionné votre classe</label></label><span class="etoile"> *</span><br>
                        <select name="promo[]" id="classe">
                            <option name="promo[]" value="ING1">ING1</option>
                            <option name="promo[]" value="ING2">ING2</option>
                            <option name="promo[]" value="ING3">ING3</option>
                            <option name="promo[]" value="ING4">ING4</option>
                            <option name="promo[]" value="ING5">ING5</option>
                            <option name="promo[]" value="B1">B1</option>
                            <option name="promo[]" value="B2">B2</option>
                            <option name="promo[]" value="B3">B3</option>
                        </select>
                    </div>

                    <div id="promo-prof" style="display: none;">
                        <label for="classe" required>Selectionné votre/vos classe(s) si vous en avez</label></label><span class="etoile"> *</span><br>
                        <input type="checkbox" name="promo[]" value="ING1" id="ING1">ING1 &nbsp;
                        <input type="checkbox" name="promo[]" value="ING2" id="ING2">ING2 &nbsp;
                        <input type="checkbox" name="promo[]" value="ING3" id="ING3">ING3 &nbsp;
                        <input type="checkbox" name="promo[]" value="ING4" id="ING4">ING4 &nbsp;
                        <input type="checkbox" name="promo[]" value="ING5" id="ING5">ING5 &nbsp;
                        <input type="checkbox" name="promo[]" value="B1" id="B1">B1 &nbsp;
                        <input type="checkbox" name="promo[]" value="B2" id="B2">B2 &nbsp;
                        <input type="checkbox" name="promo[]" value="B3" id="B3">B3 &nbsp;
                        <br><br>
                    </div>

                    <script>
                        // Récupération des éléments DOM
                        const professeurRadio = document.getElementById('professeur');
                        const eleveRadio = document.getElementById('eleve');
                        const classeSelection = document.getElementById('classe-selection');
                        const matieresSelection = document.getElementById('promo-prof');

                        // Gestion de l'affichage des éléments en fonction du choix de l'utilisateur
                        eleveRadio.addEventListener('change', () => {
                            classeSelection.style.display = 'block';
                            matieresSelection.style.display = 'none';
                        });

                        professeurRadio.addEventListener('change', () => {
                            classeSelection.style.display = 'none';
                            matieresSelection.style.display = 'block';
                        });
                    </script>

                    <div class="text-start">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Rentré votre descritpion</label> <span class="etoile">*</span><br>
                            <textarea class="form-control" name="descrip" id="descrip" required placeholder="Entré une descritpion de vous:" minlength="25" maxlength="255" rows="2"></textarea>
                        </div>
                        <!-- <label for="validationDefault01" class="form-label">Rentré votre descritpion</label> <span class="etoile">*</span><br>
                    <input type="text" name="descrip" id="descrip" required placeholder="Entré une descritpion de vous:" minlength="25" maxlength="255"><br> -->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Rentré vos centres d'interets</label> <span class="etoile">*</span><br>
                            <textarea class="form-control" name="interet" id="interet" required placeholder="Vos centres d'interets:" minlength="25" maxlength="255" rows="2"></textarea>
                        </div>
                        <!-- <label for="validationDefault01" class="form-label">Rentré vos centres d'interets</label> <span class="etoile">*</span><br>
                    <input type="text" name="interet" id="interet" required placeholder="Vos centres d'interets" minlength="25" maxlength="255"><br> -->
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Chargé votre photo de profil</label> <span class="etoile">*</span>
                            <input class="form-control" type="file" id="pp" name="pp">
                        </div>
                        <br>
                    </div>
                    <!-- <input type="submit" class="btn btn-primary mb-3" value="Suivant" name="valide" onclick="document.getElementById('insc2-tab').classList.remove('active'); document.getElementById('insc3-tab').classList.add('active'); document.getElementById('insc2-tab-pane').classList.remove('show', 'active'); document.getElementById('insc3-tab-pane').classList.add('show', 'active');"> -->

                    <button class="btn btn-primary mb-3" type="submit" value='suivant' name="valide">Valider l'inscription</button>
                </div>

                <!-- page 3 -->

                <div class="tab-pane fade" id="insc3-tab-pane" role="tabpanel" aria-labelledby="insc3-tab" tabindex="0">
                    <p>Veuillez vérifier votre boîte de réception pour compléter votre inscription.</p>
                    <button type="button" class="btn btn-primary mb-3"><a href="connexion.php" style="color: white;text-decoration: none;">Connexion</a></button>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST["valide"])) {
        extract($_POST);
        $promo = implode(',', $promo);
        // $ext = strtolower(substr(strrchr($_FILES['pp']['name'], '.'), 1));
        // if (($_FILES['pp']['size'] < 20971520) && (in_array($ext, $extensions))) {
        //     $pp = 'produit/' . $_SESSION["idu"] . '-' . $nomp . '.' . $ext;
        //     move_uploaded_file($_FILES['pp']['tmp_name'], $pp);
        // }
        $mdp2 = encode($mdp, $mail);
        // echo $nom, " ", $prenom, " ",  $mail, " ", $mdp2, " ", $naissance, " ", $promo, " ", $pp, " ", $ville, " ", $descrip, " ", $interet;
        echo $mail, " ", $mdp2, " ", $promo, " ", $pp, " ", $descrip, " ", $interet;
        // if ($mdp == $mdp) {
        //     $stmt = $pdo->prepare("SELECT mail FROM user WHERE mail=?");
        //     $stmt->execute([$mail]);
        //     $user = $stmt->fetch();
        //     if ($user) {
        //         // echo "Cette adresse mail est déjà utilisée";
        //     } else {
        //         $sql = "INSERT INTO user VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        //         $pdo->prepare($sql)->execute([null, $nom, $prenom, 0, $mail, $mdp2, $naissance, $promo, $pp, $ville, $descrip, $interet]);
        //     }
        //     exit();
        // }
        // else echo "Le mot de passe est incorect ";
    }

    ?>
</body>

</html>