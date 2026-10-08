<?php
require 'db.php';

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $result = $db->query("SELECT * FROM orders WHERE id = $id");
        $order = $result->fetch_assoc();

        if ($order) {
            sendJSON($order);
        } else {
            http_response_code(404);
            sendJSON(["error" => "Заказ не найден"]);
        }
    } else {
        $result = $db->query("SELECT * FROM orders");
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        sendJSON($orders);
    }
}
elseif ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = (int)$data['user_id'];
    $product = $db->real_escape_string($data['product']);
    $price   = (float)$data['price'];

    $db->query("INSERT INTO orders (user_id, product, price) VALUES ($user_id, '$product', $price)");
    $new_id = $db->insert_id;

    http_response_code(201);
    sendJSON(["id" => $new_id, "user_id" => $user_id, "product" => $product, "price" => $price]);
}
elseif ($method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id      = (int)$data['id'];
    $user_id = (int)$data['user_id'];
    $product = $db->real_escape_string($data['product']);
    $price   = (float)$data['price'];

    $db->query("UPDATE orders SET user_id=$user_id, product='$product', price=$price WHERE id=$id");

    sendJSON(["id" => $id, "user_id" => $user_id, "product" => $product, "price" => $price]);
}
elseif ($method === 'DELETE') {
    $id = (int)$_GET['id'];
    $db->query("DELETE FROM orders WHERE id = $id");

    sendJSON(["message" => "Заказ удалён", "id" => $id]);
}
else {
    http_response_code(405);
    sendJSON(["error" => "Метод не поддерживается"]);
}