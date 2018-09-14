#!/usr/bin/php
<?PHP

$args = $_SERVER[argv];
$i = 2;
$conca = array_filter(explode(" ", $args[1]));
while($args[$i])
{
	$conca = array_merge($conca, array_filter(explode(" ", $args[$i])));
	$i++;
}
sort($conca, SORT_STRING);
$i = 0;
while($conca[$i])
{
	print($conca[$i]);
	print("\n");
	$i++;
}
?>
