#!/usr/bin/php
<?PHP
$args=($_SERVER[argv]);
$i = 1;
while ($i < $argc):
	print($args[$i]);
	print("\n");
	$i++;
endwhile;
?>
