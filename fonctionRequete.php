<?php


if (isset($_POST['ami'])) {
  extract($_POST);
  $functionName = $_POST['ami'];
  if (function_exists($functionName)) {
    call_user_func($functionName, $idu, $ida, $page);
  }
}

function ajoutami($idu, $ida, $page)
{
  if ($idu != $ida) {
    include 'fonction.php';
    $pdo = connexion();
    $query = $pdo->prepare("SELECT * FROM ami WHERE idu1 = :ida AND idu2 = :idu");
    $query->bindParam(':ida', $ida);
    $query->bindParam(':idu', $idu);
    $query->execute();
    if ($query->rowCount() > 0) {
      $valide = 1;
      $query = $pdo->prepare("UPDATE ami SET valide = 1 WHERE idu1 = :ida AND idu2 = :idu");
      $query->bindParam(':ida', $ida);
      $query->bindParam(':idu', $idu);
      $query->execute();
    } else {
      $valide = 0;
    }

    $stmt = $pdo->prepare("INSERT INTO ami VALUES(?,?,?,?)");
    $stmt->execute([null, $idu, $ida, $valide]);
  }
  header("Location: $page?u=$ida");
}

if (isset($_POST['pami'])) {
  extract($_POST);
  $functionName = $_POST['pami'];
  if (function_exists($functionName)) {
    call_user_func($functionName, $idu, $ida, $page);
  }
}

function retireami($idu, $ida, $page)
{
  include 'fonction.php';
  $pdo = connexion();
  $query = $pdo->prepare("DELETE FROM ami WHERE idu1 = :idu AND idu2 = :ida");
  $query->bindParam(':idu', $idu);
  $query->bindParam(':ida', $ida);
  $query->execute();
  $query = $pdo->prepare("UPDATE ami SET valide = 0 WHERE idu1 = :ida AND idu2 = :idu");
  $query->bindParam(':ida', $ida);
  $query->bindParam(':idu', $idu);
  $query->execute();
  header("Location: $page?u=$ida");
}

