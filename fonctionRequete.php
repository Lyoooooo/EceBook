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

function recherche()
{
  
    if(isset($_GET['search']) && !empty($_GET['search'])){
      $pdo=connexion();
      
      $stmt = $pdo->prepare('SELECT * FROM user WHERE pnom LIKE :pnom OR nom LIKE :nom ORDER BY nom ASC');
      $stmt->bindValue(':pnom', '%'.$_GET['search'].'%');
      $stmt->bindValue(':nom', '%'.$_GET['search'].'%');
      $stmt->execute();
      $result = $stmt->fetchAll();
  


    
    if(count($result) > 0){
      foreach($result as $ligne){ 

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
                      <?php if(!$is_friend ){ ?>
                        <button type="submit" name="ami" value="ajoutami" class="btn btn-outline-dark btn-sm ms-5 mt-2 mb-4">Ajouter en ami </button>

                    <?php }else {?>
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