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
    <link rel="icon" href="images/e_now_logo2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="securite.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>

<body style="background-color: white;">
    <form action="inscription2.php" method="post" enctype="multipart/form-data" onsubmit="convertToLowercase()"> <!--quand le bouton qui envois les données du formulaire est cliqué alors on nous redirige vers inscription2.php , on appel la fonction convertolowercase qui fait simplement en sorte que tout les mails rentré sois en minuscule meme si rentré en majuscule -->
        <div class="tab">
            <div class="row g-3 position-absolute top-50 start-50 translate-middle rounded shadow text-center " id="primal">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active disabled" id="insc1-tab" data-bs-toggle="tab" data-bs-target="#insc1-tab-pane" type="button" role="tab" aria-controls="insc1-tab-pane" aria-selected="true">Etape 1</button>

                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link disabled" id="insc2-tab" data-bs-toggle="tab" data-bs-target="#insc2-tab-pane" type="button" role="tab" aria-controls="insc2-tab-pane" aria-selected="false">Etape 2</button>
                    </li><!-- tab1-->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link disabled" id="insc3-tab" data-bs-toggle="tab" data-bs-target="#insc3-tab-pane" type="button" role="tab" aria-controls="insc3-tab-pane" aria-selected="false">Etape 3</button>
                    </li><!--tab2 -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link disabled" id="insc4-tab" data-bs-toggle="tab" data-bs-target="#insc4-tab-pane" type="button" role="tab" aria-controls="insc4-tab-pane" aria-selected="false">Etape finale</button>
                    </li><!-- tab3-->
                </ul>
                <div class="tab-content" id="myTabContent">

                    <!-- tab 1 -->

                    <div class="tab-pane fade show active" id="insc1-tab-pane" role="tabpanel" aria-labelledby="insc1-tab" tabindex="0">
                        <div class="text-end">
                            <a href="connexion.php" class="text-end" style="text-decoration: none; color: #ff621f;">Retour</a> <!--lien de retour a la connexion -->
                        </div>
                        <h1>Inscription</h1>
                        <label for="validationDefault01" class="form-label">Entrez votre adresse mail </label> <span class="etoile"> *</span><br> <!-- champs pour rentré le mail ece/omnesintervenant-->
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                            <input type="email" name="mail" class="form-control" id="mail" aria-describedby="inputGroupPrepend2" placeholder="Adresse mail" required>
                        </div>

                        <p id="email-error" style="display: none; color: red;">Adresse email invalide <br> Veuillez entrer une adresse e-mail valide de la forme prenom.non@edu.ece.fr/omnesintervenant.com</p> <!--affichage d'un message d'erreur si le mot de passe n est pas dans de la forme souhaité -->


                        <script>
                            //script pour indique le type de mail que l'on souhaite 
                            const emailInput = document.querySelector("#mail");
                            const submitButton = document.querySelector("input[type='submit']");
                            const emailError = document.querySelector("#email-error");

                            emailInput.addEventListener("input", () => {
                                const email = emailInput.value.trim();
                                const isValidEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email);
                                const isAllowedDomain = /.*@(edu\.ece\.fr|omnesintervenant\.com)$/.test(email); //on indique que l on accepte que les mails finissant pas @edu.ece.fr ou @omnesintervant.com

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
                            <label for="exampleInputPassword1" class="form-label">Entrez votre mot de passe </label><span class="etoile"> *</span> <!--champs pour rentré le mot de passe -->
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2"> <svg fill="none" viewBox="0 0 24 24" height="20" width="15" xmlns="http://www.w3.org/2000/svg" class="icon"> <!-- appel de l icon cadena-->
                                        <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22"></path>
                                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
                                        <path fill="#141B34" d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z"></path>
                                    </svg></span>

                                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
                            </div>
                            <p id="password-error" style="display: none; color: red;">Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial</p> <!--meme message d'erreur que pour le mail tant que le mdp ne rentre pas dans les criteres indiqué -->

                            <script>
                                const passwordInput = document.querySelector("#mdp");
                                const submitButton2 = document.querySelector("input[type='submit']");
                                const passwordError = document.querySelector("#password-error");

                                passwordInput.addEventListener("input", () => {
                                    const password = passwordInput.value.trim();
                                    const isValidPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&€])[A-Za-z\d@$!%*?&€]{8,}$/.test(password); //ici on indique que le mdp doit contenir 8 caracteres ou plus, une majuscule, une minuscule, un chiffre et un caractere special parmis @$!%*?&€ 

                                    if (!isValidPassword) {
                                        passwordError.style.display = "block";
                                        submitButton2.disabled = true;
                                    } else {
                                        passwordError.style.display = "none";
                                        submitButton2.disabled = false;
                                    }
                                });
                            </script>

                        </div>

                        <input type="button" class="btn btn-primary mb-3" value="Suivant" onclick="pageSuivante()"> <!--permet de passe a la tab2 -->

                        <script>
                            var ongletActif = document.querySelector('.nav-link.active');
                            if (ongletActif) {
                                ongletActif.style.backgroundColor = "#ff621f";
                                ongletActif.style.color = "#fff";
                            }

                            var onglets = document.querySelectorAll('.nav-link:not(.active)');
                            onglets.forEach(function(onglet) {
                                onglet.style.backgroundColor = "#fff";
                                onglet.style.color = "#000";
                            });

                            function pageSuivante() { //permet de passe a la tab suivante en activant la tab2 et en desactivant la tab1
                                document.getElementById('insc1-tab').classList.remove('active');
                                document.getElementById('insc2-tab').classList.add('active');
                                document.getElementById('insc1-tab-pane').classList.remove('show', 'active');
                                document.getElementById('insc2-tab-pane').classList.add('show', 'active');

                                // Changer la couleur de fond de l'onglet actif
                                var ongletActif = document.querySelector('.nav-link.active');
                                if (ongletActif) {
                                    ongletActif.style.backgroundColor = "#ff621f";
                                    ongletActif.style.color = "#fff";
                                }

                                // Changer la couleur de fond et le texte des autres onglets
                                var onglets = document.querySelectorAll('.nav-link:not(.active)');
                                onglets.forEach(function(onglet) {
                                    onglet.style.backgroundColor = "#fff";
                                    onglet.style.color = "#000";
                                });
                            }

                            function pageSuivante2() { //permet de passe a la tab suivante en activant la tab2 et en desactivant la tab3
                                document.getElementById('insc2-tab').classList.remove('active');
                                document.getElementById('insc3-tab').classList.add('active');
                                document.getElementById('insc2-tab-pane').classList.remove('show', 'active');
                                document.getElementById('insc3-tab-pane').classList.add('show', 'active');


                                var ongletActif = document.querySelector('.nav-link.active');
                                if (ongletActif) {
                                    ongletActif.style.backgroundColor = "#ff621f";
                                    ongletActif.style.color = "#fff";
                                }

                                var onglets = document.querySelectorAll('.nav-link:not(.active)');
                                onglets.forEach(function(onglet) {
                                    onglet.style.backgroundColor = "#fff";
                                    onglet.style.color = "#000";
                                });
                            }

                            function pageRetour1() { //permet de retourne a la tab precedente en activant la tab1 et en desactivant la tab2
                                document.getElementById('insc2-tab').classList.remove('active');
                                document.getElementById('insc1-tab').classList.add('active');
                                document.getElementById('insc2-tab-pane').classList.remove('show', 'active');
                                document.getElementById('insc1-tab-pane').classList.add('show', 'active');


                                var ongletActif = document.querySelector('.nav-link.active');
                                if (ongletActif) {
                                    ongletActif.style.backgroundColor = "#ff621f";
                                    ongletActif.style.color = "#fff";
                                }

                                var onglets = document.querySelectorAll('.nav-link:not(.active)');
                                onglets.forEach(function(onglet) {
                                    onglet.style.backgroundColor = "#fff";
                                    onglet.style.color = "#000";
                                });
                            }

                            function pageSuivante4() { //permet de passe a la tab suivante en activant la tab4 et en desactivant la tab3
                                document.getElementById('insc3-tab').classList.remove('active');
                                document.getElementById('insc4-tab').classList.add('active');
                                document.getElementById('insc3-tab-pane').classList.remove('show', 'active');
                                document.getElementById('insc4-tab-pane').classList.add('show', 'active');


                                var ongletActif = document.querySelector('.nav-link.active');
                                if (ongletActif) {
                                    ongletActif.style.backgroundColor = "#ff621f";
                                    ongletActif.style.color = "#fff";
                                }

                                var onglets = document.querySelectorAll('.nav-link:not(.active)');
                                onglets.forEach(function(onglet) {
                                    onglet.style.backgroundColor = "#fff";
                                    onglet.style.color = "#000";
                                });
                            }

                            function pageRetour2() { //permet de retourne a la tab precedente en activant la tab2 et en desactivant la tab3

                                document.getElementById('insc3-tab').classList.remove('active');
                                document.getElementById('insc2-tab').classList.add('active');
                                document.getElementById('insc3-tab-pane').classList.remove('show', 'active');
                                document.getElementById('insc2-tab-pane').classList.add('show', 'active');

                                var ongletActif = document.querySelector('.nav-link.active');
                                if (ongletActif) {
                                    ongletActif.style.backgroundColor = "#ff621f";
                                    ongletActif.style.color = "#fff";
                                }

                                var onglets = document.querySelectorAll('.nav-link:not(.active)');
                                onglets.forEach(function(onglet) {
                                    onglet.style.backgroundColor = "#fff";
                                    onglet.style.color = "#000";
                                });
                            }
                        </script>
                    </div>

                    <!-- tab 2 -->

                    <div class="tab-pane fade " id="insc2-tab-pane" role="tabpanel" aria-labelledby="insc2-tab" tabindex="0">
                        <div class="text-start">
                            <label for="validationDefault01" class="form-label">Nom</label> <span class="etoile">*</span><br> <!-- permet de rentré le champ nom -->
                            <input type="text" class="form-control" id="name" name="nom" required placeholder="Nom"><br>
                            <label for="validationDefault01" class="form-label">Prenom</label> <span class="etoile">*</span><br><!-- permet de rentré le champ prenom -->
                            <input type="text" class="form-control" id="prenom" name="prenom" required placeholder="Prenom"><br>
                            <label for="validationDefault01" class="form-label">Selectionnez votre date de naissance</label> <span class="etoile">*</span><br> <!-- permet de rentré le champ date de naissance-->
                            <input type="date" class="form-control" name="naissance" id="naissance" required><br>
                            <label for="validationDefault01" class="form-label">Rentrez votre ville de residence</label><br><!-- permet de rentré le champ ville de residence -->
                            <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville de résidence"><br>
                            <label for="validationDefault02" class="form-label">Vous etes un :</label><span class="etoile"> *</span><br><!--demande a l utilisateur si il est prof ou eleve -->

                        </div>
                        <input class="form-check-input" type="radio" name="statut" id="eleve" value="Elève" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Elève
                        </label>&nbsp;
                        <input class="form-check-input" type="radio" name="statut" id="professeur" value="Professeur">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Professeur
                        </label> <br><br>

                        <div id="classe-selection"> <!-- affiche une liste deroulante des classes possible -->
                            <label for="classe" required>Selectionnez votre classe</label></label><span class="etoile"> *</span><br>
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
                            <label for="classe" required>Selectionné votre/vos classe(s) si vous en avez</label></label><span class="etoile"> *</span><br><!-- affiche des check box de toute les promos, possibilite d'en selectionné une, plusieure ou aucune -->
                            <input type="checkbox" name="promo[]" value="ING1" id="ING1">ING1 &nbsp;
                            <input type="checkbox" name="promo[]" value="ING2" id="ING2">ING2 &nbsp;
                            <input type="checkbox" name="promo[]" value="ING3" id="ING3">ING3 &nbsp;
                            <input type="checkbox" name="promo[]" value="ING4" id="ING4">ING4 &nbsp;
                            <input type="checkbox" name="promo[]" value="ING5" id="ING5">ING5 &nbsp; <br>
                            <input type="checkbox" name="promo[]" value="B1" id="B1">B1 &nbsp;
                            <input type="checkbox" name="promo[]" value="B2" id="B2">B2 &nbsp;
                            <input type="checkbox" name="promo[]" value="B3" id="B3">B3 &nbsp;
                            <br><br>
                        </div>
                        <br>
                        <input type="button" class="btn btn-primary mb-3" value="Précendent" name="précedent" onclick="pageRetour1()"><!-- permet de retourné a la tab 1 -->
                        <input type="button" class="btn btn-primary mb-3" value="Suivant" name="suivant" onclick="pageSuivante2()"><!-- permet de passé a la tab3 -->

                        <script>
                            //script permetant de ne faire apparaitre que la liste si le bouton eleve est clique et que les checks box si le bouton prof est selectioné
                            const professeurRadio = document.getElementById('professeur');
                            const eleveRadio = document.getElementById('eleve');
                            const classeSelection = document.getElementById('classe-selection');
                            const matieresSelection = document.getElementById('promo-prof');

                            eleveRadio.addEventListener('change', () => {
                                classeSelection.style.display = 'block';
                                matieresSelection.style.display = 'none';
                            });

                            professeurRadio.addEventListener('change', () => {
                                classeSelection.style.display = 'none';
                                matieresSelection.style.display = 'block';
                            });
                        </script>
                    </div>
                    <!-- tab 3 -->
                    <div class="tab-pane fade " id="insc3-tab-pane" role="tabpanel" aria-labelledby="insc3-tab" tabindex="0">
                        <div class="text-start">
                            <div class="mb-3"><br>
                                <label for="exampleFormControlTextarea1" class="form-label">Rentrez votre descritpion</label> <br> <!-- permet de rentré le champ descriptio-->
                                <textarea class="form-control" name="descrip" id="descrip" placeholder="Votre description :" maxlength="255" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Rentrez vos centres d'interets</label> <br><!-- permet de rentré le champ centre d'interet-->
                                <textarea class="form-control" name="interet" id="interet" placeholder="Vos centres d'interets:" maxlength="255" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Chargez votre photo de profil</label><!-- permet de rentré une photo de profil d'un format imposé -->
                                <input class="form-control" type="file" id="pp" name="pp" accept=".png, .jpg, .jpeg .webp">
                            </div>
                            <br>
                        </div>
                        <input type="button" class="btn btn-primary mb-3 " value="Précendent" name="précedent" onclick="pageRetour2()"> <!-- permet de retourné a la tab2 -->
                        <input type="submit" class="btn btn-primary mb-3" value="Suivant" name="valide" onclick="envoyerMail()"><!-- permet de validé l'inscription et d'envoyer un mail de confirmation -->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST["valide"])) {
        extract($_POST);
        extract($_FILES);
        $promo = implode(',', $promo);

        if ($_FILES['pp']['name'] == "" || $_FILES['pp']['error'] == 4 || $_FILES['pp']['error'] == 1) {  //si la photo de profil met une erreur ou n est pas a la bonne taille la photo rentre nul 
            $pp = NULL;
        } else {
            $pp = ajoutpp($nom, $pp);
        }

        if ($ville == "") { //permet au champs ville d'etre nul si vide
            $ville = NULL;
        }
        if ($descrip == "") { //permet au champs description d'etre nul si vide
            $descrip = NULL;
        }
        if ($interet == "") { //permet au champs centre d'interet d'etre nul si vide
            $interet = NULL;
        }

        $mdp2 = encode($mdp, $mail); //fonction de hashage du mot de passe pour pas qu'il apparaisse en claire dans la bdd
        $stmt = $pdo->prepare("SELECT mail FROM user WHERE mail=?");
        $stmt->execute([$mail]);
        $user = $stmt->fetch();
        $sql = "INSERT INTO user VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $pdo->prepare($sql)->execute([null, $nom, $prenom, 0, $mail, $mdp2, $naissance, $statut, $promo, $pp, $ville, $descrip, $interet]); //ajoute a la bdd les valeurs dans l'ordre donnée
    }

    ?>
</body>

</html>