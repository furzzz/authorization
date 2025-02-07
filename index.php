<?php
require_once __DIR__ . '/src/helpers.php';
checkGuest();
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body>

<form class="card" action="src/actions/login.php" method="post">
    <h2>Вход</h2>

    <?php if(hasMessage('error')):?>
        <div class="notice error">
            <?php echo getMessage('error');?>
        </div>
    <?php endif; ?>
    <?php echo inputElement('email', 'E-mail', 'text', ['placeholder' => 'furzik@furz.ru']) ?>
    <?php echo inputElement('password', 'Пароль', 'password', ['placeholder' => '********']) ?>

    <button
        type="submit"
        id="submit"
    >Продолжить</button>
</form>

<p>У меня еще нет <a href="/register.php">аккаунта</a></p>
</body>
</html>