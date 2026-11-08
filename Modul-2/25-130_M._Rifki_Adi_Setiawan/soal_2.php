<?php 

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

foreach ($matkul as $key => $value) {
	switch ($value) {
		case 'PTI':
		case 'ALPRO':
		case 'DPW':
		case 'STRUKDAT':
		case 'JARKOM':
		case 'PAW':
			echo "Saya suka $value <br>";
			break;

		default:
			echo "Saya tidak mengambil matkul $value <br>";
			break;
	}
}


?>