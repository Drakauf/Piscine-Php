#!/usr/bin/php
<?PHP

function my_sort($mot1, $mot2)
{
	$my_array= array("A","a","B","b","C","c","D","d","E","e","F","f","G","g","H","h","I","i","J","j","K","k","L","l","M","m","N","n","O","o","P","p","Q","q","R","r","S","s","T","t","U","u","V","v","W","w","X","x","Y","y","Z","z","0","1","2","3","4","5","6","7","8","9","\!","\"","#","$","%","&","'","(",")","*","+",",","-",".","/",":",";","<","=",">","?","@","[","\\","]","^","_","`","{","|","}","~");
	$i = 0;
	while($mot1[$i] && $mot2[$i])
	{
		$A = strtolower($mot1[$i]);
		$B = strtolower($mot2[$i]);
		if ($A === $B)
			$i++;
		else
		{
			$j = 0;
			while ($j < count($my_array))
			{
				if ($my_array[$j] == $A)
					return (-1);
				if ($my_array[$j] == $B)
					return (1);
				$j++;
			}
		}
	}
	if ($mot1[$i] == $mot2[$i])
		return (0);
	if ($mot1[$i])
		return (1);
	else
		return (-1);
}

$args = $_SERVER[argv];
$i = 2;
$conca = array_filter(explode(" ", $args[1]));
while($args[$i])
{
		$conca = array_merge($conca, array_filter(explode(" ", $args[$i]), 'strlen'));
			$i++;
}

usort($conca, "my_sort");

$i = 0;
while($conca[$i])
{
		print($conca[$i]);
			print("\n");
			$i++;
}
?>
