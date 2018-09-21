<?php 
class NightsWatch implements IFighter{
	public function recruit($arg){
		if (array_key_exists('IFighter', class_implements($arg)))
			$warrior = $arg->fight();
	}
	public function fight() {
		print $warrior;
	}
}
?>
