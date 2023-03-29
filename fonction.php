<?php

function connecte() //vérifie que l'user est connecté et avec un compte validé
{
  session_start();
  if (!isset($_SESSION["idu"]) || $_SESSION["grade"] == 0) {
    header("location:connexion.php");
  }
}

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
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="index.php">
          <img src="./images/e_now_logo2.png" height="65" alt="logo" loading="lazy" />
        </a>

        

      </div>
      <!-- Left elements -->

      <!-- Center elements -->
      <!--Recherche-->
      
      <form class="input-group w-auto my-auto d-none d-sm-flex" method="post" action="search.php">
        <!-- <input autocomplete="off" type="search" class="form-control rounded" name="search" placeholder="Chercher un utilisateur" " />
        <span class="input-group-text border-0 d-none d-lg-flex" style="background-color: white;"><i class="fa-solid fa-magnifying-glass"></i></span> -->
        <input type="text" class="form-control" style="min-width: 125px;" placeholder="Chercher un utilisateur" name="search" aria-label="Text input with dropdown button">
        <div class="input-group-append">
        <input type="submit" class="btn btn-white" style="border: 1px solid; color:#FF621F" name="ok" value="Rechercher">
        </div>
      </form>
      
      
      <!--Center elements-->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Messages -->
          <li class="nav-item">
            <a class="nav-link text-center" href="message.php">
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
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="profil.php" id="navbarDropdownMenuAvatar" role="button" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php if ($infoUser["pp"] == null) {
                              echo "./images/avatarbasique.png";
                            } else { ?>../<?= $infoUser["pp"] ?><?php } ?>" class="rounded-circle" height="25" alt="image" loading="lazy" /> &nbsp;
                  <p class="text-black"><?= $infoUser["pnom"] ?> <?= $infoUser["nom"] ?></p>
                </a>
              <?php else : ?>
                <a class="nav-link text-center " href="connexion.php">
                  <i class="fa-regular fa-user"><br>
                    <p style="font-family: 'Courier New', Courier, monospace" class="fw-bold d-none d-lg-flex note-icon">Connexion</p>
                  </i>

                </a>

              <?php endif; ?>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="profil.php">
                            <i class="fa-solid fa-user"></i> Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="deconnexion.php">
                            <i class="fa-solid fa-right-from-bracket"></i> Déconnexion </a>
                    </div>
            </ul>
      </div>
      <!-- Right elements -->
    
  </nav>
  
  <nav class="bottom-navbar sticky-top text-center" style=" background-color: white; box-shadow: 2px 2px 3px #FFE2D6;">
        <div class="container col-8 mx-auto" style="text-align:center;">
          <div class="container px-5 p-3 ">
              <div class="row ">
            <ul class="nav page-navigation  ">
                <li class="nav-item  ">
                    <a class="nav-link" href="categorie.php?idcategorie=1">
                      <i class="fas fa-circle-notch" style="color:FF621F"></i>
                        <span class="menu-title" style="color:FF621F">Général</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="categorie.php?idcategorie=2">
                        <i class="fas fa-globe" style="color:FF621F"></i>
                        <span class="menu-title" style="color:FF621F"> Actualités</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="categorie.php?idcategorie=3">
                        <i class="fas fa-calendar" style="color:FF621F"></i>
                        <span class="menu-title" style="color:FF621F"> Evénements </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
  </div>
  </div>
<?php

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
          <a href="./docs/CGU.pdf" class="btn btn-outline-light btn-rounded text-dark" target="blank" role="button" aria-pressed="true">CGU</a> &nbsp&nbsp&nbsp
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
        <?php if ($user["pp"] == NULL) { ?>
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
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $post["idp"] ?>" class="dropdown-item"> Modifier le post </button></li>
          <li><a class="dropdown-item" href="#">Encore un autre truc</a></li>
          <li><a class="dropdown-item" href="deletePost.php?idp=<?php echo $post["idp"] ?>" style="color:red;">SUPPRIMER LE POST</a></li>
        </ul>
          <?php $idp = $post["idp"];
          modifpost($idu, $idp); ?>
        </ul>
      </div>
    </div>

    <!-- MAIN -->
    <div class="card-body">
      <p class="ms-5 px-3"><?= $post["texte"] ?></p>
      <?php if ($post["photo"] != "vide") { ?>
        <img src="<?= $post["photo"] ?>" class="img-fluid rounded mx-auto d-block" style="overflow:hidden;max-width:40rem;max-height:20rem;height:auto;weight:auto;">
      <?php } ?>
      <button><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
    </div>

    <!-- FOOTER -->
    <div class="fw-semibold text-muted pt-2" style="background-color:#e8e8e8;height:2.5rem;">
      <span class="ps-3"><?= $post["likes"] ?> Likes</span>
      <span class=""><?= $post["dislike"] ?> Dislikes</span>
      <span class=""><?= $post["vu"] ?> Vues</span>
      <span class=""><?= $post["date"] ?></span>
    </div>
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
              <?php 
                if ($_SESSION["grade"] == 4) { //Pour les admins ?>
                  <option value="Tous">Tous</option>
                  <option value="Etudiant">Etudiant</option>
                  <option value="Enseignant">Enseignant</option> <?php
                }
              ?>
            </select><br>

            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupFile01">Photo</label>
              <input class="form-control" name="photo" type="file" id="formFile" accept=".png, .jpg, .jpeg .webp"><br>
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
  <?php
  if (isset($_POST["bouton"])) {
    extract($_POST);
    extract($_FILES);
    $idu = $_SESSION["idu"];
    $pdo = connexion();
    if ($_FILES['photo']['name'] == "" || $_FILES['photo']['error'] == 4 || $_FILES['photo']['error'] == 1) {
      $photo = NULL;
    } else {
      $photo = ajoutphoto($idu, $photo);
    }
    $stmt = $pdo->prepare("INSERT INTO post VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([null, $idu, $titre, $texte, $photo, $type, 0, 0, 0, date("Y-m-d H:i:s")]);
  ?>
    <meta http-equiv="refresh" content="1">
  <?php   }
}

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
function ajoutpp($nom, $pp)
{
  $extensions = array('jpg', 'jpeg', 'png'); //liste des extensions
  $ext = strtolower(substr(strrchr($_FILES['pp']['name'], '.'), 1)); //extrait l'extension de l'image et la rend en minuscule
  if (($_FILES['pp']['size'] < 20971520) && (in_array($ext, $extensions))) { //limite la taille et compare l'extension
    $pp = 'images/pp/' . $nom . '-' . $_FILES['pp']['name']; //renome avec l'idu devant
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
  <div class="modal fade" id="exampleModal<?php echo $idp ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="titre" value="<?php echo $post["titre"] ?>" required>
              <label for="floatingInput">Titre<span class="etoile">*</span> </label>
            </div>

            <div class="form-floating">
              <textarea class="form-control" id="floatingTextarea2" name="texte" style="height: 100px" required><?php echo $post["texte"] ?></textarea>
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
            <button type="submit" class="btn btn-primary" name="boutonEdit" value="<?php echo $post["idp"] ?>">Poster</button>
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
    if ($idp = $_POST["boutonEdit"]) {
      $stmt = $pdo->prepare("UPDATE post SET titre = ?, texte = ?, typep = ? WHERE idp = $idp");
      $stmt->execute([$titre, $texte, $type]);
    }
  ?>
    <meta http-equiv="refresh" content="1">
<?php   }
}
?>