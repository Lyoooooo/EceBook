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

  if ($ami["valide"] == 1) { //si ils sont en ami
    $query = $pdo->prepare("UPDATE ami SET valide = 0 WHERE idu1 = :idu1 AND idu2 = :idu2"); //modifie le valide 
    $query->bindParam(':idu1', $ami["idu1"]);
    $query->bindParam(':idu2', $ami["idu2"]);
    $query->execute();
  } else if ($ami["valide"] == 0) { //si ils ne sont pas ami == l'ami n'a pas accepté sa demande donc il la retire
    $query = $pdo->prepare("DELETE FROM ami WHERE idu1 = :idu1 AND idu2 = :idu2"); //supprime sa demande
    $query->bindParam(':idu1', $ami["idu1"]);
    $query->bindParam(':idu2', $ami["idu2"]);
    $query->execute();
  }
  header("Location: $page?u=$ida"); //redirige vers la page de base
}

function recherche()
{

  if (isset($_GET['search']) && !empty($_GET['search'])) {
    $pdo = connexion();

    $stmt = $pdo->prepare('SELECT * FROM user WHERE pnom LIKE :pnom OR nom LIKE :nom ORDER BY nom ASC');
    $stmt->bindValue(':pnom', '%' . $_GET['search'] . '%');
    $stmt->bindValue(':nom', '%' . $_GET['search'] . '%');
    $stmt->execute();
    $result = $stmt->fetchAll();




    if (count($result) > 0) {
      foreach ($result as $ligne) {

        $friend_id = $ligne['idu'];
        $stmt = $pdo->prepare('SELECT * FROM ami WHERE idu1 = :user_id AND idu2= :friend_id');
        $stmt->bindValue(':user_id', $_SESSION['idu']);
        $stmt->bindValue(':friend_id', $friend_id);
        $stmt->execute();
        $is_friend = $stmt->fetch();
?>
        <div class="container d-flex justify-content-center align-items-center">
          <div class='row align-items-center'>
            <div class="card card-sm d-flex flex-row justify-content-between align-items-center" style="height: 150px;">
              <div class="card-body product-img-outer text-center">
                <?php if ($ligne["pp"] == NULL) { ?>
                  <img src="images/pp/pp.jpg" alt="..." width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">

                <?php } else { ?>
                  <img src="<?= $ligne["pp"] ?>" alt="Photo de @<?= $ligne["mail"] ?>" width="130" class="rounded img-thumbnail me-5 ms-2 mb-2 mt-2">


                <?php } ?>
              </div>
              <div class='card-body'>
                <p class="mt-2 mb-2"><?= $ligne["pnom"] ?> <?= $ligne["nom"] ?> </p>
                <form method="POST" action="fonctionRequete.php" class="ms-auto">
                  <input type="hidden" name="idu" value="<?= $_SESSION['idu'] ?>">
                  <input type="hidden" name="ida" value="<?= $ligne['idu'] ?>">
                  <input type="hidden" name="page" value="index.php">
                  <?php if (!$is_friend) { ?>
                    <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm ms-5 mt-2 mb-4">Ajouter en ami </button>

                  <?php } else { ?>
                    <p>Vous êtes ami!</p>

                  <?php } ?>
                </form>
              </div>
            </div>
      <?php }
    } else {
      echo "Aucun resultat";
    }
    echo "<br> <br>";
  }
      ?>
          </div>
        </div>
        </div>
      <?php } ?>