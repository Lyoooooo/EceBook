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
{
?>
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
            <div class="modal-header" style = "background-color: FFE2D6;">
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
                <button type="button" class="btn" style = "background-color: FFE2D6;" data-dismiss="modal">Accepter</button>
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
?>
<script src="https://kit.fontawesome.com/13086b36a6.js" crossorigin="anonymous"></script>

<!-- Navbar-->
<nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; box-shadow: 0px 2px 3px #FFE2D6;">
  <div class="container-fluid justify-content-between">
    <!-- Left elements -->
    <div class="d-flex">
      <!-- Brand -->
      <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="#">
        LOGO
      </a>

      <!-- Search form -->
      
    </div>
    <!-- Left elements -->

    <!-- Center elements -->
    <!--Recherche-->
    <form class="input-group w-auto my-auto d-none d-sm-flex">
        <input
          autocomplete="off"
          type="search"
          class="form-control rounded"
          name="search"
          placeholder="Search"
          style="min-width: 125px;"
        />
        <span class="input-group-text border-0 d-none d-lg-flex" style="background-color: white;"
          ><i class="fa-solid fa-magnifying-glass" ></i></span>
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
                    <i class="fa-regular fa-comments"><p  style="font-family: 'Courier New', Courier, monospace" class="d-lg-flex d-none note-icon">Messages</p></i>
                </a>
            </li>
            <li class="nav-item">
            <!-- Avatar -->
            <div class="dropdown">
                <?php if(isset($uid)): ?>
                <a
                class="dropdown-toggle d-flex align-items-center hidden-arrow"
                href="#"
                id="navbarDropdownMenuAvatar"
                role="button"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
                >
                <img
                    src="<?php if($infoUser["avatar"] == null){ echo "./images/avatarbasique.png";}else{ ?>../<?= $infoUser["avatar"] ?><?php } ?>"
                    class="rounded-circle"
                    height="25"
                    alt="image"
                    loading="lazy"
                />
                </a>
                <?php else: ?>
                    <a class="nav-link text-center " href="connexion.php">
                        <i class="fa-regular fa-user"><br><p style="font-family: 'Courier New', Courier, monospace" class="fw-bold d-none d-lg-flex note-icon">Connexion</p></i>

                    </a>

                <?php endif; ?>
                <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuAvatar"
                >
                <li>
                    <a class="dropdown-item" href="#">My profile</a>
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
    if(isset($_POST["search"])){
        $search = $_POST["search"];
        $statement = $pdo -> prepare("SELECT * from post where titre like :search inner join user on post.idu = user.idu");
        $statement -> bindValue(':search', "%$search%", PDO::PARAM_STR);
        $statement -> execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["search"] = $result;
        header("Location: recherche.php");
    }
}
?>
