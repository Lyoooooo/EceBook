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
    <footer class='text-center text-white' style='background-color: rgba(0, 0, 0, 0.904);color:white; width: 100%; z-index: 9;'>

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
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; box-shadow: 0px 2px 3px #FFE2D6;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">EceBook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
$statement -> bindValue(':idp', $idp, PDO::PARAM_INT);
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