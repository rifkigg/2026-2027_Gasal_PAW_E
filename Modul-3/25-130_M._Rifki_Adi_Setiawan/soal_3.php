<?php
$height = array('Andy' => "176", 'Barry' => '165', 'Charlie' => '170');
$panjang = count($height); 

$height['David'] = '180';
$height['Ethan'] = '172';
$height['Frank'] = '168';
$height['George'] = '175';
$height['Harry'] = '182';

echo "height = ";
print_r($height);
echo "<br>";
echo "Nilai dengan indeks terakhir : ". $height['Harry'];

echo "<br>";

unset($height['Barry']);
echo "height = ";
print_r($height);
echo "<br>";
echo "Nilai dengan indeks terakhir : ". $height['Harry'];
echo "<br>";

$weight = array('Andy' => '70', 'Barry' => '65', 'Charlie' => '75');
echo "Data kedua : ". $weight['Barry'];
