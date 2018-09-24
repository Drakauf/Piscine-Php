<?PHP

Class Color 
{
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	public static $verbose = False;

	public function __construct( array $kwargs )
	{
		if ( array_key_exists( 'blue', $kwargs ) ) 
			$this->blue = $kwargs['blue'];
		if ( array_key_exists( 'green', $kwargs ) ) 
			$this->green = $kwargs['green'];
		if ( array_key_exists( 'red', $kwargs ) ) 
			$this->red = $kwargs['red'];
		if ( array_key_exists( 'rgb', $kwargs ) ) 
		{
			$this->red = ($kwargs['rgb'] / (256*256))%256;
			$this->green = ($kwargs['rgb'] /256) % 256;
			$this->blue = $kwargs['rgb'] % 256;
		}
		if (self::$verbose == True)	
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue); 
	}
	public function __toString()
	{
		$r_string = sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue); 
		return ("$r_string");
	}

	public function add($color)
	{
		$newred = $color->red + $this->red;
		$newgreen = $color->green + $this->green;
		$newblue = $color->blue + $this->blue;
		$ret = new Color( array('red' => $newred, 'green' => $newgreen, 'blue' => $newblue ) );
		return ($ret);
	}

	public function sub($color)
	{
		$newred = $this->red - $color->red ;
		$newgreen = $this->green - $color->green;
		$newblue =  $this->blue - $color->blue;
		$ret = new Color( array('red' => $newred, 'green' => $newgreen, 'blue' => $newblue ) );  
		return ($ret);
	}

	public function mult($coeff)
	{
		$newred = $coeff * $this->red;
		$newgreen = $coeff * $this->green;
		$newblue = $coeff * $this->blue;
		$ret = new Color( array('red' => $newred, 'green' => $newgreen, 'blue' => $newblue ) );  
		return ($ret);
	}

	public static function doc()
	{
		return (file_get_contents("Color.doc.txt", "r"));
	}

	public function __destruct ()
	{
		if (self::$verbose == True)	
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue); 
	}
}

?>
