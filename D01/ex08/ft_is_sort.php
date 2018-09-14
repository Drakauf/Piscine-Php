<?PHP
function ft_is_sort($tab)
{
	if ($tab)
	{
		$sortab = $tab;
		sort($tab);
		$result = array_diff_assoc($tab, $sortab);
		if (count($result) === 0)
			return (TRUE);
		else 
			return (FALSE);
	}
}
?>
