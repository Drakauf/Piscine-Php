<?php
session_start();
if (isset($_GET['submit']) && $_GET['submit'] == 'OK')
{
	if(isset($_GET['login']) && isset($_GET['passwd']))
	{
		$_SESSION['login'] = $_GET['login'];
		$_SESSION['passwd'] = $_GET['passwd'];
	}
}
?>

<!DOCTYPE html>

<html><body>
<form action="index.php" method="get">
	Identifiant: <input type="text" name="login" value="<?php if(isset($_SESSION['login'])) {echo $_SESSION['login'];} ?>">
	</br>
	Mot de passe: <input type="text" name="passwd" value="<?php if(isset($_SESSION['passwd'])) {echo $_SESSION['passwd'];}?>">
	<input type="submit" name="submit" value="OK">
</form>
</body></html>
