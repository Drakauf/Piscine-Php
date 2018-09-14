#!/usr/bin/php
<?php
$str = preg_replace('/\s\s+/', ' ', $argv[1]);
$r = trim($str);
 echo "$r\n";
?>
