<?php
require_once __DIR__ . '/../helpers.php';

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

$user = findUser($email);

if(!$user){
    setMessage('error', "Пользователь $email не найден");
    redirect('/');
}

if(!password_verify($password, $user['password'])){
    setMessage('error', "Неверный пароль");
    redirect('/');
}
if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    setValidationError('email', 'Неверный формат электронной почты');
    setMessage('error', 'Ошибка валидации');
    setOldValue('email', $email);
    redirect('/');
}

$_SESSION['user']['id'] = $user['id'];

redirect('/home.php');