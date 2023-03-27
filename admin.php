<?php
include "fonction.php";
mainHeader();
session_start();

if(isset($_GET['txt']) AND !empty($_GET['txt'])){
$pdo=connexion();
$stmt = $pdo->prepare('SELECT nom FROM user WHERE nom LIKE :nom ORDER BY nom ASC');
$stmt->bindValue(':nom', '%'.$_GET['txt'].'%');
$stmt->execute();
$resultat2 = $stmt->fetchAll();


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-6">
                <nav class="navbar navbar-expand-lg bg-body-tertiary" style="width: 90%; margin-left: 5%;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <form class="d-flex" role="search" method="GET">
                                    <input class="form-control me-2" type="search" placeholder="Search" name="txt" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit" value="Valider">Search</button>
                                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Trier
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">//</a></li>
                                        <li><a class="dropdown-item" href="#">//</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </nav>
                
                <div class="colonneAdmin" style="width: 90%; margin-left: 5%; " >
                <table class="table table-striped">
                    <tr>
                    <th>Photo</th><th>ID</th><th>Nom</th><th>Action</th>
                    </tr>
                <?php
                
                if(isset($_GET['txt']) && !empty($_GET['txt'])){
                    $pdo = connexion();
                    $stmt = $pdo->prepare('SELECT * FROM user WHERE nom LIKE :nom ORDER BY nom ASC');
                    $stmt->bindValue(':nom', '%'.$_GET['txt'].'%');
                    $stmt->execute();
                    $resultat2 = $stmt->fetchAll();
                
                    if(count($resultat2) > 0){
                        foreach($resultat2 as $ligne2){
                            $pp = $ligne2["pp"];
                            if(empty($pp)){
                                $pp = 'images/avatarbasique.png';
                            }
                            echo "<tr>
                                  <td class='align-middle'><img src='".$pp."' width='60'></td> 
                                  <td class='align-middle'>". $ligne2["idu"]."</td>
                                  <td class='align-middle'>". $ligne2["nom"]."</td>
                                  <td class='align-middle'> &nbsp;&nbsp;&nbsp;<a href='supprimer.php?idu=".$ligne2["idu"]."'<i class='fas fa-trash'></i></a></td>
                                  </tr>";
                        }
                    }else{
                        ?>
                        <p>Aucun résultat pour <?=$txt?></p>
                        <?php
                    }
                }else{
                    $pdo = connexion();
                    $req = "SELECT * FROM user";
                    $resultat = $pdo->prepare($req);
                    $resultat->execute();
                
                    while($ligne = $resultat->fetch()){
                        $pp = $ligne["pp"];
                        if(empty($pp)){
                            $pp = 'images/avatarbasique.png';
                        }
                        echo "<tr>
                              <td class='align-middle'><img src='".$pp."' width='60'></td> 
                              <td class='align-middle'>". $ligne["idu"]."</td>
                              <td class='align-middle'>". $ligne["nom"]."</td>
                              <td class='align-middle'> &nbsp;&nbsp;&nbsp;<a href='supprimer.php?idu=".$ligne["idu"]."'<i class='fas fa-trash'></i></a></td>
                              </tr>";
                    }
                }
                
                ?>
                </table>
                            </ul>


                </div>
            </div>
            <div class="col-6">
                <nav class="navbar navbar-expand-lg bg-body-tertiary" style="width: 90%; margin-left: 5%;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" id="recherche" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success"  id="look" value="look" onclick="trierPosts(recherche.value);">Search</button>
                                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Trier
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><button class="dropdown-item" id="tri" value="date" onclick="trierPosts(this.value);">Plus récent</button></li>
                                        <li><button class="dropdown-item" id="tri" value="fav" onclick="trierPosts(this.value);">Plus like</button></li>
                                        <li><button class="dropdown-item" id="tri" value="actu" onclick="trierPosts(this.value);">Actualité la plus like</button></li>
                                        <li><button class="dropdown-item" id="tri" value="event" onclick="trierPosts(this.value);">Evènement le plus like</button></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <div class="colonneAdmin" id="afficherPosts">

                </div>
            </div>
        </div>
    </div>
</body>
<?php
footer();
?>

</html>