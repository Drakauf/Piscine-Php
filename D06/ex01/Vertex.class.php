#!/usr/bin/php
<?php

require_once 'Color.class.php';

Class Vertex
{
    private $_x = 0;
    private $_y = 0;
    private $_z = 0;

    private $_w = 1.0;

    public static $verbose = False;

    public function __construct( array $kwargs )
    {
        if ( array_key_exists('x', $kwargs ))
            $this->_x = $kwargs['x'];
        if ( array_key_exists('y', $kwargs ))
            $this->_y = $kwargs['y'];
        if ( array_key_exists('z', $kwargs ))
            $this->_z = $kwargs['z'];
        if ( array_key_exists('w', $kwargs ))
            $this->_w = $kwargs['w'];
        if ( array_key_exists('color', $kwargs ))
        {
            $this->color = $kwargs['color'];
            //    print_r($this->color);
            $color_text = new Color((array)$this->color);
            $color_text = ", ".$color_text;
        }
        else
        {
            $color_text =new Color(array( 'red' => 255, 'green' => 255, 'blue' => 255 ) );
            $color_text = ", ".$color_text;
        }
        if (self::$verbose == True)
            printf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f$color_text ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w );
    }

    public function __toString()
    {
        if (self::$verbose == True)
        {
            if ($this->color)
            {
                $color_text = new Color((array)$this->color);
                $color_text = ", " . $color_text;
            } else {
                $color_text = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
                $color_text = ", " . $color_text;
            }
        }
        $r_string = sprintf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f$color_text )", $this->_x, $this->_y, $this->_z, $this->_w );
        return ("$r_string");
    }

    public static function doc()
    {
        return (file_get_contents("Vertex.doc.txt", "r"));
    }

    public function __destruct ()
    {
        if ( $this->color )
        {
            $color_text = new Color((array)$this->color);
            $color_text = ", ".$color_text;
        }
        else
        {
            $color_text =new Color(array( 'red' => 255, 'green' => 255, 'blue' => 255 ) );
            $color_text = ", ".$color_text;
        }

        if (self::$verbose == True)
            printf( "Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f$color_text ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w );
    }

    public function getX()
    {
        return $this->_x;
    }

    public function getY()
    {
        return $this->_y;
    }

    public function getZ()
    {
        return $this->_z;
    }

    public function getW()
    {
        return $this->_w;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setX($x)
    {
        $this->_x = $x;
    }

    public function setY($y)
    {
        $this->_y = $y;
    }

    public function setZ($z)
    {
        $this->_z = $z;
    }

    public function setW($w)
    {
        $this->_w = $w;
    }
}



?>