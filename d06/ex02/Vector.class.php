<?php

require_once '../ex00/Color.class.php';

class Vector {

	private $_x;
	private $_y;
    private $_z;
    private $_w = 0.0;
    static $verbose = false;

    public function __construct($vector) {
        if (isset($vector['dest']) && isset($vector['orig'])) {
            $this->_x = ($vector['dest']->getX() - $vector['orig']->getX());
            $this->_y = ($vector['dest']->getY() - $vector['orig']->getY());
            $this->_z = ($vector['dest']->getZ() - $vector['orig']->getZ());
        }
        else if (isset($vector['dest'])) {
            $this->_x = ($vector['dest']->getX() - 0);
            $this->_y = ($vector['dest']->getY() - 0);
            $this->_z = ($vector['dest']->getZ() - 0);

        }
        if (self::$verbose) {
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n",
                $this->_x, $this->_y, $this->_z, $this->_w);
		}
        return ;
    }

    function __destruct() {
        if (self::$verbose) {
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) destructed\n",
                $this->_x, $this->_y, $this->_z, $this->_w);
        }
    }

    function __toString() {
        if (self::$verbose) {
            return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )",
                array($this->_x, $this->_y, $this->_z, $this->_w)));
        }
    }

    static function doc () {
		return file_get_contents( "./Vector.doc.txt" );
    }

}