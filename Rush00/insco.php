<?php


include_once("./ft_user.php");

function ft_user_exists($login)
{
	if (($co = ft_connect_db()) === FALSE)
		return (TRUE);
			$login = mysqli_real_escape_string($co, $login);
	$result = mysqli_query($co, "SELECT * FROM user WHERE login = '$login'");
	$check = mysqli_fetch_array($result);
	if (!isset($check))
		return (FALSE);
	return (TRUE);
}

if (isset($_GET["ilogin"], $_GET["ipasswd"], $_GET["ipasswd2"]))
{
	$login = $_GET['ilogin'];
	$passwd = $_GET['ipasswd'];
	$passwd2 = $_GET['ipasswd2'];

	$pw = hash("whirlpool", $passwd);
	if ($passwd !== $passwd2)
		$insfail = 1;
	else if (ft_user_exists($login) === TRUE)
		$insfail = 2;
	else
	{
		if (($db = ft_connect_db()) === FALSE)
			$insfail = 3;
		$login = mysqli_real_escape_string($db, $login);
		$pw = mysqli_real_escape_string($db, $pw);
		if (!(mysqli_query($db, "INSERT INTO user (login, mdp, status) VALUES ('$login', '$pw', '0')")))
			$insfail = 3;	
		else
			$res = 1;
	}
}


function ft_is_admin($login)
{
	if (($co = ft_connect_db()) === FALSE)
		return (FALSE);
			$login = mysqli_real_escape_string($co, $login);
	$result = mysqli_query($co, "SELECT status FROM user WHERE login = '$login'");
	$check = mysqli_fetch_array($result);
	if (isset($check["status"]) && $check["status"] === '1')
		$_SESSION["is_admin"] = '1';
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


session_start();
if (isset($_GET["login"], $_GET["password"]))
{
	$login = $_GET["login"];
	$password = hash("whirlpool", $_GET["password"]);
	if (($co = ft_connect_db()) === FALSE)
		return (FALSE);
			$login = mysqli_real_escape_string($co, $login);
			$password = mysqli_real_escape_string($co, $password);
	$result = mysqli_query($co, "SELECT * FROM user WHERE login = '$login' AND mdp = '$password'");
	$check = mysqli_fetch_array($result);
	if (!isset($check))
	{
		$cofail = 2;
	}
	else
	{
		$_SESSION["login"] = $login;
		ft_is_admin($login);
		$_SESSION["id"] = $check["id"];
			$sess_id = mysqli_real_escape_string($co, $_SESSION['id']);
		$result = mysqli_query($co, "SELECT id FROM panier WHERE id_user =". $sess_id);
		$check = mysqli_fetch_array($result);
		if (isset($_SESSION["pannier"]))
			fillpannier();
		header("Location:./index.php");
	}
}


?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Camagru</title>
		<link rel="stylesheet" href="connection.css">
		<link rel="stylesheet" href="./head/header.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION['login'])) echo $_SESSION["login"];?>'
	</script>
		<script type="text/javascript"> var c='<?php if (isset($insfail) && $insfail != 0) {echo 0;} else {echo (1);}?>';</script>
<script type="text/javascript"> var c='<?php if (isset($insfail) && $insfail != 0) {echo 0;} else {echo (1);}?>';</script>
	</head>
	<body>
		<?php include './head/header.php'; ?>	
	<script src="./head/header.js"></script>
		<div id="menu">
			<button type="text" id="co">Connection</button>
			<button type="text" id="in">Inscription</button>
		</div>
		<?php /* --------------- --------------- --------------- Form pour inscription --------------- --------------- --------------- */ ?>
		<div id="inscription">
			<p id="intro">texte pour lefun fjhwevfhjewj fewjfbjewbf bfjqbfjb jkwebfk bewfkbewk bfkewbfjk fjkbewjkbf jkewbkjb ewjkfbejkwbf jkewbfjkbewjk bfewjkbf jkewbfjkbewjkfb jkewbfjkewbfjk bewjkfbjk ewbfjkb ewjkfb ejkwbfejkwbfjk bewfjkbewjkfb ejkwbfejkwbfjkewbfjkbewjkfbewjkbfjk bwefjk</p>
		<?php /* --------------- div pour inscription error --------------- */ ?>
			<div id="error">
<?PHP	if (isset($insfail) && $insfail == 1)
echo "Vos deux mots de passes ne sont pas identiques.\n";
else if (isset($insfail) && $insfail == 2)
	echo "Le login que vous avez choisi n'est plus disponible.\n";
else if (isset($insfail) && $insfail == 3)
	echo "Une erreur est survenue, veuillez reessayer plus tard.\n";
unset($insfail);
?>
			</div>
<form action:"insco.php"  method="GET">
				Identifiant: <input type="text" name="ilogin" /><br />
				Mot de passe: <input type="password" name="ipasswd" /><br />
				Mot de passe: <input type="password" name="ipasswd2" /><br />
				<input type="submit" name="submit" value="OK" />
			</form>
		</div>
		<?php /* --------------- --------------- --------------- Form pour connection --------------- --------------- --------------- */ ?>
		<div id="connection">
			<p id="intro">texte pour lefun fjhwevfhjewj fewjfbjewbf bfjqbfjb jkwebfk bewfkbewk bfkewbfjk fjkbewjkbf jkewbkjb ewjkfbejkwbf jkewbfjkbewjk bfewjkbf jkewbfjkbewjkfb jkewbfjkewbfjk bewjkfbjk ewbfjkb ewjkfb ejkwbfejkwbfjk bewfjkbewjkfb ejkwbfejkwbfjkewbfjkbewjkfbewjkbfjk bwefjk</p>
			<?php /* --------------- div pour connection error --------------- */ ?>
			<div id="error">
<?php if (isset($res) && $res == 1)
{echo "Vous venez de vous creer un compte, connectez-vous;)";
unset($res);}?>
<?php if (isset($cofail) && $cofail == 2)
{echo "<p> vous m'etes inconnu dresseur de pacotille</p>"; unset($cofail);}?>
			</div>
		<form action:"connection.php" method="GET">
			Login : <input type = "text" name = "login" /> <br/>
			Mot de passe : <input type = "password" name = "password" /> <br/>
			<input type = "submit" name = "OK" /> <br/>
		</form>
		</div>
		<div id="acceuil">
<button type="text" id="retour">Retourner a l'acceuil</button>
		</div>
	</div>
	<script src="connection.js"></script>
	</body>
</html>
