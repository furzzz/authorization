<?php
require_once __DIR__ . '/src/helpers.php';
checkAuth('/');
$user = currentUser();
$status = $_GET['status'] ?? 'DESC';
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
        <div class="card home" style="display: flex; flex-direction: column; align-items: center; row-gap: 20px; padding: 100px; width: 900px">
            <img
                    class="avatar"
                    src="<?php echo $user['avatar']?>"
                    alt="<?php echo $user['name']?>"
            >
            <h2 style="padding: 0; margin: 0;">Привет, <?php echo $user['name']?>!</h2>
            <form action="src/actions/logout.php" method="post" style="padding: 0; margin: 0; ">
                <button role="button" style="padding: 10px; margin: 0;">Выйти из аккаунта</button>
            </form>

            <div class="buttons" style="display: flex; flex-direction: row; align-items: center; margin: 5px">
                <a href="createTask.php" style="margin: 5px"><button role="button" style="padding: 15px; border: 5px;">Создать задачу</button></a>
                <a href="youTask.php" style="margin: 5px"><button role="button" style="padding: 15px; border: 5px;">Задачи которые вы дали</button></a>
            </div>
        <h2 style="padding: 0; margin: 0;">Текущие задачи</h2>
        <form class="card" action="home.php" method="get" style='display: flex; flex-direction: row; align-items: center; padding: 10px; margin: 0;'>
            <label for="date-filter" style="font-size: 15px">Фильтровать по статусу:</label>
            <select id="date-filter" name="status" style="padding: 0; margin: 5px; ; width: 125px;font-size: 15px; background-position: right">
                <option value="DESC">Выполнено</option>
                <option value="ASC">Не выполнено</option>
            </select>
            <button role="button" style="padding: 0; margin: 0; font-size: 15px; width: 90px; height: 25px;">применить</button>
        </form>
            <form action="taskInfo.php" method="get">
                <ul id="task-list" style=" display: flex; flex-direction: column; align-items: center; width: 550px;">
                    <?php inputTasksTitleCurrentUser($status, 'send_task_user_id', $_SESSION['user']['id'] ?? null);?>
                </ul>
            </form>
        </div>
<script src="assets/app.js"></script>
</body>
</html>