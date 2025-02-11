<?php
session_start();
require_once __DIR__ . '/config.php';
function redirect(string $path)
{
    header("Location: $path");
    die();
}

function setValidationError(string $fieldName, string $message)
{
    $_SESSION['validation'][$fieldName] = $message;
}

function hasValidationError(string $fieldName) : bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

function validationErrorAttr(string $fieldName) : string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMassage(string $fieldName) : string
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    $_SESSION['validation'][$fieldName] = null;
    return $message;
}

function setOldValue(string $key, mixed $value) : void
{
    $_SESSION['old'][$key] = $value;
}

function returnOldValue(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function resetOldValue(string $key)
{
    unset($_SESSION['old'][$key]);
}

function uploadFile(array $file, string $prefix) : string
{
    $uploadPath = __DIR__ . '../../uploads';

    if(!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix . '_' . time() . ".$ext";

    if(!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) die ('Ошибка при загрузке фвйла на сервер');

    return  "uploads/$fileName";
}

function setMessage(string $key, string $value) : void
{
    $_SESSION['message'][$key] = $value;
}

function hasMessage(string $key) : bool
{
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key) : string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function getPDO() : PDO
{
    try{
        return new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    }catch (\Exception $e){
        die($e->getMessage());
    }
}

function findUser(string $email) : array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function currentUser() : array|bool
{
    $pdo = getPDO();
    if(!isset($_SESSION['user'])) return false;
    $userID = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $userID]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function logout() : void
{
    unset($_SESSION['user']);
    redirect('/');
}
function checkAuth(string $path) : void
{
    if(!isset($_SESSION['user']['id'])) redirect($path);
}
function checkGuest() : void
{
    if(isset($_SESSION['user']['id'])) redirect('/home.php');
}

function inputElement(string $name, string $label, string $type = 'text', array $options = [], bool $required = true, bool $disabled = false)
{
    $block = '<label for="' . htmlspecialchars($name) . '">
        ' . $label . '
        <input
            style="margin: 5px;"
            type="' . htmlspecialchars($type) . '"
            id="' . htmlspecialchars($name) . '"
            name="' . htmlspecialchars($name) . '"
            placeholder="' . htmlspecialchars($options['placeholder'] ?? "") . '"
            value="' . htmlspecialchars($options['value']?? returnOldValue($name)) . '"';
    if($required) $block .= 'required';
    if($disabled) $block .= 'disabled';
    $block .= validationErrorAttr($name) . ' />';

    if (hasValidationError($name)) {
        $block .= '<small>' . validationErrorMassage($name) . '</small>';
    }

    $block .= '</label>';
    return $block;
}

function inputTasksCurrentUser(string $status, string $table, $valueId) : array
{
    if(!isset($_SESSION['user'])) return false;

    $pdo = getPDO();

    $stmt = $pdo->prepare('SELECT * FROM `tasks` WHERE `' . $table . '` = :id ORDER BY `status` ' . $status . ';');
    $stmt->execute(['id' => $valueId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $task){
            if ($task['send_task_user_id'] != $_SESSION['user']['id'] && $task['created_task_user_id'] != $_SESSION['user']['id']) {
                http_response_code(403);
                die('Forbidden');
            }
        }
    return $result;
}

function inputTasksTitleCurrentUser(string $status, string $table)
{

    $list = '';
    $tasks = inputTasksCurrentUser($status, $table, $_SESSION['user']['id'] ?? null);
    foreach($tasks as $task){
        foreach ($task as $key => $value){
            if($key === 'id') $taskID = $value;
            if($key === 'title') $list.= '<button role="button" name="taskID" value= "' . $taskID. '" style="
                padding: 10px; 
                margin: 5px; 
                height: 50px; 
                width: 750px;
                " >'. $value;
            if($key === 'status') $list .= $value?' : Выполнено':' : Не выполнено' . '</button>';
        }
    }
    echo $list;
}

function inputTasksIdTask(mixed $id)
{
    if (!isset($_SESSION['user'])) return false;

    $pdo = getPDO();

    $stmt = $pdo->prepare('SELECT * FROM `tasks` WHERE `id` = :id ;');
    $stmt->execute(['id' => $id]);

    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['send_task_user_id'] != $_SESSION['user']['id'] && $result['created_task_user_id'] != $_SESSION['user']['id']) {
        http_response_code(403);
        die('Forbidden');
    }

    return $result;
}
