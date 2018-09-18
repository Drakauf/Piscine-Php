<?PHP

	include_once("./ft_user.php");

function ft_user_exists($login)
{
	print "lol";

	if (($co = ft_connect_db()) === FALSE)
		return (TRUE);
			$login = mysqli_real_escape_string($co, $login);
	$result = mysqli_query($co, "SELECT * FROM user WHERE login = '$login'");
	$check = mysqli_fetch_array($result);
	print_r ($check);
	if (!isset($check))
		return (FALSE);
	return (TRUE);
}



function ft_create_user($login, $passwd, $passwd2)
{
	$pw = hash("whirlpool", $passwd);

	if ($passwd !== $passwd2)
		header("Location:ft_inscription.php?passwd_err=not_identical");
	else if (ft_user_exists($login) === TRUE)
		header("Location:ft_inscription.php?login_err=already_exists");
	else
	{
		if (($db = ft_connect_db()) === FALSE)
			header("Location:ft_inscription.php?bd_err=fail");
		$login = mysqli_real_escape_string($db, $login);
		$pw = mysqli_real_escape_string($db, $pw);
		if (!(mysqli_query($db, "INSERT INTO user (login, mdp, status) VALUES ('$login', '$pw', '0')")))
			header("Location:ft_inscription.php?bd_err=fail");
		else
			header("Location:./index.php?register=success");
	}
	exit();
}

if (isset($_POST["login"], $_POST["passwd"], $_POST["passwd2"]))
    ft_create_user($_POST["login"], $_POST["passwd"], $_POST["passwd2"]);
?>



<html>
	<head>
	</head>

	<body>
			<?PHP	if (isset($_GET["passwd_err"]) && $_GET["passwd_err"] === "not_identical")
						echo "Vos deux mots de passes ne sont pas identiques.\n";
					else if (isset($_GET["login_err"]) && $_GET["login_err"] === "already_exists")
						echo "Le login que vous avez choisi n'est plus disponible.\n";
					else if (isset($_GET["bd_err"]) && $_GET["bd_err"] === "fail")
						echo "Une erreur est survenue, veuillez reessayer plus tard.\n";
			?>
			<form method="post">
				Identifiant: <input type="text" name="login" /><br />
				Mot de passe: <input type="password" name="passwd" /><br />
				Mot de passe: <input type="password" name="passwd2" /><br />
				<input type="submit" name="submit" value="OK" />
				<button><a href="./index.php">Home</a></button>
			</form>
	</body>
</html>
