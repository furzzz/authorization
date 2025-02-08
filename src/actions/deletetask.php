<?php
require_once __DIR__.'/../helpers.php';

$id = $_SESSION['taskID'] ?? null;

$pdo = getPDO();

$query = "DELETE FROM `tasks` WHERE `id` = :id";
$params = ['id' => $id];
$stmt = $pdo->prepare($query);
try{
    $stmt->execute($params);
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()} $id");
}

$_SESSION['taskID'] = [];
redirect('/');
?>