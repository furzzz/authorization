<?php
require_once __DIR__ . '/src/helpers.php';
checkAuth('/');
$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>LK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body>

<form class="card" action="src/actions/login.php" method="post">
    <h2>Создание задачи</h2>

    <?php if(hasMessage('error')):?>
        <div class="notice error">
            <?php echo getMessage('error');?>
        </div>
    <?php endif; ?>
    <?php echo inputElement('title', 'title', 'text', ['placeholder' => 'Имя задачи']) ?>
    <?php echo inputElement('description', 'Описание задачи', 'text', ['placeholder' => 'Описание задачи']) ?>
    <?php echo inputElement('email', 'Кому будет отправлена задача', 'text', ['placeholder' => 'Почта получателя']) ?>
    <button
        type="submit"
        id="submit"
    >Продолжить</button>
</form>
<a href="home.php"><button role="button">Вернуться на главную страницу</button></a>
</body>
</html>