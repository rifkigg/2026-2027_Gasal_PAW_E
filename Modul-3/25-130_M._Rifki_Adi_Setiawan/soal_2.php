<?php
// Soal 2.1
$fruits = array("Avocado","Blueberry","Cherry");

for($i = 1; $i <= 5; $i++){
	$fruits[] = "Buah tambahan $i";
}

$arrlength = count($fruits);

echo "Panjang array saat ini: $arrlength <br>";

for($x = 0; $x < $arrlength; $x++) {
	echo $fruits[$x];
	echo "<br>";
}

echo "<br>";
// Soal 2.2
$vegies = array('Carrot', 'Brocolli', 'Spinach');
$arrlengthVegies = count($vegies);
for($x = 0; $x < $arrlengthVegies; $x++) {
	echo $vegies[$x];
	echo "<br>";
}
?>