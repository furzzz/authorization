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

    <label for="name">
        Имя
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Иванов Иван"
            value="<?php echo returnOldValues('name')?>"
            required
            <?php echo validationErrorAttr('name');?>
        >
        <?php if(hasValidationError('name')): ?>
            <small><?php echo validationErrorMassage('name');?></small>
        <?php endif; ?>
    </label>

    <label for="email">
        E-mail
        <input
            type="text"
            id="email"
            name="email"
            placeholder="furzik@furz.ru"
            value="<?php echo returnOldValues('email')?>"
            required
            <?php echo validationErrorAttr('email');?>
        >
        <?php if(hasValidationError('email')): ?>
            <small><?php echo validationErrorMassage('email');?></small>
        <?php endif; ?>
    </label>

    <label for="avatar">Изображение профиля
        <input
            type="file"
            id="avatar"
            name="avatar"
            <?php echo validationErrorAttr('avatar');?>
        >
        <?php if(hasValidationError('avatar')): ?>
            <small><?php echo validationErrorMassage('avatar');?></small>
        <?php endif; ?>
    </label>

    <div class="grid">
        <label for="password">
            Пароль
            <input
                type="password"
                id="password"
                name="password"
                placeholder="******"
                required
                <?php echo validationErrorAttr('password');?>
            >
            <?php if(hasValidationError('password')): ?>
                <small><?php echo validationErrorMassage('password');?></small>
            <?php endif; ?>
        </label>

        <label for="password_confirmation">
            Подтверждение
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="******"
                required
            >
        </label>
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