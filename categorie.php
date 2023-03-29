<?php
include "fonction.php";
include "fonctionRequete.php";
connecte();
$pdo = connexion();
mainHeader();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Categorie</title>
</head>
<?php

$idcategorie = $_GET["idcategorie"];
if($idcategorie == 1){
    $req = "SELECT * FROM post WHERE typep = 'general' ORDER BY date DESC";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $typep = 'Général';
}elseif($idcategorie == 2){
    $req = "SELECT * FROM post WHERE typep = 'actualite' ORDER BY date DESC ";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $typep='Actualité';
}elseif($idcategorie == 3){
    $req = "SELECT * FROM post WHERE typep = 'evenement'  ORDER BY date DESC";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $typep='Evénement';
}else{
    $req = "SELECT * FROM post ";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
}

$cat = $stmt->fetchAll();
?>
<div class="central">
        <!-- post feed actualité -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper container">
                    <div class="row">
                        <div class="grid-margin stretch-card">
                            <div class="card-body">
                                <h4 class="px-5 p-3 bg-white border-warning" style="color:#FF621F"> <?=$typep?> </h4>
                                <div class="container px-5 p-3">
                                    <div class="row">
                                        <?php
                                      
                                        
                                            foreach ($cat as $post) {
                                                post($post);
                                            }
                                        

                                        ?>

                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

<?php
    footer();
?>


</html>