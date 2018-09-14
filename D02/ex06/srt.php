#!/usr/bin/php
<?PHP

if ($argc != 2)
	exit();
if (!(file_exists($argv[1])))
	exit();

$file = fopen($argv[1], "r");
$file_lines = array();
$times_lines = array();
$times_comment = array();
$file_index = 0;
$times_index = 0;
$time_get = 0;

function check_time($line)
{
	return(preg_match("/^[0-9][0-9]:[0-9][0-9]:[0-9][0-9],[0-9][0-9][0-9] --> [0-9][0-9]:[0-9][0-9]:[0-9][0-9],[0-9][0-9][0-9]$/", $line));
}
while ($line = fgets($file))
{
	$file_lines[] = $line;
	if (check_time($line))
	{
		$times_lines[] = $line;
		$time_get = 1;
	}
	else if ($time_get)
	{
		$times_comment[$times_lines[count($times_lines) - 1]] = $line;
		$time_get = 0;
	}
}

sort($times_lines);

while ($file_lines[$file_index])
{
	if(check_time($file_lines[$file_index]))
	{
		echo($times_lines[$times_index]);
		echo($times_comment[$times_lines[$times_index]]);
		$times_index++;
		$file_index++;
	}
	else
		echo ($file_lines[$file_index]);
	$file_index++;
}

?>
