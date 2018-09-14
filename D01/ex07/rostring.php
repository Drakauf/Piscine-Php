#!/usr/bin/php
<?PHP

if ($argc == 1)
	return ;

$args = $_SERVER[argv];
$filt = array_values(array_filter((explode(" ", $args[1]))));

$i = 1;
$a = 0;

while($filt[$i])
{
	if ($a !== 0)
		print (" ");
	print($filt[$i]);
	$a++;
	$i++;
}
if ($a > 0)
	print (" ");
print($filt[0]);
print("\n");
?>
