<?php
include "fonction.php";
include "fonctionRequete.php";

connecte(); //verrifie si la personne est connecté
$pdo = connexion();

if ($_GET == null) { //si la page ne reçoit rien = mon profil
  $idu = $_SESSION["idu"];
  $profil = "moi";
} else if ($_SESSION["idu"] == $_GET["u"]) { //si la page reçoit mon idu = mon profil
  $idu = $_SESSION["idu"];
  $profil = "moi";
} else { //sinon = profil de quelqu'un
  $idu = $_GET["u"];
  $profil = "autre";
}

$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?"); //récupère les informations du profil
$stmt->execute([$idu]);
$user = $stmt->fetch();

$res = $pdo->prepare("SELECT * FROM post WHERE idu=?"); //récupère les posts du profil
$res->execute([$idu]);
$nbrpost = $res->fetchAll();

$query = $pdo->prepare("SELECT * FROM ami WHERE (idu1=? OR idu2=?) AND valide=1"); //récupère les amis du profil
$query->execute([$idu,$idu]);
$nbrami = $query->fetchAll();

if ($profil == "autre") { //si on est sur le profil de quelqu'un d'autre
  $query = $pdo->prepare("SELECT * FROM ami WHERE (idu1 = :idu AND idu2 = :ida) OR (idu1 = :ida AND idu2 = :idu)"); //regarde si il y a une demande
  $query->bindParam(':idu', $_SESSION["idu"]);
  $query->bindParam(':ida', $idu);
  $query->execute();
  if ($query->rowCount() > 0) { //si il y a une demande d'ami
    $envoie = $query->fetch();
    $valide = $envoie["valide"]; //regarde si la demande est accepté ou non
    if ($envoie["idu1"] == $_SESSION["idu"] || $valide == 1) { //si c'est moi qui ai envoyé la demande
      $demande = 1;
    } else { //si c'est lui qui a demandé
      $demande = 2;
    }
  } else { //si il n'y a pas de demande d'ami
    $demande = 0;
    $valide = 0;
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <title>Profil</title>
</head>

<?php
mainHeader()
?>

<body style="background-color: #f0dfd8;">
  <header class="col-7 mx-auto">
    <div class="bg-white shadow overflow-hidden rounded-top">
    <br><br>
    <h3>Profil</h3>
      <div class="px-5 pt-0 pb-4">
        <div class="profile-head border border-light">

          <?php if ($user["pp"] == NULL) { //si il n'y a pas de pp dans la bdd ?> 
            <img src="images/pp/pp.jpg" alt="..." width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
          <?php } else { //si il y a une pp dans la bdd ?>
            <img src="<?= $user["pp"] ?>" alt="Photo de @<?= $user["mail"] ?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
          <?php } ?>

          <div class="grid">
            <h4 class="mt-2 mb-2"><?= $user["pnom"] ?> <?= $user["nom"] ?></h4>
            <p class="small align-bottom mb-2"><?= $user["ville"] ?></p>
            <p class="small align-bottom"><?= $user["promo"] ?></p>
          </div>

          <div class="grid">
            <div class="ms-3 mt-2" style="color:royalblue; font-weight: 600;">@<?= $user["mail"] ?></div>
            <?php if ($user["grade"] == 1) { //Etudiant ?>
              <div class="ms-3 mt-2 text-center" style="font-weight: 600;">Etudiant</div>
            <?php } else if ($user["grade"] == 2) { //Prof ?>
              <div class="ms-3 mt-2 text-center" style="font-weight: 600;">Professeur</div>
            <?php } else if ($user["grade"] == 4) { //Admin ?>
              <div class="ms-3 mt-2 text-center" style="font-weight: 600;">Administrateur</div>
            <?php } ?>
          </div>

          <div class="grid">
            <?php if ($profil == "moi") { //Affiche les boutons si c'est mon compte ?>

              <button class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4"><a href="modifuser.php">Modifier profil</a></button>
              <a href="message.php?idenvoyeur=<?= $_SESSION['idu'] ?>" style="text-decoration:none;"><button class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Messagerie</button></a>

             <?php } else if ($profil == "autre" && $demande == 2) { //Si c'est le compte de quelqu'un qui m'a envoyé une demande?>

               <form method="POST" action="fonctionRequete.php">
                 <input type="hidden" name="idu" value="<?= $_SESSION['idu'] ?>">
                 <input type="hidden" name="ida" value="<?= $idu ?>">
                 <input type="hidden" name="page" value="profil.php">
                 <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Accepter la demande d'ami</button>
               </form>
               <a href="message.php?idenvoyeur=<?= $_SESSION['idu'] ?>" style="text-decoration:none;"><button class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Messagerie</button></a>

            <?php } else if ($profil == "autre" && $demande == 0) { //Si c'est le compte de quelqu'un que j'ai pas en ami ?>

              <form method="POST" action="fonctionRequete.php">
                <input type="hidden" name="idu" value="<?= $_SESSION['idu'] ?>">
                <input type="hidden" name="ida" value="<?= $idu ?>">
                <input type="hidden" name="page" value="profil.php">
                <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Ajouter en ami</button>
              </form>
              <a href="message.php?idenvoyeur=<?= $_SESSION['idu'] ?>" style="text-decoration:none;"><button class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Messagerie</button></a>
              
              <?php } else if ($profil == "autre" && $demande == 1 && $valide == 0) { //Si j'ai envoyé une demande ?>

              <form method="POST" action="fonctionRequete.php">
                <input type="hidden" name="idu" value="<?= $_SESSION['idu'] ?>">
                <input type="hidden" name="ida" value="<?= $idu ?>">
                <input type="hidden" name="page" value="profil.php">
                <button type="submit" name="ami" value="retireami" class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Demande d'ami en attente... <br> (retirer ma demande)</button>
              </form>
              <a href="message.php?idenvoyeur=<?= $_SESSION['idu'] ?>" style="text-decoration:none;"><button class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Messagerie</button></a>

            <?php } else { //Si c'est le compte de quelqu'un que j'ai en ami  ?>

              <form method="POST" action="fonctionRequete.php">
                <input type="hidden" name="idu" value="<?= $_SESSION['idu'] ?>">
                <input type="hidden" name="ida" value="<?= $idu ?>">
                <input type="hidden" name="page" value="profil.php">
                <button type="submit" name="pami" value="retireami" class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Retirer des amis</button>
              </form>
              <a href="message.php?idenvoyeur=<?= $_SESSION['idu'] ?>" style="text-decoration:none;"><button class="btn btn-outline-dark btn-sm btn-block mx-3 mt-2 mb-4">Messagerie</button></a>
              
              <?php } ?>
          </div>

          <div class="grid ms-5 mt-2 d-flex justify-content-end text-center">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <h5 class="font-weight-bold d-block"><?= count($nbrpost) ?></h5>
                <small class="text-muted"><i class="fas fa-image mr-1"></i>Post(s)</small>
              </li>
              <li class="list-inline-item">
                <h5 class="font-weight-bold d-block"><?= count($nbrami) ?></h5>
                <small class="text-muted"><i class="fas fa-user mr-1"></i>Ami(s)</small>
              </li>
            </ul>
          </div>

        </div>
        <div class="p-5 m-2"></div>

        <h5 class="mb-4" style="color:#FF621F">A propos de moi</h5>
        <div class="p-3 border border-light">
          <p class="font-italic mb-2"><?php echo $user["descrip"] ?></p>
          <p class="font-italic mb-0"><span style="font-weight:600;">Centre d'intérêt :</span> <?php echo $user["interet"] ?></p>
        </div>
      </div>
    </div>
  </header>

  <main class="col-7 mx-auto">
    <div class="bg-white shadow overflow-hidden rounded-top pb-4">
      <h4 class="px-5 p-3 bg-white border-top border-warning" style="color:#FF621F">Posts</h4>
      <div class="container px-5 p-3">
      <?php
      if (($profil == "moi" || $valide == 1 || $_SESSION["grade"] == 4) && count($nbrpost) > 0) { //Soit c'est mon profil, ou d'un ami ou je suis un admin donc je vois les posts
          foreach ($nbrpost as $post) { ?>
            <div class="row">
              <?= post($post); ?>
            </div> <?php
          }
        } else if ($profil == "moi") { //Si c'est mon profil pour créer un post ?>
      </div>
      <p style="font-weight: 500;font-size: 28px;text-align: center;color:#FF621F">Vous n'avez pas de post !!</p>
      <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="d-grid gap-2 col-4 mx-auto" style="color:#FF621F;border-radius:5px;padding:2px;font-weight: 500;font-size: 20px;padding:auto">
        Créez votre premier post ici
      </button> <?php ajoutpost();
        } else if ($valide == 1) { //Si c'est un ami qui n'as pas de post ?>
          <p style="font-weight: 500;font-size: 28px;text-align: center;color:#FF621F"><?= $user["pnom"] ?> <?= $user["nom"] ?> a 0 post...</p> <?php
        } else { //Si ce n'est pas un ami ?>
          <p style="font-weight: 500;font-size: 28px;text-align: center;color:#FF621F">Vous ne pouvez pas voir les posts de <?= $user["pnom"] ?> <?= $user["nom"] ?> car vous n'êtes pas encore ami</p> <?php
        }
        ?>
    </div>
  </main>
</body><br>
<?php
footer();
?>

</html>