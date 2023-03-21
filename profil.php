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
  
  <header>
    <div class="container">
      <div class="profile">

        <div class="profile-image">
          <!-- <img src="<?= $user["pp"] ?>" alt=""> -->
          <img src="https://images.unsplash.com/photo-1497445462247-4330a224fdb1?w=750&h=750&fit=crop">
        </div>

        <div class="profile-user-settings">
          <h1 class="profile-user-name"><?= $user["pnom"] ?> <?= $user["nom"] ?></h1>
          <button class="btn profile-edit-btn">Edit Profile</button>
        </div>

        <div class="profile-stats">
          <ul>
            <li><span class="profile-stat-count">???</span> post(s)</li>
            <li><span class="profile-stat-count">???</span> ami(s)</li>
          </ul>
        </div>

        <div class="profile-bio">
          <p><?= $user["descrip"] ?></p>
          <p><?= $user["interet"] ?></p>
        </div>

      </div>
    </div>
  </header>
  
  <main>


  </main>

  <?php
  footer();
  ?>

  <body>

</html>