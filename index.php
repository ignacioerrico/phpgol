<!DOCTYPE html> 
<html lang="en">
<head>
	<title>Conway's Game of Life</title>
	<meta charset="UTF-8" />
</head>

<body>
	<h1>Conway's Game of Life</h1>
	
	<p>The well-known cellular automaton devised by the British
	mathematician John Horton Conway, implemented in PHP >= 5.3
	by <a href="mailto:Ignacio@Errico.com.ar">Ignacio Errico</a>.
	</p>
	
	<form action="web.php" method="post">
		<input type="hidden" name="init" value="init" />
		<input type="hidden" name="generation" value="1" />
		Please enter grid width: <input type="text" name="width" id="txtWidth" value="60" />
		<br />
		Please enter grid height: <input type="text" name="height" value="20" />
		<br />
		<input type="submit" name="submit" value="Start simulation" style="margin-top: 1em;" />
	</form>
	
	<script>
		window.onload = function() {
		  document.getElementById( 'txtWidth' ).focus();
		}
	</script>
	
</body>
</html>
