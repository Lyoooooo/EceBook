<?php
include "fonction.php";
connecte();
$idp = $_GET["idp"];
$pdo = connexion();
$stmt = $pdo->prepare("DELETE FROM post WHERE idp=?");
$stmt->execute([$idp]);
?>

<script>
window.history.back();
</script>