<?php
session_start();
$text = "";

if ($_POST['nbr'] != "")
{
	if (isset($_SESSION["login"]))
	{
		include_once("./ft_user.php");
		$co = ft_connect_db();
	$id = mysqli_real_escape_string($co, $_SESSION['id']);
		$res = mysqli_query($co, "SELECT * FROM panier WHERE id_user = " . $id);
		if ($res->num_rows == 0)
		{
			$res = mysqli_query($co, "INSERT INTO panier (id_user) VALUES(". $id . ")");
			echo "roor = " . mysqli_error($co);
			$_SESSION["pannier_id"] = mysqli_insert_id($co);
			$text = $text . " Pannier Cree ";
		}
		else
		{
			$result = mysqli_fetch_assoc($res);
			$_SESSION["pannier_id"] = $result["id"];
		}
	$id_pannier = mysqli_real_escape_string($co, $_SESSION['pannier_id']);
	$id_post_pannier = mysqli_real_escape_string($co, $_POST['id']);
		$res = mysqli_query($co, "SELECT * FROM panier_list WHERE id_panier = " . $id_pannier . " AND id_produit = " . $id_post_pannier);
		if ($res->num_rows == 0)
		{
	$post_nbr = mysqli_real_escape_string($co, $_POST['nbr']);
			$res = mysqli_query($co, "INSERT INTO panier_list (id_produit, id_panier, quantite) VALUES(". $id_post_pannier . "," . $id_pannier . "," . $post_nbr ." )");
			$text = $text . " Produit Ajoute ";
		}
		else
		{
	$post_nbr = mysqli_real_escape_string($co, $_POST['nbr']);
			$res = mysqli_query($co, "UPDATE panier_list SET quantite = " . $post_nbr . " WHERE id_panier = " . $id_pannier . " AND id_produit = ". $id_post_pannier);
			$text = $text . " Quantite modifiee ";
		}
	}
	else
	{
		if (!isset($_SESSION["pannier"]))
		{
			$text = $text . "Panier Cree ";
			$_SESSION["pannier"] = array();
		}
		$_SESSION["pannier"][$_POST['id']] = $_POST['nbr'];
		$text = $text . "produit ajoute";
	}
	echo $text;
}
?>
