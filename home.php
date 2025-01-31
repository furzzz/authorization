<?php
require_once __DIR__ . '/src/helpers.php';
checkAuth();
$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>AreaWeb - авторизация и регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body>

<div class="card home">
    <img
        class="avatar"
        src="<?php echo $user['avatar']?>"
        alt="<?php echo $user['name']?>"
    >
    <h1>Привет, <?php echo $user['name']?>!</h1>
    <form action="src/actions/logout.php" method="post">
        <button href="#" role="button">Выйти из аккаунта</button>
    </form>
</div>

<script src="assets/app.js"></script>
</body>
</html>