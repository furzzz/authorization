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
<div class="card" style="display: flex; flex-direction: column; align-items: center; row-gap: 20px; padding: 100px; width: 900px">
    <form method="get" action="uploadtask.php" style="margin: 0; width: auto; padding: 0">
        <h2 style="margin: 5px; padding: 0">Ваши задачи:</h2>
        <ul style="display: flex; flex-direction: column; align-items: center;">
            <?php inputTasksTitleCurrentUser('DESC', 'created_task_user_id');?>
        </ul>
    </form>

    <a href="home.php"><button role="button">Вернуться на главную страницу</button></a>
</div>
</body>
</html>