<?php
include "fonction.php";
$pdo = connexion();
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
    <script src="securite.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>

<body style="background-color: white;">
    <form action="inscription2.php" method="post" enctype="multipart/form-data" onsubmit="convertToLowercase()">
        <div class="tab">
            <div class="row g-3 position-absolute top-50 start-50 translate-middle rounded shadow text-center " id="primal">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link  disabled" id="insc1-tab" data-bs-toggle="tab" data-bs-target="#insc1-tab-pane" type="button" role="tab" aria-controls="insc1-tab-pane" aria-selected="false">Etape 1</button>

                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link disabled" id="insc2-tab" data-bs-toggle="tab" data-bs-target="#insc2-tab-pane" type="button" role="tab" aria-controls="insc2-tab-pane" aria-selected="false">Etape 2</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link disabled" id="insc3-tab" data-bs-toggle="tab" data-bs-target="#insc3-tab-pane" type="button" role="tab" aria-controls="insc3-tab-pane" aria-selected="false">Etape 3</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active disabled" id="insc4-tab" data-bs-toggle="tab" data-bs-target="#insc4-tab-pane" type="button" role="tab" aria-controls="insc4-tab-pane" aria-selected="true">Etape finale</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <script>
                        var ongletActif = document.querySelector('.nav-link.active');
                        if (ongletActif) {
                            ongletActif.style.backgroundColor = "#ff621f";
                            ongletActif.style.color = "#fff";
                        }

                        // Changer la couleur de fond et le texte des autres onglets
                        var onglets = document.querySelectorAll('.nav-link:not(.active)');
                        onglets.forEach(function(onglet) {
                            onglet.style.backgroundColor = "#fff";
                            onglet.style.color = "#000";
                        });
                    </script>

                    <!-- page 4-->



                    <div class="tab-pane fade show active" id="insc4-tab-pane" role="tabpanel" aria-labelledby="insc4-tab" tabindex="0">
                        <p>Veuillez vérifier votre boîte de réception pour compléter votre inscription.</p>
                        <button type="button" class="btn btn-primary mb-3"><a href="connexion.php" style="color: #ff621f ;text-decoration: none;">Connexion</a></button>
                    </div>
                </div>
            </div>
        </div>
    </form>


</body>

</html>