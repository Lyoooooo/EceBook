<?php
include "fonction.php";
include "fonctionRequete.php";
$pdo = connexion();
session_start();
if (connecte() == False) {
  header("location:index.php");
}

if ($_GET==null) {
  $idu = $_SESSION["idu"];
  $profil = "moi";
} else if ($_SESSION["idu"] == $_GET["u"]) {
  $idu = $_SESSION["idu"];
  $profil = "moi";
} else {
  $idu = $_GET["u"];
  $profil = "autre";
}

$idu=1;

$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?"); //récupère les informations du profil
$stmt->execute([$idu]);
$user = $stmt->fetch();

$res = $pdo->prepare("SELECT * FROM post WHERE idu=?"); //récupère les posts du profil
$res->execute([$idu]);
$tab = $res->fetchAll();

$res = $pdo->prepare("SELECT * FROM ami WHERE idu1=? AND valide=1"); //compte le nombre d'ami du profil
$res->execute([$idu]);
$ami = $res->fetchAll();

if ($profil = "autre") {
  $query = $pdo->prepare("SELECT * FROM ami WHERE idu1 = :idu AND idu2 = :ida");
  $query->bindParam(':idu', $_SESSION["idu"]);
  $query->bindParam(':ida', $idu);
  $query->execute();
  if ($query->rowCount() > 0) {
    $demande = TRUE;
  } else {
    $demande = FALSE;
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
//mainHeader()
?>

<body style="background-color: #f0dfd8;">
  <header class="col-7 mx-auto">
    <div class="bg-white shadow overflow-hidden rounded-top">
      <div class="px-5 pt-0 pb-4">
        <div class="profile-head border border-light">

          <?php if ($user["pp"] == 'vide') { ?>
            <img src="images/pp/pp.jpg" alt="..." width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
          <?php } else { ?>
            <img src="<?= $user["pp"] ?>" alt="Photo de @<?= $user["mail"] ?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
          <?php } ?>

          <div class="grid">
            <h4 class="mt-2 mb-2"><?= $user["pnom"] ?> <?= $user["nom"] ?></h4>
            <p class="small align-bottom mb-2"><?= $user["ville"] ?></p>
            <p class="small align-bottom"><?= $user["promo"] ?></p>
          </div>

          <div class="grid">
            <div class="ms-3 mt-2" style="color:royalblue; font-weight: 600;">@<?= $user["mail"] ?></div>
            <?php if ($user["grade"] == 1) { ?>
              <div class="ms-3 mt-2 text-center" style="font-weight: 600;">Etudiant</div>
            <?php } else if ($user["grade"] == 2) { ?>
              <div class="ms-3 mt-2 text-center" style="font-weight: 600;">Professeur</div>
            <?php } else if ($user["grade"] == 4) { ?>
              <div class="ms-3 mt-2 text-center" style="font-weight: 600;">Administrateur</div>
            <?php } ?>
          </div>

          <div class="grid">
            <?php if ($profil == "moi") { ?>
              <div class="ms-5 mt-2 mb-4"><a href="modifuser.php" class="btn btn-outline-dark btn-sm btn-block">Modifier profil</a></div>
              <div class="ms-5 mt-2 text-center"><a href="message.php" class="btn btn-outline-dark btn-sm btn-block">Messagerie</a></div>
            <?php } else if ($profil == "autre" && $demande == FALSE) { ?>
              <form method="POST" action="fonctionRequete.php">
                <input type="hidden" name="idu" value="<?=$_SESSION['idu']?>">
                <input type="hidden" name="ida" value="<?=$idu?>">
                <input type="hidden" name="page" value="profil.php">
                <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm btn-block ms-5 mt-2 mb-4">Ajouter en ami</button>
              </form>
              <div class="ms-5 mt-2 text-center"><a href="message.php" class="btn btn-outline-dark btn-sm btn-block ms-5 mt-2 mb-4">Messagerie</a></div>
            <?php } else { ?>
              <form method="POST" action="fonctionRequete.php">
                <input type="hidden" name="idu" value="<?=$_SESSION['idu']?>">
                <input type="hidden" name="ida" value="<?=$idu?>">
                <input type="hidden" name="page" value="profil.php">
                <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm btn-block ms-5 mt-2 mb-4">Retirer des amis</button>
              </form>
              <div class="ms-5 mt-2 text-center"><a href="message.php" class="btn btn-outline-dark btn-sm btn-block">Messagerie</a></div>
            <?php } ?>
          </div>

          <div class="grid ms-5 mt-2 d-flex justify-content-end text-center">
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <h5 class="font-weight-bold d-block"><?= count($tab) ?></h5>
                <small class="text-muted"><i class="fas fa-image mr-1"></i>Post(s)</small>
              </li>
              <li class="list-inline-item">
                <h5 class="font-weight-bold d-block"><?= count($ami) ?></h5>
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
        if (count($tab) > 0) {
          foreach ($tab as $post) { ?>
            <div class="row"> 
            <?= post($post); ?>
            </div> <?php
          }
        } else { ?>
      </div>
      <p style="font-weight: 500;font-size: 28px;text-align: center;color:#FF621F">Vous n'avez pas de post !!</p>
      <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="d-grid gap-2 col-4 mx-auto" style="color:#FF621F;border-radius:5px;padding:2px;font-weight: 500;font-size: 20px;padding:auto">
        Créez votre premier post ici
      </button>
      <?php
        ajoutpost();
        if (isset($_POST["bouton"])) {
          extract($_POST);
          extract($_FILES);
          if ($photo == "") {
            $photo = NULL;
          } else {
            $photo = ajoutphoto($idu, $photo);
          }
        $stmt = $pdo->prepare("INSERT INTO post VALUES(?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([null, $idu, $titre, $texte, $photo, $type, 0, 0, 0, date("Y-m-d H:i:s")]);
      ?>
      <meta http-equiv="refresh" content="1">
<?php   }
      } ?>
    </div>
  </main>
</body>
<?php
footer();
?>

</html>