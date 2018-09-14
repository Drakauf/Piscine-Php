#!/usr/bin/php
<?PHP
if ($_SERVER[argc] !== 2)
	return ;
$args=($_SERVER[argv]);
$array = array_filter(explode(" ", $args[1]));
$i = 0;
$a = 0;
$t = count($array);
while ($a < $t):
if ($array[$i])
{
	if ($a !== 0)
	{
		print (" ");
	}
	print($array[$i]);
	$a++;
}
	$i++;
endwhile;
if ($a >= 1)
	print("\n");
?>
