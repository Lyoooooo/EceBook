<?php
include "fonction.php";
include "fonctionRequete.php";

connecte();
$pdo = connexion();
// On détermine sur quelle page on se trouve
// Récupération du nombre total d'éléments
$total = $pdo->query("SELECT COUNT(*) FROM post")->fetchColumn();
// Détermination du nombre d'éléments à afficher par page
$per_page = 10;
// Calcul du nombre total de pages
$total_pages = ceil($total / $per_page);
// Récupération du numéro de page courant à partir de l'URL
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
// Calcul de l'offset pour la requête SQL
$offset = ($current_page - 1) * $per_page;
// Exécution de la requête SQL pour récupérer les éléments de la page courante
$stmt = $pdo->prepare("SELECT * FROM post LIMIT $offset, $per_page");
$stmt->execute();
$results = $stmt->fetchAll();


//on selectionne tous les  posts
$res = $pdo->prepare("SELECT * FROM post ORDER BY date DESC limit 10");
$res->execute();
$tab = $res->fetchAll();
mainHeader();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/e_now_logo2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>e-now</title>
</head>


<body>

    <div class="central">
        <!-- post feed actualité -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper container">
                    <div class="row">
                        <div class="grid-margin stretch-card">
                            <div class="card-body">
                                <h4 class="px-5 p-3 bg-white border-warning text-center" style="color:#FF621F; "> POSTS </h4>
                                <div class="container px-5 p-3">
                                    <div class="row">
                                        <?php
                                        if (count($tab) > 0) {
                                            foreach ($tab as $post) {
                                                $query = $pdo->prepare("SELECT * FROM ami WHERE ((idu1 = :idu AND idu2 = :ida) OR (idu1 = :ida AND idu2 = :idu)) AND valide=1"); //regarde si il y a une demande
                                                $query->bindParam(':idu', $_SESSION["idu"]);
                                                $query->bindParam(':ida', $post["idu"]);
                                                $query->execute();
                                                if ($query->rowCount() > 0 || $_SESSION["grade"]==4 || $_SESSION["idu"]==$post["idu"]) { 
                                                    post($post);                            
                                                }           
                                            }
                                        }
                                        echo '<div class="pagination">';
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            // Ajout d'un lien pour chaque page
                                            echo '<a class="btn btn-inverse-warning" style="border: 1px solid; color:#FF621F" href="index.php?page=' . $i . '">' . $i . '</a> ';
                                        }
                                        echo '</div>';
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
    <!-- Button trigger modal -->
    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="position: fixed; bottom: 10%; right: 5%; border: 0px; background-color:rgba(0,0,0,0); z-index: 1;">
        <img src="images/boutonAddPost.webp" alt="" style="height: 60px;">
    </button>
    <?php ajoutpost(); ?>
    <!-- Modal -->
    <?php
    footer();
    ?>
</body>

</html>