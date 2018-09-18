<?PHP
session_start();
?>

<html>
<head>
	<link rel="stylesheet" href="head/header.css">
	<link rel="stylesheet" href="pannier.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION["login"])) echo $_SESSION["login"];?>'
	</script>
	</head>
	<body>
	<?php include 'head/header.php'; ?>
	<script src="head/header.js"></script>
<div id=prodtable>
<div id=welcpannier><p>Votre pannier</p></div>

<?PHP
include_once("./ft_user.php");
$co = ft_connect_db();
$total = 0;
if (isset($_SESSION["login"]))
{
			$sess_id = mysqli_real_escape_string($co, $_SESSION["id"]);
	$res = mysqli_query($co, "SELECT * FROM panier WHERE id_user = " . $sess_id);
	if ($res->num_rows == 0)
	{
		echo "<div id=vide> <p> Votre n'avez pas de pannier sur notre base de donneee:( </p></div>";
		return;
	}
	else
	{
		$result = mysqli_fetch_assoc($res);
		$_SESSION["pannier_id"] = $result["id"];
	}
			$sess_pan_id = mysqli_real_escape_string($co, $_SESSION["pannier_id"]);
	$res = mysqli_query($co, "SELECT * FROM panier_list WHERE id_panier = " . $sess_pan_id . " AND quantite != 0");
	if ($res->num_rows == 0)
	{
		echo "<div id=vide><p> Votre pannier est vide sur notre base de donnee :( </p></div>";
		return;
	}
	else
	{
		$result = mysqli_fetch_all($res, MYSQLI_ASSOC);
		foreach($result as $tab)
		{
			$tab_prod = mysqli_real_escape_string($co, $tab["id_produit"]);
			$produitres = mysqli_query($co, "SELECT * FROM produit WHERE id = " . $tab_prod);
			$produit = mysqli_fetch_assoc($produitres);
			$subtotal = $produit["prix"] * $tab['quantite'];
			$total = $total + $subtotal;
			echo "<div class=ligneprod><div class=imgdiv><img class=prodimg src=" . $produit['image'] . "></div><div class=prodname><p>" . $produit['name'] . " </p></div><div class=proddesc><p>" . $produit['description']. "</p></div><div class=priunit><p>Prix unitaire</p><p>" . $produit['prix']. " </p></div><div class=qt><p> Quantite </p><p> " . $tab['quantite'] . " </p></div><div class=subtot><p>Sous Total</p><p> " .  $subtotal . " </p></div></div>";
		}
		echo "<div id=tot><div id=total><p>Total</p></div><div id=pripannier><p>". $total . "</p><img src=https://www.pokepedia.fr/images/e/e1/Pokedollar.png></div></div>";
		echo "<div id=butdiv><div id=panval></div><button id=validate> Valider mon pannier </button></div>";
	}
}
else
{
	if (!isset($_SESSION['pannier']))
		echo "votre pannier est vide";
	else
	{
		$tab = $_SESSION['pannier'];
		foreach($tab as $id => $quantite)
		{
			$produitres = mysqli_query($co, "SELECT * FROM produit WHERE id = " . $id);
			$produit = mysqli_fetch_assoc($produitres);
			$subtotal = $produit["prix"] * $quantite;
			$total = $total + $subtotal;
			echo "<div class=ligneprod><div class=imgdiv><img class=prodimg src=" . $produit['image'] . "></div><div class=prodname><p>" . $produit['name'] . " </p></div><div class=proddesc><p>" . $produit['description']. "</p></div><div class=priunit><p>Prix unitaire</p><p>" . $produit['prix']. " </p></div><div class=qt><p> Quantite </p><p> " . $quantite . " </p></div><div class=subtot><p>Sous Total</p><p> " .  $subtotal . " </p></div></div>";
		}
		echo "<div id=tot><div id=total><p>Total</p></div><div id=pripannier><p>". $total . "</p><img src=https://www.pokepedia.fr/images/e/e1/Pokedollar.png></div></div>";
	}
	if (!isset($_SESSION["login"]))
		echo "<div id=inscritoi><p>Vous devez vous connecter pour continuer votre achat</p></br><a href='index.php'> Acceuil</a></div>";
}
?>
	<script src="pannier.js"></script>
</div>
</body>
</html>
