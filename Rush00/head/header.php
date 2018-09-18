<?php
if (isset($_GET['submit']) && $_GET['submit'] == "deconnection")
{
		session_destroy();
			echo '<script type="text/javascript"> location.href = "/"; </script>'; 
}
if (isset($_SESSION['login']))
		$user = $_SESSION['login'];
else 
		$user = "";
echo "<div id=bigdiv>
		<div id=header>
		<div id=connected>
<div id=hname><h1>Bonjour $user </h1></div>";
echo '<img id=deco src="head/deco.png">
<img id=pannierc src="head/pannier.png">
<img id=homec src="head/home.png">';
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === '1')
{
	echo "<img id=admin src='head/admin.png'>";
	echo "<script src='head/admin.js'></script>";
}
echo '</div><div id=noconnect>
<div id=hname><h1> Bonjour Invite</h1></div>
<img id=cobutton src="head/login.png">
<img id=pannierd src="head/pannier.png">
<img id=homed src="head/home.png">
</div>
</div>';
?>
