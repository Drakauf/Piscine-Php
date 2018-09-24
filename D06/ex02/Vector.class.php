#!/usr/bin/php
<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';

Class Vector
{
    private $_x = 0;
    private $_y = 0;
    private $_z = 0;
    public $dest = [];

    private $_w = 0.0;

    public static $verbose = False;

    public function __construct( array $kwargs )
    {
       // print_r($kwargs['dest']['_x']);
       if(array_key_exists('orig', $kwargs))
        {
            $orig = $kwargs['orig'];
        }
        else
            {
            $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1));
        }

        if ( array_key_exists('dest', $kwargs))
        {
            $this->dest = $kwargs['dest'];
            $this->_x = $this->dest->getX() - $orig->getX();
            $this->_y = $this->dest->getY() - $orig->getY();
            $this->_z = $this->dest->getZ() - $orig->getZ();
        }



        if (self::$verbose == True)
            printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) constructed\n", $this->_x, $this->_y , $this->_z, $this->_w );
    }

    public function __toString()
    {
        $r_string = sprintf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f )", $this->_x, $this->_y, $this->_z, $this->_w );
        return ("$r_string");
    }

    public static function doc()
    {
        return (file_get_contents("Vector.doc.txt", "r"));
    }

    public function getX()
    {
        return ($this->_x);
    }

    public function getY()
    {
        return ($this->_y);
    }

    public function getZ()
    {
        return ($this->_z);
    }

    public function magnitude()
    {
        return ( sqrt( $this->_x * $this->_x +  $this->_y * $this->_y +  $this->_z * $this->_z ) );
    }

    public function normalize()
    {
        $norm = new Vertex(array( 'x' => $this->_x / $this->magnitude(), 'y'  => $this->_y / $this->magnitude(), 'z'  => $this->_z / $this->magnitude() )) ;
        return (new Vector ( array( 'dest' => $norm) ) );
    }

    public function add( $vtc2 )
    {

        $dest_add = new Vertex( array ('x' => $vtc2->dest->getX() + $vtc2->getX(), 'y' => $vtc2->dest->getY() + $vtc2->getY(), 'z' => $vtc2->dest->getZ() + $vtc2->getZ()) );

       return (new Vector( array( 'dest' => $dest_add) ) ) ;
    }

    public function sub( $vtc2 )
    {

        $dest_add = new Vertex( array ('x' => $vtc2->dest->getX() - $vtc2->getX(), 'y' => $vtc2->dest->getY() - $vtc2->getY(), 'z' => $vtc2->dest->getZ() - $vtc2->getZ()) );
        return (new Vector( array( 'dest' => $dest_add ) ) );
    }

    public function opposite()
    {
        $dest_opp = new Vertex( array ('x' => - $this->getX(), 'y' => - $this->getY(), 'z' => - $this->getZ()) );
        return (new Vector( array( 'dest' => $dest_opp ) ) );

    }

    public function scalarProduct( $coeff )
    {
        $dest_coeff = new Vertex( array ('x' => $this->getX() * $coeff, 'y' => $this->getY() * $coeff , 'z' => $this->getZ() * $coeff ) );
        return (new Vector( array( 'dest' => $dest_coeff) ) );
    }

    public function dotProduct ( $vtc2 )
    {
        $total = $vtc2->dest->getX() * $vtc2->getX();
        $total += $vtc2->dest->getY() * $vtc2->getY();
        $total += $vtc2->dest->getZ() * $vtc2->getZ();
        return($total);
    }

    public function crossProduct( $vtc2 )
    {
        $ux = $this->getX();
        $uy = $this->getY();
        $uz = $this->getZ();

        $vx = $vtc2->getX();
        $vy = $vtc2->getY();
        $vz = $vtc2->getZ();

        $dest_prod = new Vertex( array ('x' => $uy * $vz - $uz * $vy , 'y' => $uz * $vx - $ux * $vz, 'z' => $ux * $vy - $uy * $vx) );

        return (new Vector( array( 'dest' => $dest_prod)));
    }

    public function cos( $vtc2 )
    {
        return ($this->_x * $vtc2->_x + $this->_y * $vtc2->_y + $this->_z * $vtc2->_z) /
            sqrt(($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z) * ($vtc2->_x * $vtc2->_x +
                    $vtc2->_y * $vtc2->_y + $vtc2->_z * $vtc2->_z));
    }

    public function __destruct ()
    {


        if (self::$verbose == True)
            printf( "Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w );
    }
}

?>
