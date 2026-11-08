<?php

$array1 = ['A'];
echo "Array awal: ";
print_r($array1);
echo "<br>";

array_push($array1, 'B');
echo "Hasil array_push: ";
print_r($array1);

echo "<br>";
echo '<br>';

$array2 = ['C'];
echo "Array awal : ";
print_r($array1);
echo "digabung dengan ";
print_r($array2);
echo '<br>';
$array_gabung = array_merge($array1, $array2);
echo "Hasil array_merge : ";
print_r($array_gabung);

echo "<br>";
echo "<br>";

$array3 = ['x' => 1, 'y' => 2];
echo "Array awal : ";
print_r($array3);

echo "<br>";
$value = array_values($array3);
echo "Hasil array_value: ";
print_r($value);

echo "<br>";
echo "<br>";

echo "Mencari \"B\" pada array : ";
print_r($array_gabung);
echo "<br>";
$cari = array_search("B", $array_gabung);
echo "Hasil array_search : ";
print_r($cari);

echo "<br>";
echo "<br>";

$array4 = [0, 1, false, 2, "", 3, "array"];
echo "Array awal : ";
print_r($array4);

echo "<br>";
$hasil = array_filter($array4);
echo "Hasil array_filter : ";
print_r($hasil);

echo "<br>";
echo "<br>";

$array5 = [3,1,2];
echo "Array awal : ";
print_r($array5);

echo "<br>";
sort($array5);
echo "sort : ";
print_r($array5);

rsort($array5);
echo "<br>";
echo "rsort : ";
print_r($array5);

echo "<br>";
echo "<br>";

$array6 = ["Peter" => 35, "Ben" => 37, "Joe" => 43];
echo "<br>";
asort($array6);
echo "asort : ";
print_r($array6);

ksort($array6);
echo "<br>";
echo "ksort : ";
print_r($array6);

echo "<br>";
arsort($array6);
echo "arsort : ";
print_r($array6);

krsort($array6);
echo "<br>";
echo "krsort : ";
print_r($array6);