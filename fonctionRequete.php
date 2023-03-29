<?php


if (isset($_POST['ami'])) { //si on appuie sur le bouton ajouter en ami
  extract($_POST);
  $functionName = $_POST['ami'];
  if (function_exists($functionName)) { //redirige vers la fonction ajout ami
    call_user_func($functionName, $idu, $ida, $page);
  }
}

function ajoutami($idu, $ida, $page)
{
  include 'fonction.php';
  $pdo = connexion();


  
  $query = $pdo->prepare("SELECT * FROM ami WHERE (idu1 = :ida AND idu2 = :idu) OR (idu1 = :idu AND idu2 = :ida)"); //regarde si il existe déja une demande
  $query->bindParam(':ida', $ida);
  $query->bindParam(':idu', $idu);
  $query->execute();
  if ($query->rowCount() > 0) { //si oui
    $ami = $query->fetch();
    if ($ami["idu2"] == $idu) { //si c'est bien celui qui a reçu la demande qui appuie sur le bouton
      $query = $pdo->prepare("UPDATE ami SET valide = 1 WHERE idu1 = :ida AND idu2 = :idu"); //passe le valide à 1
      $query->bindParam(':ida', $ami["idu1"]);
      $query->bindParam(':idu', $ami["idu2"]);
      $query->execute();
    }
  } else { //si non
    $stmt = $pdo->prepare("INSERT INTO ami VALUES(?,?,?,?)"); //rajoute une demande d'ami avec valide à 0
    $stmt->execute([null, $idu, $ida, 0]);
  }
  header("Location: $page?u=$ida"); //redirige vers la page de base
}

if (isset($_POST['pami'])) { //pareil mais pour retirer un ami
  extract($_POST);
  $functionName = $_POST['pami'];
  if (function_exists($functionName)) { //redirige vers retireami
    call_user_func($functionName, $idu, $ida, $page);
  }
}

function retireami($idu, $ida, $page)
{
  include 'fonction.php';
  $pdo = connexion();

  $query = $pdo->prepare("SELECT * FROM ami WHERE (idu1 = :ida AND idu2 = :idu) OR (idu1 = :idu AND idu2 = :ida)"); //regarde la demande d'ami de base
  $query->bindParam(':idu', $idu);
  $query->bindParam(':ida', $ida);
  $query->execute();
  $ami = $query->fetch();

  if (($ami["valide"] == 1) && ($ami["idu1"] != $idu)) { //si ils sont en ami
    $query = $pdo->prepare("UPDATE ami SET valide = 0 WHERE idu1 = :idu1 AND idu2 = :idu2"); //modifie le valide 
    $query->bindParam(':idu1', $ami["idu1"]);
    $query->bindParam(':idu2', $ami["idu2"]);
    $query->execute();
  } else if (($ami["valide"] == 0) || ($ami["idu1"] == $idu)) { //si ils ne sont pas ami == l'ami n'a pas accepté sa demande donc il la retire
    $query = $pdo->prepare("DELETE FROM ami WHERE idu1 = :idu1 AND idu2 = :idu2"); //supprime sa demande
    $query->bindParam(':idu1', $ami["idu1"]);
    $query->bindParam(':idu2', $ami["idu2"]);
    $query->execute();
  }
  header("Location: $page?u=$ida"); //redirige vers la page de base
}

