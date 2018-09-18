<?php

include("./ft_user.php");


function ft_is_admin($login)
{
	if (($co = ft_connect_db()) === FALSE)
		return (FALSE);
			$login = mysql_real_escape_string($login);
	$result = mysqli_query($co, "SELECT status FROM user WHERE login = '$login'");
	$check = mysqli_fetch_array($result);
	if (isset($check["status"]) && $check["status"] === '1')
		return (1);
	return NULL;
}



function fillpannier()
{
	$co = ft_connect_db();
	foreach($_SESSION["pannier"] as $id => $nbr)
	{
			$sess_id = mysqli_real_escape_string($co, $_SESSION["id"]);
		$res = mysqli_query($co, "SELECT * FROM panier WHERE id_user = " . $sess_id);
		if ($res->num_rows == 0)
		{
			$res = mysqli_query($co, "INSERT INTO panier (id_user) VALUES(". $sess_id . ")");
			$_SESSION["pannier_id"] = mysqli_insert_id($co);
		}
		else
		{
			$result = mysqli_fetch_assoc($res);
			$_SESSION["pannier_id"] = $result["id"];
		}
			$sess_pan_id = mysqli_real_escape_string($co, $_SESSION["pannier_id"]);
		$res = mysqli_query($co, "SELECT * FROM panier_list WHERE id_panier = " . $sess_pan_id . " AND id_produit = " . $id);
		if ($res->num_rows == 0)
		{
			$res = mysqli_query($co, "INSERT INTO panier_list (id_produit, id_panier, quantite) VALUES(". $id . "," . $sess_pan_id . "," . $nbr ." )");
		}
		else
		{
			$res = mysqli_query($co, "UPDATE panier_list SET quantite = " . $nbr . " WHERE id_panier = " . $sess_pan_id . " AND id_produit = ". $id);
		}
	}
}



function ft_connexion()
{
	$login = $_POST["login"];
	$password = hash("whirlpool", $_POST["password"]);
	if (($co = ft_connect_db()) === FALSE)
		return (FALSE);
			$login = mysqli_real_escape_string($co, $login);
			$password = mysqli_real_escape_string($co, $password);
	$result = mysqli_query($co, "SELECT * FROM user WHERE login = '$login' AND mdp = '$password'");
	$check = mysqli_fetch_array($result);
	if (!isset($check))
	{
		header("Location:./ft_connection.php?co=fail");
		exit();
	}
	$_SESSION["login"] = $login;
	$_SESSION["is_admin"] = ft_is_admin($login);
	$_SESSION["id"] = $check["id"];
			$sess_id = mysqli_real_escape_string($co, $_SESSION['id']);
	$result = mysqli_query($co, "SELECT id FROM panier WHERE id_user =". $sess_id);
	$check = mysqli_fetch_array($result);
	if (isset($_SESSION["pannier"]))
		fillpannier();
		header("Location:./index.php");
}

session_start();
if (isset($_POST["login"], $_POST["password"]))
	ft_connexion();


?>


<html>
	<head>
	</head>
	<body>
	
<?PHP    if (isset($_GET["co"]) && $_GET["co"] === "fail")
echo "vous m'etes inconnu dresseur de pacotille\n";
?>

		<form method="post">
			Login : <input type = "text" name = "login" /> <br/>
			Mot de passe : <input type = "password" name = "password" /> <br/>
			<input type = "submit" name = "OK" /> <br/>
			<button> <a href="./index.php">Home</a></button><br/>
			<button> <a href="./ft_inscription.php">Inscription</a></button><br/>
		</form>

	</body>
</html>
