#!/usr/bin/php
<?PHP
date_default_timezone_set('Europe/Paris');
exec("w", $output);
array_shift($output);
array_shift($output);

foreach($output as $elem)
{
	$elem = array_values(array_filter(explode(' ', $elem)));
	$new[] = $elem;
}
foreach($new as $elem)
{
	print($elem[0]." ");
	if (preg_match('/s[0-9]{3}/', $elem[1]))
		print("tty");
	print($elem[1]."  ");
	echo date("M ");
	echo date("d ");
	if (!preg_match('/[0-9]{2}:[0-9]{2}/', $elem[3]))
		echo("0");
	print($elem[3]." \n");
}
?>
