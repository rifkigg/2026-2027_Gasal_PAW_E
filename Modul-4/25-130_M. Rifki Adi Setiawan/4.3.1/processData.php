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
		require 'validate.inc'; 
		$errors = array();
		validateName($errors, $_POST, 'surname'); 
		if($errors){
			echo 'Errors:<br/>';
			foreach ($errors as $field => $error)
				echo "$field $error</br>";
		} else
			echo 'Data OK!';

		echo "<br>";
		foreach ($_POST as $key => $value) {
			echo "($key) => ($value) <br>";
		}
	?>
</body>
</html>