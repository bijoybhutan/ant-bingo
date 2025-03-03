<?php
header("Content-Type: application/json");

$numbers = range(1, 100);
shuffle($numbers);

$card = [];
for ($i = 0; $i < 25; $i++) {
    if ($i === 12) {
        $card[] = "FREE";
    } else {
        $card[] = array_pop($numbers);
    }
}

echo json_encode(["card" => $card]);
