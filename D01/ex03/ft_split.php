<?PHP
function ft_split($str)
{
	$array = array_filter(explode(" ", $str), 'strlen');
	sort($array, SORT_STRING);
	return ($array);
}
?>
