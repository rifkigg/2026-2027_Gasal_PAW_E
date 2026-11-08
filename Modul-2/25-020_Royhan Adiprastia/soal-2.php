<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

foreach ($matkul as $namaMatkul) {

    switch ($namaMatkul) {

        case "PTI":
            echo "Saya suka " . $namaMatkul . "<br>";
            break;

        case "ALPRO":
            echo "Saya suka " . $namaMatkul . "<br>";
            break;

        case "DPW":
            echo "Saya suka " . $namaMatkul . "<br>";
            break;

        case "STRUKDAT":
            echo "Saya suka " . $namaMatkul . "<br>";
            break;

        case "JARKOM":
            echo "Saya suka " . $namaMatkul . "<br>";
            break;

        case "PAW":
            echo "Saya suka " . $namaMatkul . "<br>";
            break;

        default:
            echo "Saya tidak mengambil matkul " . $namaMatkul . "<br>";
    }
}

?>