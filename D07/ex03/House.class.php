<?php

class House
{
	public function introduce()
	{
		return (printf("House %s of %s : \"%s\"".PHP_EOL, $this->getHouseName(), $this->getHouseSeat(), $this->getHouseMotto()));
	}
}

?>
