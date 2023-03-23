<?php
include "fonction.php";
session_start();
// if (connecte() == False) {
//   header("location:index.php");
// }
// $idu = $_SESSION["idu"];

if (!empty($_POST["idd"])) {

    $pdo = connexion();
    $stmt = $pdo->prepare("SELECT * FROM post");
    $stmt->execute();
    $posts = $stmt->fetch();
?>
    <script>
        //$nbr = count($posts);
        alert("coucou 2 tavu = ");
    </script>

    <?php
    if (count($posts) > 0) {
        foreach ($posts as $post) {
            post($post);
        }
    } else { ?>
        <div style="background-color: red; height: 10px;">coucouuuuuuuuuuuuuuuuuuuu</div>
<?php
    }
}
?>