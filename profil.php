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
  <div class="col-md-8 mx-auto">
    <div class="bg-white shadow overflow-hidden">
      <div class="px-5 pt-0 pb-4">
        <div class="profile-head">
          <div class="d-flex">
            <img src="<?php echo $user["pp"] ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail me-5 mb-5">
            <div class="grid gap-0 column-gap-3">
              <h4 class="mt-4 mb-2"><?php echo $user["pnom"] ?> <?php echo $user["nom"] ?></h4>
              <p class="small align-bottom mb-2"><?php echo $user["ville"] ?></p>
              <p class="small align-bottom"><?php echo $user["promo"] ?></p>
            </div>
          </div>
          <a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
          
        </div>
      </div>
      <div class="bg-light p-4 d-flex justify-content-end text-center">
        <ul class="list-inline mb-0">
          <li class="list-inline-item">
            <h5 class="font-weight-bold mb-0 d-block">215</h5>
            <small class="text-muted"> <i class="fas fa-image mr-1">

              </i>Photos</small>
          </li>
          <li class="list-inline-item">
            <h5 class="font-weight-bold mb-0 d-block">745</h5>
            <small class="text-muted">
              <i class="fas fa-user mr-1">

              </i>Followers</small>
          </li>
          <li class="list-inline-item">
            <h5 class="font-weight-bold mb-0 d-block">340</h5>
            <small class="text-muted">
              <i class="fas fa-user mr-1">

              </i>Following</small>
          </li>
        </ul>
      </div>
      <div class="px-4 py-3">
        <h5 class="mb-0">About</h5>
        <div class="p-4 rounded shadow-sm bg-light">
          <p class="font-italic mb-0">Web Developer</p>
          <p class="font-italic mb-0">Lives in New York</p>
          <p class="font-italic mb-0">Photographer</p>
        </div>
      </div>
    </div>
  </div>

  <main>


  </main>

  <?php
  footer();
  ?>

  <body>

</html>