<?php

$height = array('Andy' => "176", 'Barry' => '165', 'Charlie' => '170');
$height['David'] = '180';
$height['Ethan'] = '172';
$height['Frank'] = '168';
$height['George'] = '175';
$height['Harry'] = '182';

print_r($height);

echo "<br>";

foreach ($height as $key => $value) {
	echo "$key is $value cm tall <br>";
}

$weight = array('Andy' => '70', 'Barry' => '65', 'Charlie' => '75');
print_r($weight);
echo "<br>";

$keys = array_keys($weight);
$panjang = count($weight);

for ($i=0; $i <= $panjang - 1; $i++) { 
	$index = $keys[$i];
	$isi = $weight[$index];
	echo "$index is $isi kg <br>";
}