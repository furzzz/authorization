<?php
require_once __DIR__.'/../helpers.php';

$id = $_GET['taskID'] ?? null;
$result = inputSendTasksIdTask($_GET['taskID']);
if ($result['send_task_user_id'] != $_SESSION['user']['id']) {
    http_response_code(403);
    die('Forbidden');
}

$pdo = getPDO();

$query = "UPDATE `tasks` SET `status`= :status WHERE `id` = :id";
$params = [
    'id' => $id,
    'status' => 1
];
$stmt = $pdo->prepare($query);
try{
    $stmt->execute($params);
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()} $id");
}

$_SESSION['taskID'] = [];
redirect('/');