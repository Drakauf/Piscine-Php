<?php
session_start();
include_once("./ft_user.php");
$co = ft_connect_db();
			$get_id = mysqli_real_escape_string($co, $_GET["id"]);
$res = mysqli_query($co, "SELECT * FROM produit WHERE id = " . $get_id);
$product= mysqli_fetch_all($res, MYSQLI_ASSOC);
if ($res->num_rows == 0)
	header("location: index.php");
?>

<html>
	<head>
<link rel="stylesheet" href="head/header.css">
<link rel="stylesheet" href="product.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION['login'])) echo $_SESSION["login"];?>'
	</script>
	</head>
	<body>
<?php include 'head/header.php'; ?>
	<script src="head/header.js"></script>
<?php echo '<div id=allhere><form><div id=imgdiv><img id=imgproduit src="'.$product[0]['image'].'" ></div><div id=name><p>'.$product[0]["name"].'</p></div><div id=descrip><p>'.$product[0]['description'].'</p></div><div id=stock><p> En stock : '.$product[0]['stock'].'</p></div><div id=prix><p> Prix unitaire : '.$product[0]['prix'].'</p><img src="https://www.pokepedia.fr/images/e/e1/Pokedollar.png"></div><div id=msg></div><div><input type="hidden" id="productid" value="'. $product[0]['id'].'"><div id=order><input id="prodnumber" type="number" name=nbr min="0" max="'. $product[0]["stock"] . '" value=0></form>';
echo '<button id="addproduct" type="submit" form="addproduct" value="add">Ajouter</button></div>';
echo '<a href="./index.php">Retourner a l\'acceuil</a>'
?>
	</body>
	<script src="product.js"></script>
</html>
