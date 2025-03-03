<?php
header("Content-Type: application/json");
require '../database/connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$playerId = $data['player_id'];
$number = $data['number'];

$stmt = $pdo->prepare("SELECT number FROM called_numbers WHERE number = ?");
$stmt->execute([$number]);
if (!$stmt->fetch()) {
    echo json_encode(["error" => "Number not called yet"]);
    exit;
}

echo json_encode(["success" => "Number marked"]);
