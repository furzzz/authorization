<?php
require_once __DIR__ . '/src/helpers.php';
checkAuth('/');
$user = currentUser();
$task = inputTasksIdTask($_GET['taskID']);
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
<div class="card">
    <form class="card" action="src/actions/uploadtask.php" method="post">
        <h2>Изменение задачи</h2>

        <?php echo inputElement('title', 'Имя задачи', 'text', ['placeholder' => 'Имя задачи', 'value' => $task['title']]) ?>
        <?php echo inputElement('description', 'Описание задачи', 'text', ['placeholder' => 'Описание задачи', 'value' => $task['description']]) ?>
        Статус:
        <select id="date-filter" name="status" style="padding: 0; margin: 5px; ; width: 125px;font-size: 15px; background-position: right">
            <option value="1"<?php if($task['status'] == '1') echo 'selected';?>>Выполнено</option>
            <option value="0" <?php if($task['status'] == '0') echo 'selected';?>>Не выполнено</option>
        </select>
        <?php echo inputElement('date', 'Дата окончания задания', 'date', ['value' => $task['end_data']]) ?>
        <button
            type="submit"
            id="submit"
            name="taskID"
            value="<?php echo $_GET['taskID']?>"
        >Применить</button>
    </form>
    <form action="src/actions/deleteTask.php" method="get">
        <button
            type="submit"
            id="submit"
            name="taskID"
            value="<?php echo $_GET['taskID']?>"
            style="background-color: #762c2c"
        >Удалить задачу</button>
    </form>
    <a href="home.php"><button role="button">Вернуться на главную страницу</button></a>
</div>
</body>
</html>