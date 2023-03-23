<?php
include "fonction.php";
session_start();
// if (connecte() == False) {
//   header("location:index.php");
// }
$pdo = connexion();
// $idu = $_SESSION["idu"];
$idu = 2;
$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
$stmt->execute([$idu]);
$user = $stmt->fetch();

$res = $pdo->prepare("SELECT * FROM post WHERE idu=?");
$res->execute([$idu]);
$tab = $res->fetchAll();

$res = $pdo->prepare("SELECT * FROM ami WHERE idu1=? AND valide=1");
$res->execute([$idu]);
$ami = $res->fetchAll();
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
// mainHeader()
?>

<body style="background-color: #f0dfd8;">
  <header class="col-7 mx-auto">
    <div class="bg-white shadow overflow-hidden rounded-top">
      <div class="px-5 pt-0 pb-4">

        <div class="profile-head border border-light">
          <img src="<?= $user["pp"] ?>" alt="Photo de @<?= $user["mail"] ?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
          <div class="grid">
            <h4 class="mt-2 mb-2"><?= $user["pnom"] ?> <?= $user["nom"] ?></h4>
            <p class="small align-bottom mb-2"><?= $user["ville"] ?></p>
            <p class="small align-bottom"><?= $user["promo"] ?></p>
          </div>
          <div class="grid">
            <div class="ms-3 mt-2" style="color:royalblue; font-weight: 600;">@<?= $user["mail"] ?></div>
            <div class="ms-3 mt-2 text-center" style="font-weight: 600;"><?= $user["grade"] ?></div>
          </div>
          <div class="grid">
            <div class="ms-5 mt-2 mb-4"><a href="modifuser.php" class="btn btn-outline-dark btn-sm btn-block">Modifier profil</a></div>
            <div class="ms-5 mt-2 text-center"><a href="messagerie.php" class="btn btn-outline-dark btn-sm btn-block">Messagerie</a></div>
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

  <main class="col-7 mx-auto bg-white pb-5">
    <h4 class="px-5 p-3 bg-white border-top border-warning" style="color:#FF621F">Posts</h4>
    <div class="container px-5 p-3">
      <div class="row">
        <?php
        if (count($tab) > 0) {
          foreach ($tab as $post) {
            post($post);
          }
        } else {
        ?></div>
    </div>
    <p style="font-weight: 500;font-size: 28px;text-align: center;color:#FF621F">Vous n'avez pas de post !!</p>
    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:#FF621F;border-radius:5px;padding:2px;font-weight: 500;font-size: 20px;margin-left:23rem">
      Créez votre premier post ici
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="titre" required>
                <label for="floatingInput">Titre<span class="etoile">*</span> </label>
              </div>

              <div class="form-floating">
                <textarea class="form-control" id="floatingTextarea2" name="texte" style="height: 100px" required></textarea>
                <label for="floatingTextarea2">Texte<span class="etoile">*</span></label>
              </div><br>

              <h8>Type de post</h8><span class="etoile">*</span>
              <select class="form-select" aria-label="Default select example" name="type" required>
                <option value="Général">Général</option>
                <option value="Actualité">Actualité</option>
                <option value="Evènement">Evènement</option>
              </select><br>

              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Photo</label>
                <input class="form-control" name="photo" type="file" id="formFile" accept=".png, .jpg, .jpeg .webp" required><br>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" name="bouton">Poster</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php
          if (isset($_POST["bouton"])) {
            extract($_POST);
            extract($_FILES);
            $pdo = connexion();
            if ($photo == "") {
              $photo = "vide";
            } else {
              $photo = ajoutphoto($idu, $photo);
            }
            $stmt = $pdo->prepare("INSERT INTO post VALUES(?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([null, $idu, $titre, $texte, $photo, $type, 0, 0, 0, date("Y-m-d H:i:s")]);
    ?>
      <meta http-equiv="refresh" content="1">
  <?php
        die();  
        }
        }
  ?>
  </main>

</body>
<?php
footer();
?>

</html>