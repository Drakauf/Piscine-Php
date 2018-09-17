<?PHP

if (!(isset($_GET['action'])))
	return;
if ($_GET['action'])
{
	if ($_GET['action'] == "set")
	{
		if (!(isset($_GET['name'])) || !(isset($_GET['value'])))
			return;
		setcookie($_GET['name'], $_GET['value'], time() + (86400 * 30));
	}
	if ($_GET['action'] == "get")
	{
		if (isset($_GET['name']))
		{
			if (!(isset($_COOKIE[$_GET['name']])))
				return;
			echo($_COOKIE[$_GET['name']]);
			echo("\n");
		}
	}
	if ($_GET['action'] == "del")
	{
		if (!(isset($_GET['name'])))
			return ;
		setcookie($_GET['name'], '', time() - (86400 * 30));
	}
}
?>
