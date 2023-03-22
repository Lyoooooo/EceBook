<?php
include "fonction.php";
session_start();
// if (connecte() == False) {
//   header("location:index.php");
// }
$pdo = connexion();
// $idu = $_SESSION["idu"];
$idu = 1;
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <title>Profil</title>
</head>

<?php
mainHeader()
?>

<body style="background-color: #FFE2D6;">
  <header class="col-8 mx-auto">
    <div class="bg-white shadow overflow-hidden rounded-top">
      <div class="px-5 pt-0 pb-4">

        <div class="profile-head border border-light">
            <img src="<?=$user["pp"]?>" alt="Photo de @<?=$user["mail"]?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
            <div class="grid">
              <h4 class="mt-2 mb-2"><?=$user["pnom"]?> <?=$user["nom"]?></h4>
              <p class="small align-bottom mb-2"><?=$user["ville"]?></p> 
              <p class="small align-bottom"><?=$user["promo"]?></p>
            </div>
            <div class="grid">
              <div class="grid ms-3 mt-2" style="color:royalblue; font-weight: 600;">@<?=$user["mail"]?></div>
              <div class="grid ms-3 mt-2 text-center" style="font-weight: 600;"><?=$user["grade"]?></div>
            </div>
            <div class="grid">
              <div class="grid ms-5 mt-2 mb-4"><a href="modifuser.php" class="btn btn-outline-dark btn-sm btn-block">Modifier profil</a></div>
              <div class="grid ms-5 mt-2 text-center"><a href="messagerie.php" class="btn btn-outline-dark btn-sm btn-block">Messagerie</a></div>
            </div>
            <div class="grid ms-5 mt-2 d-flex justify-content-end text-center">
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <h5 class="font-weight-bold d-block"><?=count($tab)?></h5>
                  <small class="text-muted"><i class="fas fa-image mr-1"></i>Post(s)</small>
                </li>
                <li class="list-inline-item">
                  <h5 class="font-weight-bold d-block"><?=count($ami)?></h5>
                  <small class="text-muted"><i class="fas fa-user mr-1"></i>Ami(s)</small>
                </li>
              </ul>
            </div>
        </div>

        <div class="p-5 m-2"></div>

        <h5 class="mb-4">A propos de moi</h5>
        <div class="p-3 border border-light">
          <p class="font-italic mb-2"><?php echo $user["descrip"] ?></p>
          <p class="font-italic mb-0"><span style="font-weight:600;">Centre d'intérêt :</span> <?php echo $user["interet"] ?></p>
        </div>
      </div>
    </div>
  </header>

  <h4 class="col-8 mx-auto px-5 p-3 bg-white border-top border-warning">Posts</h4>

  <main class="col-8 mx-auto bg-white">

<?php
  if (count($tab) > 0) {
    // Value exists in database
} else {
?> 
  
<?php
}
?>
  <div class="container" style="width: 80%;">
      <div class="row">
        <?php foreach ($tab as $prod) { ?>
          <div class="col-4">
            <div id="annonce">
              <div class="card" style="height: 25rem;">
                <div style="width: 100%; height: 100%; overflow: hidden;">
                  <img src="<?php echo $prod["photo1"] ?>" height="50%" class="d-block w-5" style="margin:auto">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $prod["nomp"] ?></h5><br>
                    <h5 class="card-title"><?php echo $prod["prix"] ?>€</h5><br>
                    <a href="detailprod.php?idp=<?php echo $prod["idp"] ?>" class="btn btn-primary">
                      <img src="image/voir.png" width="20">Voir l'annonce</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>



  <body>
    <?php
    footer();
    ?>

</html>