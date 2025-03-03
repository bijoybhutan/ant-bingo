<?php
header("Content-Type: application/json");
require '../database/connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$playerId = $data['player_id'];
$score = $data['score'];

$stmt = $pdo->prepare("INSERT INTO player_history (player_id, score) VALUES (?, ?)");
$stmt->execute([$playerId, $score]);

echo json_encode(["success" => "Score saved"]);
