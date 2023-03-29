<?php
include "fonction.php";
$pdo = connexion();
if (isset($_POST["bouton"])) {
    extract($_POST);
    $mdp2 = encode($mdp, $mail);
    $stmt = $pdo->prepare("SELECT * FROM user WHERE mail=? AND mdp=?");
    $stmt->execute([$mail, $mdp2]);
    $ligne = $stmt->fetch();
    if ($ligne) {
        session_start();
        $_SESSION["idu"] = $ligne["idu"];
        $_SESSION["nom"] = $ligne["nom"];
        $_SESSION["prenom"] = $ligne["pnom"];
        $_SESSION["grade"] = $ligne["grade"];
        $_SESSION["statut"] = $ligne["statut"];
        header("location:index.php");
    } else {
        $erreur = "❕ Mail ou mot de passe incorrect !";
    }
}

echo encode("mdp", "louise.lambert@edu.ece.fr")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/e_now_logo2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: white;">
    <?php if (isset($erreur)) : ?>
        <div class="alert alert-danger d-flex align-items-center">

            <?php echo $erreur ?>
        </div>
        <script>
            setTimeout(function() {
                document.querySelector('.alert').remove();
            }, 4000);
        </script>
    <?php endif; ?>
    <div class="row g-3 position-absolute top-50 start-50 translate-middle rounded shadow text-center" id="primal">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled" id="insc1-tab" data-bs-toggle="tab" data-bs-target="#insc1-tab-pane" type="button" role="tab" aria-controls="insc1-tab-pane" aria-selected="true"></button>
            </li>

        </ul>
        <div class="tab-pane fade show active" id="insc1-tab-pane" role="tabpanel" aria-labelledby="insc1-tab" tabindex="0">
            <div class="h1">
                <h1>Formulaire de connexion</h1>
            </div>
            <hr>
            <div class="container">
                <form action="" method="post">
                    <label for="validationDefault01" class="form-label">Entrez votre adresse mail</label> <span class="etoile">*</span><br>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        <input type="email" name="mail" class="form-control" id="mail" aria-describedby="inputGroupPrepend2" placeholder="Adresse mail" required>
                    </div><br>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Entrez votre mot de passe</label><span class="etoile">*</span>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2"> <svg fill="none" viewBox="0 0 24 24" height="20" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                                    <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22"></path>
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
                                    <path fill="#141B34" d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z"></path>
                                </svg></span>
                            <input type="password" class="form-control" id="exampleInputPassword1" id="mdp" name="mdp" placeholder="Mot de passe" required>
                        </div>
                    </div>

                    <!-- <input type="email" name="mail" style="width:250px" placeholder="Entrez votre mail:" required>
                    <input type="password" style="width:250px" name="mdp" placeholder="Entrez votre mot de passe: " required> <br><br>-->
                    <input type="reset" class="btn btn-primary" value="ANNULER">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-primary" value="ENVOYER" name="bouton"> <br>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" style="color: #ff621f;" href="inscription.php">Pas de compte? Inscrivez vous</a>
                <a class="dropdown-item" style="color: #ff621f;" href="#">Mot de passe oublié?</a>
            </div>
            <!-- <div class='text-start'>
                Pas de compte?<a href="inscription.php" class="btn btn-primary p-2 m-2" style="text-decoration:none">S'INSCRIRE</a>
            </div> -->
        </div>
    </div>
    </div>

</body>

</html>