<?php

class Vertex {

	private $_x;
	private $_y;
    private $_z;
    private $_w = 1.0;
    private $_color;
    static $verbose = false;
    
    public function __construct($vertex) {
        $this->color = new Color(array( 'red' => 255, 'green' => 255, 'blue' => 255 ));
        if (isset($vertex['x']) && isset($vertex['y']) && isset($vertex['z']) && isset($vertex['w'])) {
            $this->x = ($vertex['x']);
            $this->y = ($vertex['y']);
            $this->z = ($vertex['z']);
            $this->w = ($vertex['w']);
        }
        else if (isset($vertex['x']) && isset($vertex['y']) && isset($vertex['z'])) {
            $this->x = ($vertex['x']);
            $this->y = ($vertex['y']);
            $this->z = ($vertex['z']);
        }
        if (isset($vertex['color'])) {
            $this->color = $vertex['color'];
        }
        if (self::$verbose) {
            printf("Vertex( x: %1.2f, y: %1.2f, z:%1.2f, w:%1.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n",
                $this->_x, $this->_y, $this->_z, $this->_w, $this->color->red, $this->color->green, $this->color->blue);
		}
    }

    function __destruct() {
        if (self::$verbose) {
            printf("Vertex( x: %1.2f, y: %1.2f, z:%1.2f, w:%1.2f, Color( red: %3d, green: %3d, blue: %3d ) )",
                    $this->_x, $this->_y, $this->_z, $this->_w, $this->color->red, $this->color->green, $this->color->blue);
        }
        else {
            printf("Vertex( x: %1.2f, y: %1.2f, z:%1.2f, w:%1.2f )",
                $this->_x, $this->_y, $this->_z, $this->_w);
        }
        printf(" destructed\n");
    }

    function __toString() {
        if (self::$verbose) {
            return (vsprintf("Vertex( x: %1.2f, y: %1.2f, z:%1.2f, w:%1.2f, Color( red: %3d, green: %3d, blue: %3d ) )",
                array($this->_x, $this->y, $this->_z, $this->_w, $this->color->red, $this->color->green, $this->color->blue)));
        }
        else {
            return (vsprintf("Vertex( x: %1.2f, y: %1.2f, z:%1.2f, w:%1.2f )",
                array($this->_x, $this->_y, $this->_z, $this->_w)));
        }
    }

    public function getX() {
        return $this->_x;
    }

    public function getY() {
        return $this->_y;
    }

    public function getZ() {
        return $this->_z;
    }

    public function getW() {
        return $this->_w;
    }

    public function getColor() {
        return $this->_color;
    }

    public function setX($x) {
        $this->_x = $x;
    }

    public function setY($y) {
        $this->_y = $y;
    }

    public function setZ($z) {
        $this->_z = $z;
    }

    public function setW($w) {
        $this->_w = $w;
    }

    public function setColor($color) {
        $this->_color = $color;
    }

    static function doc () {
		return file_get_contents( "./Vertex.doc.txt" );
	}
}