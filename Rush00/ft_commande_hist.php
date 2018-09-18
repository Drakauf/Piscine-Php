<?PHP
include_once("./install.php");
session_start();
if ((!(isset($_SESSION["is_admin"]))) || $_SESSION["is_admin"] !== '1')
	header("Location:./index.php?rt=lol&dommage=fdp");

function ft_recup_image_product($id)
{
if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
			$id = mysqli_real_escape_string($db, $id);
	$produit = mysqli_query($db, 'SELECT image  FROM produit WHERE id = '.$id);
	$donnee_produit = mysqli_fetch_assoc($produit);
	return ($donnee_produit["image"]);
}

function ft_recup_name_product($id)
{
if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
			$id = mysqli_real_escape_string($db, $id);
	$produit = mysqli_query($db, 'SELECT name  FROM produit WHERE id = '.$id);
	$donnee_produit = mysqli_fetch_assoc($produit);
	return ($donnee_produit["name"]);
}

function ft_recup_type_product($id)
{
if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
			$id = mysqli_real_escape_string($db, $id);
	$produit = mysqli_query($db, 'SELECT type  FROM produit WHERE id = '.$id);
	$donnee_produit = mysqli_fetch_assoc($produit);
	return ($donnee_produit["type"]);
}

function ft_recup_prix_product($id)
{
if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
			$id = mysqli_real_escape_string($db, $id);
	$produit = mysqli_query($db, 'SELECT prix  FROM produit WHERE id = '.$id);
	$donnee_produit = mysqli_fetch_assoc($produit);
	return ($donnee_produit["prix"]);
}

	if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
	$panier = mysqli_query($db, 'SELECT *  FROM panier');
?>


<html>
	<head>
<link rel="stylesheet" href="head/header.css">
	<link rel="stylesheet" href="historique.css">
	<script type="text/javascript">
	var log='<?php if (isset($_SESSION['login'])) echo $_SESSION["login"];?>'
	</script>
	<head>
	<body>
<?php include 'head/header.php'; ?>
	<script src="head/header.js"></script>
	<div id=listes>
<?php 
	while($donnee_panier = mysqli_fetch_assoc($panier))
	{
		
			$d_pa = mysqli_real_escape_string($db, $donnee_panier["id_user"]);
		$login = mysqli_query($db, 'SELECT login  FROM user WHERE id ='. $d_pa);
			while($donn_log = mysqli_fetch_assoc($login))
				print ("<div id=cmduser><div id=usrname><p class=texte>". $donn_log["login"] . "</p></div>");
		$total = 0;
			$d_pa_id = mysqli_real_escape_string($db, $donnee_panier["id"]);
		$list_panier = mysqli_query($db, 'SELECT *  FROM panier_list WHERE id_panier ='. $d_pa_id);
			while($donnee = mysqli_fetch_assoc($list_panier))
			{
				$i = ft_recup_image_product($donnee["id_produit"]);
				$n = ft_recup_name_product($donnee["id_produit"]);
				$t = ft_recup_type_product($donnee["id_produit"]);
				$p = ft_recup_prix_product($donnee["id_produit"]);
				$subtotal = $p * $donnee["quantite"];
				$total = $total + ($p * $donnee["quantite"]);
				print("<div id=produit><div class=imgdiv><img class=prodimg src=" . $i . "></div>");
				print("<div class=prodname><p>" . $n . " </p></div>");
				print("<div class=priunit><p>Prix unitaire</p><p>" . $p . " </p></div>");
				print("<div class=qt><p> Quantite </p><p> " . $donnee["quantite"] . " </p></div>");
				print("<div class=subtot><p>Sous Total</p><p> " .  $subtotal . " </p></div></div>");
			}		
			print "<div id=tot><div id=total><p>Total</p></div><div id=pripannier><p>". $total . "</p><img src=https://www.pokepedia.fr/images/e/e1/Pokedollar.png></div></div></div>";
	}
?>
</div>
	</body>
</html>
