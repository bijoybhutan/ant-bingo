<?php
header("Content-Type: application/json");
require '../database/connection.php';

$pdo->exec("DELETE FROM called_numbers");
echo json_encode(["success" => "Game reset"]);
