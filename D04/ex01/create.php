<?php

function addtoarray($array, $toadd)
{
	$array[] = $toadd;
}

function createuser($l, $p)
{
	$array['login'] = $l;
	$array['passwd'] = hash('whirlpool', $p, FALSE);
	return ($array);
}

function ft_error()
{
	exit("ERROR\n");
}

if (isset($_POST['submit']))
{
	if ($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_POST['passwd']) && $_POST['login'] !== "" && $_POST['passwd'])
	{
		$user = createuser($_POST['login'], $_POST['passwd']);
		if (!file_exists("../private"))
			mkdir("../private");
		if (file_exists("../private/passwd"))
		{
			$tab = unserialize(file_get_contents("../private/passwd"));
			foreach($tab as $cmp)
			{
				if ($cmp['login'] == $_POST['login'])
					ft_error();
			}
			$tab[] = $user;
		}
		else
			$tab[] = $user;
		file_put_contents("../private/passwd", serialize($tab));
		echo "OK\n";
	}
	else
		ft_error();
}
?>
