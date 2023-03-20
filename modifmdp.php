<?php
include "fonction.php";
session_start();
if (connecte() == False) {
  header("location:connexion.php");
}
mainHeader();
$pdo = connexion();
$idu = $_SESSION["idu"];
$stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
$stmt->execute([$idu]);
$user = $stmt->fetch();
$mail = $user["mail"];
$mdp = $user["mdp"];
if (isset($_POST["bouton"])) {
  extract($_POST);
  $oldmdp = encode($oldmdp, $mail);
  if ($mdp == $oldmdp) {
    if ($newmdp == $newmdp2) {
      $newmdp = encode($newmdp, $mail);
      if ($newmdp != $mdp) {
        $mdp = $newmdp;
        $sql = "UPDATE user SET mdp=? WHERE idu=?";
        $pdo->prepare($sql)->execute([$mdp, $idu]);
        echo "<h3>Votre mot de passe à bien été modifié ! <br>Retour à votre profil...</h3>";
        header("refresh:2;url=modifuser.php");
      } else {
        echo "<h3>Votre nouveau mot de passe est identique à votre ancien mot de passe</h3>";
      }
    } else {
      echo "<h3>Vos mots de passe ne sont pas identique</h3> ";
    }
  } else {
    echo "<h3>Votre ancien mot de passe est faux</h3>";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <title>Modification de mon mot de passe</title>
</head>

<body>
  <div id="second">
    <div class="rounded shadow text-left">
      <div id="divmid">
        <div class="h1 text-center">
          <h1>Votre compte</h1><br>
          <div class="position-absolute top-0 end-0 p-3 m3">
            <h5><a href="modifuser.php">retour</a></H5>
          </div>
        </div>
        <div class=text-end>
          <form action="" method="post">
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        </div>
        <div class="col-md-4">
          <label for="validationDefault01" class="form-label">Ancien mot de passe</label><span class="etoile">*</span>
          <input type="password" name="oldmdp" class="form-control" id="second" required>
        </div><br>
        <div class="col-md-4">
          <label for="validationDefault01" class="form-label">Nouveau mot de passe</label><span class="etoile">*</span>
          <input type="password" name="newmdp" class="form-control" id="second" required>
        </div><br>
        <div class="col-md-4">
          <label for="validationDefault01" class="form-label">Confirmer votre nouveau mot de passe</label><span class="etoile">*</span>
          <input type="password" name="newmdp2" class="form-control" id="second" required>
        </div><br>
        <div class="d-grid gap-2 col-6 mx-auto">
          <input class="btn btn-success text-center" type="submit" value="Modifier" name="bouton"><br><br>
        </div>
      </div>
    </div>
  </div><br><br>
</body>
<?php footer(); ?>

</html>