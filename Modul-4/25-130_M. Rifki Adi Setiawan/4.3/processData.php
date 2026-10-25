<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Process Data</title>
</head>
<body>
	<h1>Posted Data:</h1>

	<?php
		foreach ($_POST as $key => $value) {
			echo "($key) => ($value) <br>";
		}
	?>
</body>
</html>