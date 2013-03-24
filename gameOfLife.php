<?php
/**
 * Conway's Game Of Life in PHP >= 5.3
 * 
 * This is an implementation of the well-known cellular automaton
 * devised by the British mathematician John Horton Conway.
 * @author Ignacio Errico <Ignacio@Errico.com.ar>
 * @version 1.0
 * @link http://en.wikipedia.org/wiki/Conway's_Game_of_Life Wikipedia article
 * @package gameoflife
 */

namespace gameoflife;

use \Exception;

/**
 * Conway's Game Of Life
 * 
 * The well-known cellular automaton devised by the British
 * mathematician John Horton Conway, implemented in PHP >= 5.3.
 * @author Ignacio Errico <Ignacio@Errico.com.ar>
 * @version 1.0
 * @link http://en.wikipedia.org/wiki/Conway's_Game_of_Life Wikipedia article
 * @package gameoflife
 */
class GameOfLife {
	/**
	 * Grid where the cells live
	 * @access private
	 * @var array
	 */
	private $grid;
	/**
	 * Grid width
	 * @var integer
	 */
	private $width;
	/**
	 * Grid height
	 * @var integer
	 */
	private $height;
	
	/**
	 * Constructor - initializes all properties
	 * @param integer $width
	 * @param integer $height
	 */
	public function __construct( $width, $height ) {
		$this->grid = array();
		$this->width = $width;
		$this->height = $height;
	}
	
	/**
	 * Getter (width)
	 * @return integer
	 */
	public function getWidth() {
		return $this->width;
	}
	
	/**
	 * Getter (height)
	 * @return integer
	 */
	public function getHeight() {
		return $this->height;
	}
	
	/**
	 * Is a given cell alive?
	 * @param integer $row
	 * @param integer $col
	 * @return bool
	 */
	public function isCellAlive( $row, $col ) {
		if ( $row >= $this->height || $col >= $this->width ) {
			throw new Exception( 'Parameter out of range.' );
		}
		return $this->grid[ $row ][ $col ] == 1;
	}
	
	/**
	 * Initialize the grid randomly
	 */
	public function randomInit() {
		for ( $row = 0; $row < $this->height; ++$row ) {
			for ( $col = 0; $col < $this->width; ++$col ) {
				$this->grid[ $row ][ $col ] = rand() % 2;	// Will assign 0 (dead cell) or 1 (live cell)
			}
		}
	}
	
	/**
	 * Initialize the grid as a chess board
	 */
	public function chessBoardInit() {
		for ( $row = 0; $row < $this->height; ++$row ) {
			for ( $col = 0; $col < $this->width; ++$col ) {
				$this->grid[ $row ][ $col ] = ( $row + $col ) % 2;	// Will alternate between 0 (dead cell) and 1 (live cell)
			}
		}
	}
	
	/**
	 * Determine the number of neighbors of a given cell identified
	 * by the coordinates ( $row, $col )
	 * @access private
	 * @param integer $row
	 * @param integer $col
	 * @return integer
	 */
	private function numberOfNeighbors( $row, $col ) {
		$numberOfNeighbors = 0;
		for ( $x = -1; $x <= 1; ++$x ) {
			for ( $y = -1; $y <= 1; ++$y ) {
				if ( $x == 0 && $y == 0 ) {	// Skip the cell itself
					continue;
				}
				if ( $row == 0 && $y == -1 ) {	// There are no cells on top of the top edge
					continue;
				}
				if ( $row == $this->height - 1 && $y == 1 ) {	// There are no cells below the bottom edge
					continue;
				}
				if ( $col == 0 && $x == -1 ) {	// There are no cells on the left of the left edge
					continue;
				}
				if ( $col == $this->width - 1 && $x == 1 ) {	// There are no cells on the right of the right edge
					continue;
				}
				$numberOfNeighbors += $this->grid[ $row + $y ][ $col + $x ];
			}
		}
		return $numberOfNeighbors;
	}
	
	/**
	 * Determine the fate of a given cell identified by the coordinates
	 * ( $row, $col ). A cell that is alive and has two or three
	 * neighbors will remain alive in the following generation.  A cell
	 * that is dead and has exactly three neighbors will become alive.
	 * All other cells will die of over- or under-population.  A live
	 * cell has a value of 1; a dead cell has a value of 0.
	 * @access private
	 * @param integer $row
	 * @param integer $col
	 * @return integer
	 */
	private function determineCellFate( $row, $col ) {
		$cellIsAlive = $this->isCellAlive( $row, $col );
		$numberOfNeighbors = $this->numberOfNeighbors( $row, $col );
		if ( ( $cellIsAlive && $numberOfNeighbors == 2 ) ||
			( $numberOfNeighbors == 3 ) ) {
			return 1;
		}
		return 0;
	}
	
	/**
	 * Update the grid to its following generation
	 */
	public function update() {
		$temp = array();
		for ( $row = 0; $row < $this->height; ++$row ) {
			for ( $col = 0; $col < $this->width; ++$col ) {
				$temp[ $row ][ $col ] = $this->determineCellFate( $row, $col );
			}
		}
		$this->grid = $temp;
	}
	
	/**
	 * Return a string representation of the grid
	 * @return string
	 */
	public function toString() {
		$string = '+';
		
		// Top edge
		for ( $col = 0; $col < $this->width; ++$col ) {
			$string .= '-';
		}
		$string .= '+' . "\n";
		
		// Content
		for ( $row = 0; $row < $this->height; ++$row ) {
			$string .= '|';
			for ( $col = 0; $col < $this->width; ++$col ) {
				if ( $this->isCellAlive( $row, $col ) ) {
					$string .= 'X';
				} else {
					$string .= ' ';
				}
			}
			$string .= '|' . "\n";
		}
		
		// Bottom edge
		$string .= '+';
		for ( $col = 0; $col < $this->width; ++$col ) {
			$string .= '-';
		}
		$string .= '+' . "\n";
		
		return $string;
	}
	
	/**
	 * Return a parsable string representation of the grid
	 * @return string
	 */
	public function export() {
		$lines = array();
		
		for ( $row = 0; $row < $this->height; ++$row ) {
			$string = '';
			for ( $col = 0; $col < $this->width; ++$col ) {
				if ( $this->isCellAlive( $row, $col ) ) {
					$string .= '*';	// Star represents a live cell
				} else {
					$string .= ' ';	// Blank represents a dead cell
				}
			}
			$lines[] = $string;
		}
		return implode( '|', $lines );	// Pipe represents row separator
	}
	
	/**
	 * Initializes the grid from a string representation produced by
	 * the {@link export} function
	 * @param string
	 */
	public function import( $string ) {
		$lines = explode( '|', $string );
		
		// Validate input
		if ( count ( $lines ) != $this->height ) {
			throw new Exception( 'Invalid input: wrong number of rows found' );
		}
		for ( $row = 0; $row < $this->height; ++$row ) {
			if ( strlen( $lines[ $row ] ) != $this->width ) {
				throw new Exception( 'Invalid input: wrong number of colums found' );
			}
		}
		
		// Import
		for ( $row = 0; $row < $this->height; ++$row ) {
			for ( $col = 0; $col < $this->width; ++$col ) {
				$cell = substr( $lines[ $row ], $col, 1 );	// Single cell character
				$this->grid[ $row ][ $col ] = ( $cell == ' ' ? 0 : 1 );	// Blank represents a dead cell
			}
		}
	}
	
}
