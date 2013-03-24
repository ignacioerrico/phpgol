<?php

/**
 * Unit tests for the class GameOfLife
 * 
 * Execute from the console:
 *   $ phpunit gameOfLifeTest
 */

require_once 'PHPUnit/Framework.php';
require_once 'gameOfLife.php';

use gameoflife\GameOfLife;

class GameOfLifeTest extends PHPUnit_Framework_TestCase
{
	protected $gol;
	
	protected function setUp() {
		$this->gol = new GameOfLife( 5, 2 );
	}
	
	public function testExport() {
		// Arrange
		$this->gol->chessBoardInit();
		
		// Act
		$s = $this->gol->export();
		
		// Assert
		$this->assertEquals( $s, ' * * |* * *' );
	}
	
	public function testImport() {
		// Arrange
		$this->gol->chessBoardInit();
		
		// Act
		try {
			$s = $this->gol->import( ' * * |* * *' );
		} catch( Exception $e ) {
			$this->fail();
			return;
		}
		
		// Assert
		$s = $this->gol->export();
		$this->assertEquals( $s, ' * * |* * *' );
	}
	
}
