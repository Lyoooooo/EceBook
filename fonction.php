<?php

function connexion()
{
  try {
    $pdo = new PDO('mysql:dbname=ecebook;host=127.0.0.1', 'root', '');
    $pdo->exec("SET CHARACTER SET utf8mb4");
  } catch (PDOException $e) {
    $pdo = new PDO('mysql:dbname=ecebook;host=127.0.0.1;port=3307', 'root', '');
    $pdo->exec("SET CHARACTER SET utf8mb4");
  }
  return $pdo;
}

function encode($mdp, $mail)
{
  $salt = "@|-°+==00001ddQ";
  $crypt = md5($mdp . $salt . $mail);
  return $crypt;
}

function connecte()
{
  if (!isset($_SESSION["idu"])) {
    return False;
  } else return True;
}

function footer()
{ ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <!-- Modal -->
  <!-- Footer -->
  <footer class="text-center " style="background-color: #FFE2D6;">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: CTA -->
      <section class="">
        <p class="d-flex justify-content-center align-items-center">
          <a href="./docs/CGU.pdf" class="btn btn-outline-light btn-rounded text-dark" role="button" aria-pressed="true">CGU</a>
          <button type="button" class="btn btn-outline-light btn-rounded text-dark" data-toggle="modal" data-target="#cookieConsent">
            Police des Cookies
          </button>
        <div class="modal fade" id="cookieConsent">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="modal-header" style="background-color: FFE2D6;">
                  <h5 class="modal-title" id="cookieconsentLabel2">Cookies & Vie Privée</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-3 d-flex align-items-center justify-content-center">
                      <i class="fas fa-cookie-bite fa-4x"></i>
                    </div>

                    <div class="col-9">
                      <p>Ce site utilise des cookies pour vous garantir une meilleure expérience sur notre site internet.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn" style="background-color: rgba(0, 0, 0, 0.2);" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn" style="background-color: FFE2D6;" data-dismiss="modal">Accepter</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        </p>
      </section>
      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Tous droits réservés :
      <a class="text-white" href="https://e-now.fr/">E-now.fr</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->


<?php
}

function mainHeader()
{
  $pdo = connexion();
?>
  <script src="https://kit.fontawesome.com/13086b36a6.js" crossorigin="anonymous"></script>

  <!-- Navbar-->
  <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; box-shadow: 0px 2px 3px #FFE2D6;">
    <div class="container-fluid justify-content-between">
      <!-- Left elements -->
      <div class="d-flex">
        <!-- Brand -->
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="#">
          <img src="./images/e_now_logo2.png" height="65" alt="logo" loading="lazy" />
        </a>

        <!-- Search form -->

      </div>
      <!-- Left elements -->

      <!-- Center elements -->
      <!--Recherche-->
      <form class="input-group w-auto my-auto d-none d-sm-flex">
        <input autocomplete="off" type="search" class="form-control rounded" name="search" placeholder="Search" style="min-width: 125px;" />
        <span class="input-group-text border-0 d-none d-lg-flex" style="background-color: white;"><i class="fa-solid fa-magnifying-glass"></i></span>
      </form>
      <?php
      recherche();
      ?>
      <!--Center elements-->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Messages -->
          <li class="nav-item">
            <a class="nav-link text-center" href="#">
              <i class="fa-regular fa-comments">
                <p style="font-family: 'Courier New', Courier, monospace" class="d-lg-flex d-none note-icon">Messages</p>
              </i>
            </a>
          </li>
          <li class="nav-item">
            <!-- Avatar -->
            <div class="dropdown">
              <?php
              if (isset($_SESSION["idu"])) {
                $idu = $_SESSION["idu"]; //stock l'id de l'utilisateur dans une session
                $pdo = connexion();
                $infoUser = $pdo->prepare("SELECT * FROM user WHERE idu = ?");
                $infoUser->execute(array($idu));
                $infoUser = $infoUser->fetch();
              }
              if (isset($idu)) : ?>
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                  <img src="<?php if ($infoUser["pp"] == null) {
                              echo "./images/avatarbasique.png";
                            } else { ?>../<?= $infoUser["pp"] ?><?php } ?>" class="rounded-circle" height="25" alt="image" loading="lazy" />
                </a>
              <?php else : ?>
                <a class="nav-link text-center " href="connexion.php">
                  <i class="fa-regular fa-user"><br>
                    <p style="font-family: 'Courier New', Courier, monospace" class="fw-bold d-none d-lg-flex note-icon">Connexion</p>
                  </i>

                </a>

              <?php endif; ?>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                <li>
                  <p class="dropdown-item"><?= $infoUser["pnom"] ?> <?= $infoUser["nom"] ?></p>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Settings</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Logout</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>


      </div>
      <!-- Right elements -->
    </div>
  </nav>
<?php
}

function recherche()
{
  $pdo = connexion();
  if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $statement = $pdo->prepare("SELECT * from post where titre like :search inner join user on post.idu = user.idu");
    $statement->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["search"] = $result;
    header("Location: recherche.php");
  }
}
?>
<?php
function AfficherPost()
{

  $idu = 1;
  $pdo = connexion();
  $statement = $pdo->prepare("SELECT * from post");
  //le 'prepare' prepare la requete 

  //bindValue donne la valeur *
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);


  $statement2 = $pdo->prepare("SELECT * from user where idu=:idu");
  $statement2->bindValue(':idu', $idu, PDO::PARAM_INT);
  $statement2->execute();
  $result2 = $statement2->fetch(PDO::FETCH_ASSOC);


?>
  <div class="card-body">
    <?php foreach ($result as $ligne) {
      foreach ($result2 as $ligne2) {
    ?>
        <div class='p-5 text-center' style='background-color:#F3F781'>
          <div class='card'>
            <div class='row'>
              <div class="card-body product-img-outer text-center">
                <h1>
                  <p>Bonjour!</p>
                </h1>
                <p><?= $ligne['titre'] ?></p>
                <img class="product_image rounded" style="height: 300px; width: 300px" src="<?= $ligne['photo'] ?>" alt="...">
                <p class=''><?= $ligne['texte'] ?></p> <br>

              </div>

              <div class='card-body col-7 text-start'>
                <h2>
                  <p>Mymy</p>
                </h2>
                <h2>
                  <p class="float-end h3"><?= $ligne2['nom'] ?></p>
                </h2>
                <a class="btn btn-success float-end" href="profil.php?idu=<?= $ligne['ida'] ?>">Voir profil</a>
                <!-- on affiche un bouton voir plus, accedant à un lien vers la page profil, à voir si on garde ça  -->
              </div>

            </div>
          </div>
        </div>
    <?php }
    } ?>


  <?php
}

function post($post)
{
  $pdo = connexion();
  $stmt = $pdo->prepare("SELECT * FROM user WHERE idu=?");
  $stmt->execute([$post["idu"]]);
  $user = $stmt->fetch();
  $idu = $_SESSION["idu"];
  ?>
    <div class="card p-0 mb-4">
      <!-- HEADER -->
      <div class="header d-flex ps-2">
        <div class="pt-2"><a href="profil.php?u=<?= $user["idu"] ?>">
            <?php if ($user["pp"] == 'vide') { ?>
              <img src="images/pp/pp.jpg" alt="..." style="border-radius:50%;height:4rem">
            <?php } else { ?>
              <img src="<?= $user["pp"] ?>" alt="Photo de @<?= $user["mail"] ?>" style="border-radius:50%;height:4rem">
            <?php } ?>
          </a></div>
        <div class="grid">
          <a href="profil.php?u=<?= $user["idu"] ?>">
            <div class="ps-3 pt-2 fs-6 fst-italic text-decoration-underline"><?= $user["pnom"] ?> <?= $user["nom"] ?></div>
          </a>
          <div class="ps-3 pt-0 fs-4 fw-bolder"><?= $post["titre"] ?></div>
        </div>
        <div class="position-absolute top-0 end-0 p-3 fw-semibold text-uppercase" style="color:#FF621F"><?= $post["typep"] ?></div>
        <div class="position-absolute end-0" style="top: 50px;">
          <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false" style=" background-color:rgba(0,0,0,0); border-width:0px;">
            <img src="images/boutonPosts.png" alt="" style="height: 40px;">
          </button>
          <ul class="dropdown-menu">
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $post["idp"]?>" class="dropdown-item"> Modifier le post </button></li>
            <li><a class="dropdown-item" href="#">Autre chose</a></li>
            <li><a class="dropdown-item" href="#">Encore un autre truc</a></li>
          </ul>
          <?php
          $idp = $post["idp"];
          modifpost($idu, $idp); ?>
          </ul>
        </div>
      </div>
      <!-- MAIN -->
      <div class="card-body">
        <p class="ms-5 px-3"><?= $post["texte"] ?></p>
        <?php if ($post["photo"] != "vide") { ?>
          <img src="<?= $post["photo"] ?>" class="img-fluid rounded mx-auto d-block" style="overflow: hidden;max-width:60rem;max-height:50rem;height: auto;">
        <?php } ?>
      </div>
      <!-- FOOTER -->
      <div class="fw-semibold text-muted pt-2" style="background-color:#e8e8e8;height:2.5rem;">
        <span class="ps-3"><?= $post["likes"] ?> Likes</span>
        <span class=""><?= $post["dislike"] ?> Dislikes</span>
        <span class=""><?= $post["vu"] ?> Vus</span>
        <span class=""><?= $post["date"] ?></span>
      </div>
      <div class="position-absolute top-0 end-0 p-3 fw-semibold text-uppercase" style="color:#FF621F"><?= $post["typep"] ?></div>
    </div>
  <?php
}

function ajoutpost()
{ ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="titre" required>
                <label for="floatingInput">Titre<span class="etoile">*</span> </label>
              </div>

              <div class="form-floating">
                <textarea class="form-control" id="floatingTextarea2" name="texte" style="height: 100px" required></textarea>
                <label for="floatingTextarea2">Texte<span class="etoile">*</span></label>
              </div><br>

              <h8>Type de post</h8><span class="etoile">*</span>
              <select class="form-select" aria-label="Default select example" name="type" required>
                <option value="Général">Général</option>
                <option value="Actualité">Actualité</option>
                <option value="Evènement">Evènement</option>
              </select><br>

              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Photo</label>
                <input class="form-control" name="photo" type="file" id="formFile" accept=".png, .jpg, .jpeg .webp" required><br>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" name="bouton">Poster</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php }

function ajoutphoto($idu, $photo)
{
  $extensions = array('jpg', 'jpeg', 'png'); //liste des extensions
  $ext = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1)); //extrait l'extension de l'image et la rend en minuscule
  if (($_FILES['photo']['size'] < 20971520) && (in_array($ext, $extensions))) { //limite la taille et compare l'extension
    $photo = 'images/post/' . $idu . '-' . $_FILES['photo']['name']; //renome avec l'idu devant
    move_uploaded_file($_FILES['photo']['tmp_name'], $photo); //place l'image dans le dossier
  }
  return $photo;
}
function ajoutpp($idu, $pp)
{
  $extensions = array('jpg', 'jpeg', 'png'); //liste des extensions
  $ext = strtolower(substr(strrchr($_FILES['pp']['name'], '.'), 1)); //extrait l'extension de l'image et la rend en minuscule
  if (($_FILES['pp']['size'] < 20971520) && (in_array($ext, $extensions))) { //limite la taille et compare l'extension
    $pp = 'images/pp/' . $idu . '-' . $_FILES['pp']['name']; //renome avec l'idu devant
    move_uploaded_file($_FILES['pp']['tmp_name'], $pp); //place l'image dans le dossier
  }
  return $pp;
}

function modifpost($idu, $idp)
  {
    $pdo = connexion();
    $stmt = $pdo->prepare("SELECT * FROM post WHERE idp=?");
    $stmt->execute([$idp]);
    $post = $stmt->fetch();
    ?>
    <div class="modal fade" id="exampleModal<?php echo $idp?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="titre" value="<?php echo $post["titre"]?>" required>
                <label for="floatingInput">Titre<span class="etoile">*</span> </label>
              </div>

              <div class="form-floating">
                <textarea class="form-control" id="floatingTextarea2" name="texte" style="height: 100px" required><?php echo $post["texte"]?></textarea>
                <label for="floatingTextarea2">Texte<span class="etoile">*</span></label>
              </div><br>

              <h8>Type de post</h8><span class="etoile">*</span>
              <select class="form-select" aria-label="Default select example" name="type" required>
                <option value="Général">Général</option>
                <option value="Actualité">Actualité</option>
                <option value="Evènement">Evènement</option>
              </select><br>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" name="boutonEdit" value="<?php echo $post["idp"]?>">Poster</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    if (isset($_POST["boutonEdit"])) {
      $pdo = connexion();
      extract($_POST);
      extract($_FILES);
      if($idp = $_POST["boutonEdit"]){
        $stmt = $pdo->prepare("UPDATE post SET titre = ?, texte = ?, typep = ? WHERE idp = $idp");
        $stmt->execute([$titre, $texte, $type]);
      }
    ?>
      <meta http-equiv="refresh" content="1">
  <?php   }
  }
