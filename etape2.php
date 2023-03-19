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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Incription</title>
</head>

<body>
    <form action="etape3.php" method="post">
        <input type="text" id="name" name="nom" required placeholder="nom"><span class="etoile">*</span><br>
        <input type="text" id="prenom" name="prenom" required placeholder="prenom"><span class="etoile">*</span><br>
        <input type="date" name="naissance" id="naissance" required>selectionné votre date de naissance <span class="etoile">*</span><br>
        <input type="text" name="ville" id="ville" required placeholder="Ville de résidence"><span class="etoile">*</span><br>
        <label for="classe">Classe: </label><span class="etoile"> *</span><br>
        <input type="checkbox" name="ING1" id="">ING1 &nbsp;
        <input type="checkbox" name="ING2" id="">ING2 &nbsp;
        <input type="checkbox" name="ING3" id="">ING3 &nbsp;
        <input type="checkbox" name="ING4" id="">ING4 &nbsp;
        <input type="checkbox" name="ING5" id="">ING5 &nbsp;
        <input type="checkbox" name="B1" id="">B1 &nbsp;
        <input type="checkbox" name="B2" id="">B2 &nbsp;
        <input type="checkbox" name="B3" id="">B3 &nbsp;
        <br>

        <input type="text" name="description" id="description" required placeholder="Entré une descritpion de vous:" minlength="25" maxlength="255"><span class="etoile">*</span><br>
        <input type="text" name="interet" id="interet" required placeholder="Vos centre d'interet" minlength="25" maxlength="255"><span class="etoile">*</span><br>
        <div class="mb-3">
            <label for="formFile" class="form-label">Chargé votre photo de profil</label> <span class="etoile">*</span>
            <input class="form-control" type="file" id="formFile">
        </div>
        <br>
        <input type="submit" value="Suivant">
    </form>
</body>

</html>