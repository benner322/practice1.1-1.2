<?php
header('Content-Type: application/json; charset=utf-8');

function getDB() {
    $mysqli = new mysqli("db", "user", "password", "appDB");
    if ($mysqli->connect_errno) {
        http_response_code(500);
        echo json_encode(["error" => "DB connection failed"]);
        exit;
    }
    $mysqli->set_charset("utf8mb4");
    return $mysqli;
}

function sendJSON($data) {
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}