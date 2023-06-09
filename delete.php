<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    die;
}

$id = (int) $_POST['user_id'];
$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

foreach($users as $user) {
    if ($user['user_id'] == $id) {
        if ($user['acc_balance'] > 0) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => "Can't delete user, account isn't empty!"];
        header('Location: http://localhost/ciupakabros/php_u2_hw/users.php');
        die;
    } else {
        $users = array_filter($users, fn($users) => $users['user_id'] != $id);
        $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was deleted!'];
        $users = serialize($users);
        file_put_contents(__DIR__ . '/users.ser', $users);
        header('Location: http://localhost/ciupakabros/php_u2_hw/users.php');
        die;
    }
}
}