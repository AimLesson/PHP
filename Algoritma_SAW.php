<?php

$data = array(
    array(10000000, 35, 110, 7),
    array(12000000, 45, 125, 6),
    array(15000000, 40, 150, 8),
    array(14000000, 37.5, 125, 7.5)
);

$bobot = array(0.35, 0.25, 0.15, 0.25);

$maksNormalisasi = array();

for ($i = 0; $i < 4; $i++) {
    $maksNormalisasi[$i] = ($i == 0) ? PHP_INT_MAX : 0;

    for ($j = 0; $j < 4; $j++) {
        if ($i == 0) {
            $maksNormalisasi[$i] = min($maksNormalisasi[$i], $data[$j][$i]);
        } else {
            $maksNormalisasi[$i] = ($maksNormalisasi[$i] < $data[$j][$i]) ? $data[$j][$i] : $maksNormalisasi[$i];
        }
    }
}

$normalisasi = array();

for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $normalisasi[$i][$j] = ($j == 0) ? $maksNormalisasi[$j] / $data[$i][$j] : $data[$i][$j] / $maksNormalisasi[$j];
    }
}

$motor = "";
$maks = 0;
$nilai = array();

echo "\n";
echo "Hasil nilai akhir adalah\n";

for ($i = 0; $i < 4; $i++) {
    $nilai[$i] = 0;

    for ($j = 0; $j < 4; $j++) {
        $nilai[$i] += $normalisasi[$i][$j] * $bobot[$j];
    }

    echo "| Motor " . chr($i + 65) . ": " . number_format($nilai[$i], 2) . "\n";
}

$maxIndex = array_search(max($nilai), $nilai);
echo "\n| Motor dengan kriteria terbaik adalah motor " . chr($maxIndex + 65) . " dengan nilai ".number_format($nilai[$maxIndex], 2)." \n";
?>
