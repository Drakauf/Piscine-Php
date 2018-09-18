<?PHP


function ft_connect_db()
{
include("./.config.php");
	if (($co = mysqli_connect($server_name, $id, $pw, $db_name)) === FALSE)
	{
		echo "erreur :". mysqli_error($co);
		return (FALSE);
	}
	return ($co);
}



function ft_make_admin($user_name, $password)
{
	if (($co = ft_connect_db()) === FALSE)
		return (FALSE);
	$password = hash("whirlpool", $password);
			$user_name = mysqli_real_escape_string($co, $user_name);
			$password = mysqli_real_escape_string($co, $password);
	if (!mysqli_query($co, "INSERT INTO user (login, mdp, status) VALUES ('$user_name', '$password', '1')"))
		return (FALSE);
	return (TRUE);
}
?>
