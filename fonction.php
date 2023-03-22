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
    <footer class='text-center text-white' style='background-color: rgba(0, 0, 0, 0.904);color:white; width: 100%; z-index: 9;margin-top: auto;'>

        <div class='container pt-4'>
            <section class='text-center text-light'>
                <p>
                    NOMDUSITE est un site deposé par JESAISPAS. <br>
                    Tous droits réservés.
                </p>
            </section>
        </div>
        <div class='text-center text-light p-3' style='background-color: rgba(0, 0, 0, 0.2);'>
            © <?php $year = date("Y");
                echo $year; ?> NOMDUSITE<br>
        </div>
    </footer>
<?php
}

function mainHeader()
{
?>

   
</div>
    
<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.php"><img style="height: 60px; width: 110px" src="../image/jalegreatedealnav.png" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.php"><img style="height: 60px; width: 120px" src="../image/jalegreatedealnavmini.png" alt="logo" /></a>
                <!-- Logo  responsive -->
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-settings ">
                        <a class="nav-link text-center text-dark mt-lg-4" href="<?php if(isset($uid)): ?>message.php <?php else: ?> connexion.php <?php endif; ?>">
                            <i class="fa-regular fa-comments"><p style="font-family: 'Courier New', Courier, monospace" class="fw-bold d-none d-lg-flex note-icon">Messages</p></i>
                        </a>
                </li>
                <ul class="navbar-nav navbar-nav-right">


                    
                    <?php if(isset($idu)): ?>
                        <li class="nav-item nav-profile dropdown">

                            <a class="nav-link " id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="<?php if($infoUser["avatar"] == null){ echo "../image/avatarbasique.png";}else{ ?>../<?= $infoUser["avatar"] ?><?php } ?>" alt="image">
                                    <span class="availability-status online"></span>
                                </div>
                                <div class="nav-profile-text">
                                    <p class="text-black"><?= $infoUser["prenom"] ?> <?= $infoUser["nom"] ?></p>
                                </div>
                                <i class="fa-solid fa-chevron-down mx-1"></i>
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item nav-logout ">
                            <a class="nav-link text-center text-dark mt-lg-4" href="connexion.php">
                                <i class="fa-regular fa-user"><br><p style="font-family: 'Courier New', Courier, monospace" class="fw-bold d-none d-lg-flex note-icon">Connexion</p></i>

                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Page 1</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" style="border-color: #FF621F; color: #FF621F;" type="submit">Search</button>
                </form>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center mx-2" type="button" data-toggle="horizontal-menu-toggle">
                    <i class="fa-solid fa-bars text-dark"></i>
                </button>

                </ul>

               
            </div>
        </div>
    </nav>
<?php
}
?>

<?php
function AfficherPost()
{


$pdo = connexion();
$statement = $pdo ->prepare ("SELECT * from post");
//le 'prepare' prepare la requete 

//bindValue donne la valeur *
$statement->execute();   
$result = $statement->fetch(PDO::FETCH_ASSOC);


$statement2 = $pdo -> prepare ("SELECT * from user where idu=:idu");
$statement2 -> bindValue(':idu', $idu, PDO::PARAM_INT);
$statement2->execute();   
$result2 = $statement2->fetch(PDO::FETCH_ASSOC);


?>
 <div class="card-body">
    <?php foreach($result as $ligne){ 
        foreach ($result2 as $ligne2){?>
        <div class= 'p-5 text-center' style='background-color:#F3F781'>
            <div class='card'>
                <div class='row'>
                    <div class="card-body product-img-outer text-center">
                        <h1><p>Bonjour!</p></h1>
                        <h1><?=$ligne['titre']?></h1> <br>    
                        <img class="product_image rounded" style="height: 300px; width: 300px" src="<?= $ligne['photo'] ?>" alt="...">
                            <p class=''><?=$ligne['texte']?></p> <br>
                                                    
                    </div>
                                            
                    <div class='card-body col-7 text-start'>    
                        <h2><p>Mymy</p> </h2>
                        <h2><p class="float-end h3"><?=$ligne2['nom']?></p></h2> 
                        <a class="btn btn-success float-end"  href="profil.php?idu=<?= $ligne['ida'] ?>">Voir profil</a> 
                            <!-- on affiche un bouton voir plus, accedant à un lien vers la page profil, à voir si on garde ça  -->
                        </div>
                                    
                    </div>
            </div>
    </div>
        <?php } }?>
                           

<?php
}
?>