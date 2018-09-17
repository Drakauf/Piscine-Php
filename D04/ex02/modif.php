<?php

function addtoarray($array, $toadd)
{
	$array[] = $toadd;
}

function createuser($l, $p, $n)
{
	$array['login'] = $l;
	$array['oldpw'] = hash('whirlpool', $p, FALSE);
	$array['newpw'] = hash('whirlpool', $n, FALSE);
	return ($array);
}

function ft_error()
{
	exit("ERROR\n");
}

if (isset($_POST['submit']))
{
	if ($_POST['submit'] === "OK" && isset($_POST['login']) && isset($_POST['oldpw']) && $_POST['login'] !== "" && $_POST['oldpw'] && isset($_POST['newpw']) && $_POST['newpw'] !== "")
	{
		if (!file_exists("../private/passwd"))
			ft_error();
		$user = createuser($_POST['login'], $_POST['oldpw'], $_POST['newpw']);
		$tab = unserialize(file_get_contents("../private/passwd"));
		foreach($tab as $case => $elem)
		{
			if ($_POST['login'] == $elem['login'])
			{
				if ($user['oldpw'] === $elem['passwd'])
				{
					$tab[$case]['passwd'] = $user['newpw'];
					file_put_contents("../private/passwd", serialize($tab));
					exit("OK\n");
				}
				else
					ft_error();
			}
		}
		ft_error();
	}
	else
		ft_error();
}
?>
