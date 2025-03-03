<?php
header("Content-Type: application/json");
require '../database/connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];


$stmt = $pdo->prepare("SELECT id FROM players WHERE name = ?");
$stmt->execute([$name]);
if ($stmt->fetch()) {
    echo json_encode(["error" => "Name already exists"]);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO players (name) VALUES (?)");
$stmt->execute([$name]);
echo json_encode(["success" => "Player registered", "player_id" => $pdo->lastInsertId()]);
