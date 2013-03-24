<?php
namespace gameoflife;

if ( empty( $_POST ) ) {	// If no post information received
	header( 'Location: index.php' );	// Redirect to index.php
}

require_once 'gameOfLife.php';

$width = intval( $_POST[ 'width' ] );
$height = intval( $_POST[ 'height' ] );
$generation = intval( $_POST[ 'generation' ] );

$gol = new GameOfLife( $width, $height );	// Initialize

if ( isset( $_POST[ 'init' ] ) ) {	// If request to initialize grid received
	$gol->randomInit();	// Initialize grid
} else {	// Assume request for next generation received
	$gol->import( $_POST[ 'grid' ] );
	$gol->update();
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
	<title>Conway's Game of Life</title>
	<meta charset="UTF-8" />
	<style>
		table {
			border-collapse: collapse;
			border: 2px solid black;
		}
		
		table tr td {
			background-color: #ffffc0;
			width: 5px;
			height: 5px;
		}
		
		table tr td.alive {
			background-color: #808080;
		}
	</style>
</head>

<body>
	<h1>Conway's Game of Life</h1>
	
	<p>Generation: <?php echo $generation; ?></p>
	
	<table>
		<?php for ( $row = 0; $row < $gol->getHeight(); ++$row ): ?>
		<tr>
			<?php for ( $col = 0; $col < $gol->getWidth(); ++$col ): ?>
			<td
			<?php if ( $gol->isCellAlive( $row, $col ) ): ?>
			class="alive"
			<?php endif; ?>
			></td>
			<?php endfor; ?>
		</tr>
		<?php endfor; ?>
	</table>
	
	<form action="<?php echo basename( __FILE__ ); ?>" method="post">
		<!--
			This is my suggested solution if I have to use a stateless protocol like HTTP.
			It is simple and it works fine (at the cost of sending the current grid
			configuration with every request).  An alternative would be to use cookies,
			but the size limit for cookies could be an issue.
		-->
		<input type="hidden" name="grid" value="<?php echo $gol->export(); ?>" />
		<input type="hidden" name="width" value="<?php echo $width;?>" />
		<input type="hidden" name="height" value="<?php echo $height;?>" />
		<input type="hidden" name="generation" value="<?php echo ++$generation;?>" />
		<input type="submit" name="submit" id="submit" value="Next generation" style="margin-top: 1em;" />
	</form>
	
	<button id="new"
		onclick="window.location.assign( 'index.php' );"
		style="margin-top: 1em;">Create a new population</button>
	
</body>
</html>
