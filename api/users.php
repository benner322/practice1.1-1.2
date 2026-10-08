<?php
require 'db.php';

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $result = $db->query("SELECT * FROM users WHERE ID = $id");
        $user = $result->fetch_assoc();

        if ($user) {
            sendJSON($user);
        } else {
            http_response_code(404);
            sendJSON(["error" => "Пользователь не найден"]);
        }
    } else {
        $result = $db->query("SELECT * FROM users");
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        sendJSON($users);
    }
}
elseif ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name    = $db->real_escape_string($data['name']);
    $surname = $db->real_escape_string($data['surname']);

    $db->query("INSERT INTO users (name, surname) VALUES ('$name', '$surname')");
    $new_id = $db->insert_id;

    http_response_code(201);
    sendJSON(["ID" => $new_id, "name" => $name, "surname" => $surname]);
}
elseif ($method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id      = (int)$data['id'];
    $name    = $db->real_escape_string($data['name']);
    $surname = $db->real_escape_string($data['surname']);

    $db->query("UPDATE users SET name='$name', surname='$surname' WHERE ID=$id");

    sendJSON(["ID" => $id, "name" => $name, "surname" => $surname]);
}
elseif ($method === 'DELETE') {
    $id = (int)$_GET['id'];
    $db->query("DELETE FROM users WHERE ID = $id");

    sendJSON(["message" => "Пользователь удалён", "ID" => $id]);
}
else {
    http_response_code(405);
    sendJSON(["error" => "Метод не поддерживается"]);
}