<?php
include "fonction.php";
mainHeader();
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
<<<<<<< Updated upstream
        <!-- post feed actualité -->
=======
>>>>>>> Stashed changes
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">


                <div class="row">

                    <div class="grid-margin stretch-card">
                        
                            <div class="card-body">
                                <?php AfficherPost(); ?>                        
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
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
                            <input type="file" class="form-control" id="inputGroupFile01" name="photo">
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
    footer();
    ?>
</body>
<?php
if (isset($_POST["bouton"])) {
    extract($_POST);
    $pdo = connexion();
    if ($photo == "") {
        $photo = "vide";
    }else{
        $photo = "imagesPosts/" + $photo;
    }
    $stmt = $pdo->prepare("INSERT INTO post VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->execute([null, $titre, $texte, $photo, $type, 0, 0, 0, date("Y-m-d H:i:s")]);
    header("Location: index.php");
    die();
}
?>

</html>