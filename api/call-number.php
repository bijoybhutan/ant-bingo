<?php
header("Content-Type: application/json");
require '../database/connection.php';

$stmt = $pdo->query("SELECT number FROM called_numbers");
$calledNumbers = $stmt->fetchAll(PDO::FETCH_COLUMN);

do {
    $number = rand(1, 100);
} while (in_array($number, $calledNumbers));

$stmt = $pdo->prepare("INSERT INTO called_numbers (number) VALUES (?)");
$stmt->execute([$number]);

echo json_encode(["number" => $number]);
