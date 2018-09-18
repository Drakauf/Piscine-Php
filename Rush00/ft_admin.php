<?PHP
include_once("./install.php");

session_start();
function ft_modif_product($name, $prix, $stock)
{
	if (!isset ($name, $prix, $stock) || $name === "" || $prix === "" ||  $stock === "")
		return (FALSE);
	if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
	$resul = mysqli_query($db, 'SELECT *  FROM produit');
	while($donn = mysqli_fetch_assoc($resul))
	{
		if ($donn["name"] === $name)
		{
			$prix = mysqli_real_escape_string($db, $prix);
			$stock = mysqli_real_escape_string($db, $stock);
			$name = mysqli_real_escape_string($db, $name);
			if (mysqli_query($db, "UPDATE produit SET prix = '$prix', stock = '$stock'  WHERE name = '$name';"))
				return (1);
		}
	}
	return (0);
}

function ft_go_admin($login)
{
	if (!isset ($login) || $login === "")
		return (FALSE);
	if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
	$resul = mysqli_query($db, 'SELECT *  FROM user');
	while($donn = mysqli_fetch_assoc($resul))
	{
		if ($donn["name"] === $name)
		{
			$login = mysqli_real_escape_string($db, $login);
			if (mysqli_query($db, "UPDATE user SET status = '1'  WHERE login = '$login';"))
				return (1);
		}
	}
	return (0);
}

if ((!(isset($_SESSION["is_admin"]))) || $_SESSION["is_admin"] !== '1')
	header("Location:./index.php?rt=lol&dommage=fdp");

if (isset($_POST["name_add_product"], $_POST["img"], $_POST["type"], $_POST["description"], $_POST["prix"], $_POST["stock"], $_POST["product_add"]))
{
	if (ft_add_product($_POST["name_add_product"], $_POST["img"], $_POST["type"], $_POST["description"], $_POST["prix"], $_POST["stock"]))
		header("Location:./ft_admin.php?add_product=success");
	else
		header("Location:./ft_admin.php?add_product=fail");
}

if (isset($_POST["name_product"], $_POST["new_prix"], $_POST["new_stock"], $_POST["modif_product"]))
{
	if (ft_modif_product($_POST["name_product"], $_POST["new_prix"], $_POST["new_stock"]))
		header("Location:./ft_admin.php?modif_product=success");
	else
		header("Location:./ft_admin.php?modif_product=fail");
}

if (isset($_POST["login"], $_POST["admin"]))
{
	if (ft_go_admin($_POST["login"]))
		header("Location:./ft_admin.php?make_admin=success");
	else
		header("Location:./ft_admin.php?make_admin=fail");
}


?>


<html>

	<head>
<link rel="stylesheet" href="head/header.css">
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="ft_admin.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION['login'])) echo $_SESSION["login"];?>'
	</script>
	</head>
	<body>
<body>
	<?php include 'head/header.php'; ?>
	<script src="head/header.js"></script>
	
<div id=adminadd>
	<form method="post">
		<legend> Ajouter un produit</legend>
			</br>
			Nom du produit: <input type="text" name="name_add_product" /><br />
			Lien image: <input type="text" name="img" /><br />
			Type:	<select name="type">
						<option  value="ball">Ball</option>
						<option value="baie">Baie</option>
						<option value="soin">Soin</option>
						<option value="autre">Autre</option>
					</select></br>
			Description: <input type="text" name="description" /><br />
			Prix: <input type="text" name="prix" /><br />
			Stock: <input type="text" name="stock" /><br />
			<input type="submit" name="product_add" value="OK" />
	</form>
</div>
	<form method="post">
		<legend> Modifier le stock</legend>
			</br>
			Nom du produit: <input type="text" name="name_product" /><br />
			Prix: <input type="text" name="new_prix" /><br />
			Stock: <input type="text" name="new_stock" /><br />
			<input type="submit" name="modif_product" value="OK" />
	</form>

	<form method="post">
		<legend> Passer un membre administrateur</legend>
			</br>
			Login: <input type="text" name="login" /><br />
			<input type="submit" name="admin" value="OK" />
	</form>

	<form method="post">
		<legend> Voir l'historique des commandes</legend>
			</br>
			<button id=test><a href="./ft_commande_hist.php">Historique des commandes</a></button>
	</form>
</div>
	</body>
</html>
