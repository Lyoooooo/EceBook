<?php
include "fonction.php";
session_start();
mainHeader();
$pdo = connexion();
$res = $pdo->prepare("SELECT * FROM post");
$res->execute();
$tab = $res->fetchAll();
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
    <title>Document</title>
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
                                <h4 class="px-5 p-3 bg-white border-top border-warning" style="color:#FF621F"> titre à mettre </h4>
                                <div class="container px-5 p-3">
                                    <div class="row">
                                        <?php
                                        if (count($tab) > 0) {
                                            foreach ($tab as $post) {
                                                post($post);
                                            }
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
    <?php if(connecte() == True){?>
    <!-- Button trigger modal -->
    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="position: fixed; bottom: 10%; right: 5%; border: 0px; background-color:rgba(0,0,0,0); z-index: 1;">
        <img src="images/boutonAddPost.webp" alt="" style="height: 60px;">
    </button>
    <?php ajoutpost(); }?>
    <!-- Modal -->
    <?php
    footer();
    ?>
</body>

<?php
if (isset($_POST["bouton"])) {
    extract($_POST);
    extract($_FILES);
    $idu = $_SESSION["idu"];
    $pdo = connexion();
    if ($photo == "") {
        $photo = "vide";
    } else {
        $photo = ajoutphoto($idu, $photo);
    }
    $stmt = $pdo->prepare("INSERT INTO post VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([null, $idu, $titre, $texte, $photo, $type, 0, 0, 0, date("Y-m-d H:i:s")]);
?>
    <meta http-equiv="refresh" content="1">
<?php   }
?>

</html>