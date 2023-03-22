<?php
include "fonction.php";
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
    <title>Document</title>
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-6">
                <nav class="navbar navbar-expand-lg bg-body-tertiary" style="width: 80%; margin-left: 10%;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Trier
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Plus liké</a></li>
                                        <li><a class="dropdown-item" href="#">Plus récent</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </nav>
                <div class="colonneAdmin">
                <table class="table table-striped">
                    <tr>
                        <th>Photo</th><th>ID</th><th>Nom</th><th>Action</th>
                    </tr>
                <?php
                    connexion();
                    $req="select * from user";
                    $resultat = $pdo->prepare($req);
                    $resultat = execute();
                    while($ligne=$resultat->fetchAll())
                {
                    
                    echo "<tr>
                    <td class='align-middle'><img src='". $ligne["photo"]."' width='60'></td>
                    <td class='align-middle'>". $ligne["idu"]."</td>
                    <td class='align-middle'>". $ligne["nom"]."</td>
                    <a class='btn btn-danger' href='#>Supprimer</a></td>
                    </tr>";
                }
                ?>

                </table>
                            </ul>


                </div>
            </div>
            <div class="col-6">
            <nav class="navbar navbar-expand-lg bg-body-tertiary" style="width: 80%; margin-left: 10%;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Trier
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><button class="dropdown-item">Plus liké</button></li>
                                        <li><a class="dropdown-item" href="#">Plus récent</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <div class="colonneAdmin">

                </div>
            </div>
        </div>
    </div>
</body>
<?php
footer();
?>

</html>