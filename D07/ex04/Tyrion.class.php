<?php

class Tyrion extends Lannister
{
	public function res($perso)
	{
		if (get_parent_class($perso) != 'Lannister')
			return ('Let\'s do this.'.PHP_EOL);
		else
			return ('Not even if I\'m drunk !'.PHP_EOL);
	}
}
?>
