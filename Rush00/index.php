<?php

include_once("./install.php");
include_once("./ft_user.php");
include_once(".config.php");

session_start();
$link = mysqli_connect($server_name, $id, $pw);
if (!mysqli_select_db ($link , "pokeshop" ))
	ft_install();

$co = ft_connect_db();
$res = mysqli_query($co, "SELECT * FROM produit");
$products= mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<html>
	<head>
	<link rel="stylesheet" href="head/header.css">
	<link rel="stylesheet" href="index.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION['login'])) echo $_SESSION["login"];?>'
	</script>
	</head>
	<body>
	<?php include 'head/header.php'; ?>
	<script src="head/header.js"></script>
	<div id = Bouttons>
	<button class="cat" id="button_ball">Balls</button>
	<button class="cat" id="button_baies">Baies</button>
	<button class="cat" id="button_soins">Soins</button>
	<button class="cat" id="button_autre">Autre</button>
	<button class="cat" id="button_all">Tout</button>
	</div>
	<div id=items>
<?php
foreach ($products as $produit)
{
	$stock = "";
	if ($produit['stock'] == 0) $stock = '<p class="stock_end"> Rupture de stock </p>';
	echo '<div class=" all_product ' . $produit['type'] .'"><img class="product_img" id="'.$produit['id'].'"src="' . $produit['image'] . '"><div id=nmsto><p class=>' . $produit["name"]. '</p>'. $stock .'</div></div>';
}
?>
</div>
	<script src="index.js"></script>
	</body>
</html>
