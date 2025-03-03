<?php
header("Content-Type: application/json");
require '../database/connection.php';

$stmt = $pdo->query("
    SELECT p.name, ph.score 
    FROM player_history ph
    JOIN players p ON ph.player_id = p.id
    ORDER BY ph.score DESC
");
$leaderboard = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["leaderboard" => $leaderboard]);
