<?php
require_once __DIR__.'/../helpers.php';

$result = inputCreatedTasksIdTask($_GET['taskID']);
if ($result['created_task_user_id'] != $_SESSION['user']['id']) {
    http_response_code(403);
    die('Forbidden');
}

$pdo = getPDO();

$query = "DELETE FROM `tasks` WHERE `id` = :id";
$params = ['id' => $_GET['taskID'] ?? null];
$stmt = $pdo->prepare($query);

try{
    $stmt->execute($params);
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()} $id");
}

redirect('/');
?>