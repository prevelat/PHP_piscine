<?php

class Color {

	public $red;
	public $green;
	public $blue;
	static $verbose = false;

	public function __construct( $color ) {
		if (isset($color['red']) && isset($color['green']) && isset($color['blue'])) {
			$this->red = intval($color['red']);
			$this->green = intval($color['green']);
			$this->blue = intval($color['blue']);
		}
		else if (isset($color['rgb'])) {
			$rgb = intval($color["rgb"]);
			$this->red = $rgb / 65281 % 256;
			$this->green = $rgb / 256 % 256;
			$this->blue = $rgb % 256;
		}
		if (self::$verbose)
		{
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n",
				$this->red, $this->green, $this->blue);
		}
		return ;
	}

	function __destruct() {
		if (self::$verbose) {
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n",
				$this->red, $this->green, $this->blue);
		}
		return ;
	}

	function __toString() {
		return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )",
				array($this->red, $this->green, $this->blue)));
	}

	static function doc () {
		return file_get_contents( "./Color.doc.txt" );
	}

	public function add( $rgb ) {
		return (new Color(array('red' => $this->red + $rgb->red,
			'green' => $this->green + $rgb->green,
			'blue' => $this->blue + $rgb->blue)));
	}

	public function sub( $rgb ) {
		return (new Color(array('red' => $this->red - $rgb->red,
			'green' => $this->green - $rgb->green,
			'blue' => $this->blue - $rgb->blue)));
	}

	public function mult( $f ) {
		return (new Color(array('red' => $this->red * $f,
			'green' => $this->green * $f, 'blue' => $this->blue * $f)));
	}

}

?>
