<?php
require_once __DIR__ . '/src/helpers.php';
checkGuest();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body>

<form class="card" action="src/actions/register.php" method="post" enctype="multipart/form-data">
    <h2>Регистрация</h2>
    <?php echo inputElement('name', 'Имя', 'text', ['placeholder' => 'Иван Иванов']) ?>


    <?php echo inputElement('email', 'E-mail', 'text', ['placeholder' => 'furzik@furz.ru']) ?>
    <?php echo inputElement('avatar', 'Изображение профиля', 'file') ?>


    <div class="grid">
        <?php echo inputElement('password', 'Пароль', 'password', ['placeholder' => '********']) ?>
        <?php echo inputElement('password_confirmation', 'Подтверждение', 'password', ['placeholder' => '********']) ?>
    </div>

    <fieldset>
        <label for="terms">
            <input
                type="checkbox"
                id="terms"
                name="terms"
            >
            Я принимаю все условия пользования
        </label>
    </fieldset>

    <button
        type="submit"
        id="submit"
        disabled
    >Продолжить</button>
</form>

<p>У меня уже есть <a href="/index.php">аккаунт</a></p>

<script src="assets/app.js"></script>
</body>
</html>