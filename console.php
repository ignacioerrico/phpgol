<?php

namespace gameoflife;

require_once 'gameOfLife.php';

/**#@+
 * Constants
 */
/**
 * Default grid width
 */
define( 'DEFAULT_WIDTH', 40 );
/**
 * Default grid height
 */
define( 'DEFAULT_HEIGHT', 10 );

echo 'Conway\'s Game Of Life' . "\n\n";

/**
 * Read width
 */
echo 'Please input grid width [default: ' . DEFAULT_WIDTH . '] >> ';
fscanf( STDIN, "%d\n", $w );

if ( $w <= 0 || $w == '' ) {
	$w = DEFAULT_WIDTH;
}

/**
 * Read height
 */
echo 'Please input grid height [default: ' . DEFAULT_HEIGHT . '] >> ';
fscanf( STDIN, "%d\n", $h );

if ( $h <= 0 || $h == '' ) {
	$h = DEFAULT_HEIGHT;
}

/**
 * Initialization
 */
$gol = new GameOfLife( $w, $h );
$gol->randomInit();

/**
 * Simulation
 */
while ( true ) {
	echo $gol->toString();	// Print current generation
	
	echo 'Want to see next generation? [Y/n] >> ';
	fscanf( STDIN, "%c\n", $answer );	// Read user input
	if ( strtolower( $answer ) == 'n' ) {	// End simulation
		break;
	}
	
	$gol->update();	// Update generation
}

echo 'End of simulation.' . "\n";
