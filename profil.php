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
  <header class="col-md-8 mx-auto">
    <div class="bg-white shadow overflow-hidden">
      <div class="px-5 pt-0 pb-4">

        <div class="profile-head border border-light">
          <div class="d-flex">
            <img src="<?php echo $user["pp"] ?>" alt="Photo de @<?php echo $user["mail"] ?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">
            <div class="grid">
              <h4 class="mt-2 mb-2"><?php echo $user["pnom"] ?> <?php echo $user["nom"] ?></h4>
              <p class="small align-bottom mb-2"><?php echo $user["ville"] ?></p>
              <p class="small align-bottom"><?php echo $user["promo"] ?></p>
            </div>
            <div class="grid ms-3 mt-2" style="color:royalblue; font-weight: 600;">@<?php echo $user["mail"] ?></div>
            <div class="grid">
              <div class="grid ms-5 mt-2 mb-4"><a href="modifuser.php" class="btn btn-outline-dark btn-sm btn-block">Modifier profil</a></div>
              <div class="grid ms-5 mt-2 text-center"><a href="messagerie.php" class="btn btn-outline-dark btn-sm btn-block">Messagerie</a></div>
            </div>
            <div class="grid ms-5 mt-2 d-flex justify-content-end text-center">
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <h5 class="font-weight-bold d-block">????</h5>
                  <small class="text-muted"><i class="fas fa-image mr-1"></i>Post(s)</small>
                </li>
                <li class="list-inline-item">
                  <h5 class="font-weight-bold d-block">????</h5>
                  <small class="text-muted"><i class="fas fa-user mr-1"></i>Ami(s)</small>
                </li>
              </ul>
            </div>
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

  <main class="col-md-8 mx-auto">


  </main>

  <?php
  footer();
  ?>

  <body>

</html>