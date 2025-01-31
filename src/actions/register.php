<?php
require_once __DIR__ . "/../helpers.php";



$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirmation = $_POST['password_confirmation'] ?? null;
$avatar = $_FILES['avatar'] ?? null;
$avatarPath = null;

$_SESSION['validation'] =[];

if(empty($name)) setValidationError('name', 'Неверное имя');
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) setValidationError('email', 'Неверная почта');
if(empty($password)) setValidationError('password', 'Неверный пароль');
if($password !== $passwordConfirmation) setValidationError('password', 'Пароли не совпадают');
if(!empty($avatar)){
    $types = ['image/jpeg', 'image/png'];

    if(!in_array($avatar['type'], $types)) setValidationError('avatar', 'Не верный формат изображения');
    if ($avatar['size'] / 1000000 >= 2) setValidationError('avatar', 'Изображение должно быть меньше 2МБ');
}

if (!empty($_SESSION['validation'])){
    setOldValue('name', $name);
    setOldValue('email', $email);
    redirect('/register.php');
}

if(!empty($avatar)) $avatarPath = uploadFile($avatar, 'avatar');

$pdo = getPDO();

$query = "INSERT INTO `users` (name, email, avatar, password) VALUES (:name, :email, :avatar, :password)";
$params = [
    'name' => $name,
    'email' => $email,
    'avatar' => $avatarPath,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
$stmt = $pdo->prepare($query);
try{
    $stmt->execute($params);
}catch (\Exception $e){
    die("Connection error; {$e->getMessage()}");
}

redirect('/');