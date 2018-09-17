<?php
function auth($login, $passwd)
{
	if(!file_exists("../private/passwd"))
		return (FALSE);
	$mdp = hash('whirlpool', $passwd, FALSE);
	$tab = unserialize(file_get_contents("../private/passwd"));
	foreach ($tab as $elem)
	{
		if ($login == $elem['login'] && $mdp == $elem['passwd'])
			return (TRUE);
	}
	return (FALSE);
}
?>
