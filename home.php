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
<div class="card home">
    <img
            class="avatar"
            src="<?php echo $user['avatar']?>"
            alt="<?php echo $user['name']?>"
    >
    <h2 style="padding: 0; margin: 0;">Привет, <?php echo $user['name']?>!</h2>
    <form action="src/actions/logout.php" method="post" style="padding: 0; margin: 0; ">
        <button role="button" style="padding: 10px; margin: 0;">Выйти из аккаунта</button>
    </form>

    <div class="buttons">
        <a href="createTask.php" style="padding: 0; margin: 0;"><button role="button">Создать задачу</button></a>
        <a href="#" style="padding: 0; margin: 0;"><button role="button">Задачи которые вы дали</button></a>
    </div>

    <div class="filters">
        <h2 style="padding: 0; margin: 0;">Текущие задачи</h2>
        <label for="date-filter">Фильтровать по статусу:</label>
        <select id="date-filter">
            <option value="">Выполнено</option>
            <option value="today">Не выполнено</option>
        </select>

        <form action="#" method="post" style="padding: 0; margin: 0; ">
            <ul id="task-list">
                <?php inputTasksTitleCurrentUser();?>
            </ul>
        </form>
</div>

<script src="assets/app.js"></script>
</body>
</html>