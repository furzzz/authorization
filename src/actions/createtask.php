<?php
require_once __DIR__.'/../helpers.php';

$title = $_POST['title'] ?? null;
$description = $_POST['description'] ?? null;
$emailSend = $_POST['emailSend'] ?? null;
$date = $_POST['date'] ?? null;
$dateParse = date_parse($date);
$currentDateTime = new DateTime('now');
$currentDate = $currentDateTime->format('Y-m-d');

setOldValue('emailSend', $emailSend);
setOldValue('title', $title);
setOldValue('description', $description);
setOldValue('date', $date);

if (empty($emailSend) || !filter_var($emailSend, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Неверный формат электронной почты');
    setMessage('error', 'Ошибка валидации');
    setOldValue('email', $emailSend);
    redirect('/createTask.php');
}
$userSend = findUser($emailSend);
if (!$userSend) {
    setMessage('error', "Пользователь $emailSend не найден");
    setOldValue('email', $emailSend);
    redirect('/createTask.php');
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
if(!checkdate($dateParse['month'], $dateParse['day'], $dateParse['year']) || $date <= $currentDate || $dateParse['year'] > (date_parse($currentDate)['year'] + 5)) {
    setMessage('error', "Ошибка");
    setValidationError('date', 'Поле даты указано неверно');
    redirect('/createTask.php');
}

$pdo = getPDO();

$query = 'INSERT INTO `tasks` (`created_task_user_id`, `send_task_user_id`, `title`, `description`, `status`, `created_data`, `end_data`) 
VALUES (:createdTaskUserId, :sendTaskUserId, :title, :description, :status, :createdDate, :endDate)';
$params = [
    'createdTaskUserId' => $_SESSION['user']['id'],
    'sendTaskUserId' => $userSend['id'],
    'title' => $title,
    'description' => $description,
    'status' => 0,
    'createdDate' => $currentDate,
    'endDate' => $date
];
$stmt = $pdo->prepare($query);
try{
    $stmt->execute($params);
    resetOldValue('emailSend');
    resetOldValue('title');
    resetOldValue('description');
    resetOldValue('date');
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()}");
}

redirect('/');
?>