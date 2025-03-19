<?php
include 'helper.php';

$config = loadConfig('./config.json');
$entity_id = $_POST['entity_id'] ?? null;
$service = $_POST['service'] ?? null;
if ($entity_id && $service) {
    $result = sendCommandToDevice($config, $entity_id, $service);
    echo json_encode(["success" => empty($result)]);
} else {
    echo json_encode(["success" => false, "error" => "Missing parameters."]);
}
