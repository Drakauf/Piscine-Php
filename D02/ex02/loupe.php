#!/usr/bin/php
<?PHP

if ($argc === 1 || !file_exists($argv[1]))
	return;

$file = file_get_contents($argv[1]);

function test3($v)
{
	$v1 = '>';
	$v2 = '<';
	return ($v1.strtoupper($v[1]).$v2);
}

function test2($u)
{	
	$u1 = 'title="';
	$u2 = '"';
	return ($u1.strtoupper($u[1]).$u2);
}

function test($t)
{
	$ret = preg_replace_callback('#title="(.*)"#Uis', test2, $t[0]);
	$ret1 = preg_replace_callback('#>(.*)<#Uis', test3, $ret);
	return ($ret1);
}

$ret = preg_replace_callback('#<a(.*)</a#Uis', test, $file);
print ($ret);
?>
