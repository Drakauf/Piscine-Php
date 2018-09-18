<?php
session_start();
include 'ft_user.php';
$co = ft_connect_db();
$id = mysqli_real_escape_string($co, $_SESSION['id']);
$res = mysqli_query($co, "UPDATE panier SET valide = 1  WHERE id_user = " . $id);
echo "<p style=text-align:center;>Votre pannier est signele comme clos, il est en attente de validation par un administrateur</p>";
?>
