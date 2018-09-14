#!/usr/bin/php
<?PHP

if($argc != 2)
	exit();

$curl = curl_init($argv[1]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($curl);
if ($result === false)
	    exit();

if (!(preg_match('/(^http[s]?:\/\/)(.*)$/', $argv[1])))
	return ;

preg_match('/http[s]?:\/\/(.*)$/', $argv[1], $dir);

exec("mkdir -p $dir[1]");

$page = file_get_contents($argv[1]);
preg_match_all('/<img src=[\'"](.*)[\'"]/Uis', $page, $array);
foreach($array[1] as $url)
{
	if (!preg_match('#^http[s]?://#', $url))
		$url = $argv[1] . $url;
	$file = file_get_contents($url);
	preg_match('#/([^/]*)$#', $url, $name);
	file_put_contents("$dir[1]/$name[1]", $file);
}
?>
