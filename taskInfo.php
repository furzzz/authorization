<?php
require_once __DIR__ . '/src/helpers.php';
checkAuth('/');
$user = currentUser();
$task = inputSendTasksIdTask($_GET['taskID']);

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
    <h2 style="padding: 0; margin: 5px;">Задача:</h2>
    <h4 style="padding: 0; margin: 5px;">Наименование задачи:</h4>
    <div class="card" style="padding: 10px; margin: 5px">
        <?php echo $task['title'] ?>
    </div>
    <h4 style="padding: 0; margin: 5px;">Описание задачи:</h4>
    <div class="card" style="padding: 10px; margin: 5px">
        <?php echo $task['description'] ?>
    </div>
    <h4 style="padding: 0; margin: 5px;">Cтатус задачи:</h4>
    <div class="card" style="padding: 10px; margin: 5px">
        <select id="date-filter" name="status" style="padding: 0; margin: 5px; ; width: 200px;font-size: 20px; background-position: right" disabled>
            <option value="1"<?php if($task['status'] == '1') echo 'selected';?>>Выполнено</option>
            <option value="0" <?php if($task['status'] == '0') echo 'selected';?>>Не выполнено</option>
        </select>
    </div>
    <h4 style="padding: 0; margin: 5px;">Дата окончания задачи:</h4>
    <div class="card" style="padding: 10px; margin: 5px">
        <?php echo inputElement('date', 'Дата окончания задания', 'date', ['value' => $task['end_data']],false, true) ?>
    </div>
   <?php if($task['status'] == '0'): ?>
        <form action="src/actions/statustrue.php" method="get" style="padding: 0; margin: 5px; display: flex; flex-direction: column;">
            <button name="taskID" value="<?php echo $_GET['taskID'];?>" style="padding: 5px; margin: 5px; width: auto"
                    type="submit"
                    id="submit"
            >Выполнено</button>
        </form>
    <?php endif; ?>

    <?php if($task['status'] == '1'): ?>
        <form action="src/actions/deleteTaskSender.php" method="get" style="padding: 0; margin: 5px; display: flex; flex-direction: column;">
            <button name="taskID" value="<?php echo $_GET['taskID'];?>" style="padding: 5px; margin: 5px; width: auto; background-color: #762c2c"
                    type="submit"
                    id="submit"
            >Удалить задачу</button>
        </form>
    <?php endif; ?>
    <a href="home.php"><button role="button">Вернуться на главную страницу</button></a>
</div>

</body>
</html>