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
    <h1>Привет, <?php echo $user['name']?>!</h1>
    <form action="src/actions/logout.php" method="post">
        <button role="button">Выйти из аккаунта</button>
    </form>

    <a href="createTask.php"><button role="button">Создать задачу</button></a>
    <a href="#"><button role="button">Задачи которые вы дали</button></a>
    <h1>Текущие задачи</h1>
    <div class="filters">
        <label for="date-filter">Фильтровать по статусу:</label>
        <select id="date-filter">
            <option value="">Выполнено</option>
            <option value="today">Не выполнено</option>
        </select>
    <ul id="task-list">
        <!-- Задачи будут -->
    </ul>
</div>

<script src="assets/app.js"></script>
</body>
</html>