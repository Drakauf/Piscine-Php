<?php
include ("./ft_user.php");
function ft_create_table($server_name, $user_name, $password)
{
	$co = mysqli_connect($server_name, $user_name, $password, "Pokeshop");
	$sql = "CREATE TABLE `user` (
			id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			login VARCHAR(20) NOT NULL,
			mdp VARCHAR(256) NOT NULL,
			status INT(1))";
	if (!mysqli_query($co, $sql))
	{
		echo "Error creating table : " . mysqli_error($co);
		return (0);
	}
$sql = "CREATE TABLE `produit` (
			id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			name VARCHAR(20) NOT NULL,
			image VARCHAR(256) NOT NULL,
			type VARCHAR(30) NOT NULL,
			description VARCHAR(256) NOT NULL,
			prix INT(255) NOT NULL,
			stock INT(255))";
	if (!mysqli_query($co, $sql))
	{
		echo "Error creating table : " . mysqli_error($co);
		return (0);
	}
$sql = "CREATE TABLE `panier` (
			id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			id_user INT(255),
			valide INT(1),
			FOREIGN KEY (id_user) REFERENCES `user`(id))";
	if (!mysqli_query($co, $sql))
	{
		echo "Error creating table : " . mysqli_error($co);
		return (0);
	}

$sql = "CREATE TABLE `panier_list` (
			id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			id_produit INT(255) NOT NULL,
			id_panier INT(255) NOT NULL,
			quantite INT(255),
			FOREIGN KEY (id_produit) REFERENCES produit(id),
			FOREIGN KEY (id_panier) REFERENCES panier(id))";
	if (!mysqli_query($co, $sql))
	{
		echo "Error creating table : " . mysqli_error($co);
		return (0);
	}
$sql = "CREATE TABLE `favoris` (
			id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			id_user INT(255) NOT NULL,
			id_produit INT(255) NOT NULL,
			FOREIGN KEY (id_user) REFERENCES user(id),
			FOREIGN KEY (id_produit) REFERENCES produit(id))";
	if (!mysqli_query($co, $sql))
	{
		echo "Error creating table : " . mysqli_error($co);
		return (0);
	}
	return (1);

}

function ft_make_product()
{
	if (($db = ft_connect_db()) === FALSE)
{
	header("Location:./index.php?gkyfhn");
		return (FALSE);
}
	ft_add_product('pokeball', 'https://www.pokepedia.fr/images/d/d6/Pok%C3%A9_ball_artwork.png', 'ball', "ball de base permettant de capturer des pokemons", '200', '1500');
	ft_add_product('superball', 'https://www.pokepedia.fr/images/d/d6/Super_ball_artwork.png', 'ball', "ball qui permet de capturer des pokemons plus facilement qu\'avec une simple pokeball", '600', '1000');
	ft_add_product('hyperball', 'https://www.pokepedia.fr/images/7/7a/Hyper_ball_artwork.png', 'ball', "ball puisante permettant de capturer des pokemons avec un haut taux de capture", '800', '500');
	ft_add_product('potion', 'https://www.pokepedia.fr/images/7/7a/Potion.png', 'soin', "potion qui soigne les pokemons de 20 pv", '200', '2000');
	ft_add_product('super potion', 'https://www.pokepedia.fr/images/8/8f/Super_Potion.png', 'soin', "potion un peu plus efficace que la simple potion, elle soigne 50 pv", '700', '800');
	ft_add_product('hyper potion', 'https://www.pokepedia.fr/images/2/23/Hyper_Potion.png', 'soin', "potion bien plus efficace que la super potion, elle soigne 200 pv", '800', '400');
	ft_add_product('baie oran', 'https://www.pokepedia.fr/images/d/da/Baie_Oran.png', 'baie', "baie pouvant etre tenue par un pokemon, qui restaure 20 pv", '50', '2500');
	ft_add_product('baie pecha', 'https://www.pokepedia.fr/images/1/18/Baie_Pecha.png', 'baie', "baies qui soignent de l\'empoisonnement", '69', '101');
	ft_add_product('baie ceriz', 'https://www.pokepedia.fr/images/5/5b/Baie_Ceriz.png', 'baie', "baies qui soignent la paralisie", '60', '2300');
	ft_add_product('ct destruction', 'http://www.pokemontrash.com/images/rouge-bleu-jaune/CT.png', 'autre', "Mieux vaut s\'ecarter...", '4000', '14');
	ft_add_product('ct patience', 'http://www.pokemontrash.com/images/rouge-bleu-jaune/CT.png', 'autre', "Tu peux regarder un combat entre deux magicarpes pendant ce temps", '2500', '14');
	ft_add_product('ct sacrifice', 'http://www.pokemontrash.com/images/rouge-bleu-jaune/CT.png', 'autre', "Quand tu n\'aime pas trop ton pokemon", '5000', '14');
	ft_add_product('rappel', 'https://www.pokepedia.fr/images/1/13/Rappel.png', 'soin', "permet de reanimer un pokemon k.o et soigne la moitie des pv max du pokemon", '1000', '150');
	ft_add_product('rappel max', 'https://www.pokepedia.fr/images/a/ab/Rappel_Max.png', 'soin', "soigne le pokemon k.o et restaure tout ses pv", '2000', '50');
return (1);
}





function ft_add_product($name, $image, $type, $description, $prix, $stock)
{
	if (!isset ($name, $prix, $image, $description, $type, $stock) || $name === ""|| $prix === ""|| $image === ""|| $description === ""|| $type === "" || $stock === "")
		return (FALSE);
	if (($db = ft_connect_db()) === FALSE)
		return (FALSE);
	$resul = mysqli_query($db, 'SELECT name FROM produit');
	while($donn = mysqli_fetch_assoc($resul))
	{
		if ($donn["name"] === $name)
		{
			echo "Ca existe deja du con\n";
			return (FALSE);
		}
	}
			$name = mysqli_real_escape_string($db, $name);
			$image = mysqli_real_escape_string($db, $image);
			$type = mysqli_real_escape_string($db, $type);
			$description = mysqli_real_escape_string($db, $description);
			$prix = mysqli_real_escape_string($db, $prix);
			$stock = mysqli_real_escape_string($db, $stock);
	if (!mysqli_query($db, "INSERT INTO produit (name, image, type, description, prix, stock) VALUES ('$name', '$image', '$type', '$description', '$prix', '$stock')"))
		return (0);
	return (1);
}

function ft_install()
{
	$server_name = $_SERVER['REMOTE_ADDR'];
	$user_name = "root";
	$password = "shanko";

	$co = mysqli_connect($server_name, $user_name, $password);
	if (!$co)
		("Connection failed : " . mysqli_connect_error());
	$sql = "CREATE DATABASE Pokeshop";
	if (!mysqli_query($co, $sql))
		echo "Error creating database : " . mysqli_error($co);
	if (!ft_create_table($server_name, $user_name, $password))
		return (0);
	if (!ft_make_admin("admin", "rootman"))
		return (0);
	if (!ft_make_product())
		return (0);
}

?>
