<?php
require_once __DIR__.'/../helpers.php';

$id = $_SESSION['taskID'] ?? null;
$status = $_POST['status']?'1': '0';

$pdo = getPDO();

$query = "UPDATE `tasks` SET `status`= :status WHERE `id` = :id";
$params = [
    'id' => $id,
    'status' => $status
];
$stmt = $pdo->prepare($query);
try{
    $stmt->execute($params);
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()} $id");
}

$_SESSION['taskID'] = [];
redirect('/');