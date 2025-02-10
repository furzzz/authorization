<?php
require_once __DIR__.'/../helpers.php';

$id = $_POST['taskID'] ?? null;
$title = $_POST['title'] ?? null;
$description = $_POST['description'] ?? null;
$date = $_POST['date'] ?? null;
$dateParse = date_parse($date);
$currentDateTime = new DateTime('now');
$currentDate = $currentDateTime->format('Y-m-d');
$status = $_POST['status']?'1': '0';

$result = inputCreatedTasksIdTask($_POST['taskID']);
if ($result['created_task_user_id'] != $_SESSION['user']['id']) {
    http_response_code(403);
    die('Forbidden');
}

if(empty($title)) {
    setMessage('error', "Ошибка");
    setValidationError('title', 'Пустое поле имя');
    redirect('/createTask.php');
}
if(empty($description)) {
    setMessage('error', "Ошибка");
    setValidationError('description', 'Пустое поле описание');
    redirect('/createTask.php');
}

if(empty($date)) {
    setMessage('error', "Ошибка");
    setValidationError('date', 'Пустое поле даты окончания задания');
    redirect('/createTask.php');
}
if(!checkdate($dateParse['month'], $dateParse['day'], $dateParse['year']) || $date <= $currentDate) {
    setMessage('error', "Ошибка");
    setValidationError('date', 'Поле даты указано неверно');
    redirect('/createTask.php');
}

$pdo = getPDO();

$query = "UPDATE `tasks` SET `title`= :title ,`description`= :description ,`status`= :status , `end_data` = :endDate WHERE `id` = :id";
$params = [
    'id' => $id,
    'title' => $title,
    'description' => $description,
    'status' => $status,
    'endDate' => $date
];
$stmt = $pdo->prepare($query);
try{
    $stmt->execute($params);
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()} $id");
}

$_SESSION['taskID'] = [];
redirect('/youTask.php');
?>