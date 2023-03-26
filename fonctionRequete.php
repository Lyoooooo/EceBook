<?php 

if(isset($_POST['ami'])) {
  extract($_POST);
  $functionName = $_POST['ami'];
  if(function_exists($functionName)) {
    call_user_func($functionName, $idu, $ida, $page);
  }
}

function ajoutami($idu, $ida, $page) {
  include 'fonction.php';
  $pdo = connexion();
  $stmt = $pdo->prepare("INSERT INTO ami VALUES(?,?,?,?)");
  $stmt->execute([null, $idu, $ida, 0]);
  header("Location: $page?u=$ida");
}


?>