<?php

$fruits = array('Avocado', 'Blueberry', 'Cherry');

// Soal 1.1
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

$jumlah = count($fruits);
echo "Nilai dengan indeks tertinggi: ". $fruits[$jumlah - 1] . "<br>";
echo "fruits = ";
print_r($fruits);

echo "<br>";

// Soal 1.2
echo "Data $fruits[1] dihapus.";
unset($fruits[1]);

echo "<br>";
echo "<br>";

echo "Nilai dengan indeks tertinggi: ". $fruits[$jumlah - 1] . "<br>";
echo "fruits = ";
print_r($fruits);

echo "<br>";


?>
