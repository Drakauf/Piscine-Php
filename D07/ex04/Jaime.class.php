<?php

class Jaime extends Lannister
{
	public function res($perso)
	{
		if (get_parent_class($perso) != 'Lannister')
			return ("Let's do this.".PHP_EOL);
		if (get_class($perso) == 'Cersei')
			return ("With pleasure, but only in a tower in Winterfell, then.".PHP_EOL);
		return ("Not even if I'm drunk !".PHP_EOL);
	}
}
?>
