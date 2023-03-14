<?php
$id = (int) $_GET['id'];
    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));
  
// POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // session_start();

    $id = (int) $_GET['id'];
    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

    // tikrinam
    // foreach($users as &$user) {
    //     if ($user['place_in_row'] == (int) $_POST['place_in_row']) {
    //         $_SESSION['msg'] = ['type' => 'error', 'text' => 'Row is invalid'];
    //         header('Location: http://localhost/ciupakabros/php_u2_hw/edit.php?id='.$id);
    //         die;
    //     }
    // }


    foreach($users as &$user) {
        if ($user['user_id'] == $id) {
            $user['acc_balance'] =$user['acc_balance'] - $_POST['acc_balance'];

            $users = serialize($users);
            file_put_contents(__DIR__ . '/users.ser', $users);

            break;
        }
    }

    // $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was edited'];
    header('Location: http://localhost:8080/ciupakabros/php_u2_hw/users.php');
    die;
}

//GET scenarijus

$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

$id = (int) $_GET['id'];

$find = false;
foreach($users as $user) {
    if ($user['user_id'] == $id) {
        $find = true;
        break;
    }
}

if (!$find) {
    die('User not found');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw funds</title>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>

    <form action="?id=<?= $user['user_id'] ?>" method="post">
        <fieldset>
            <legend>WITHDRAW FUNDS:</legend>
            <div>Name: <?= $user['name'] ?></div>
            <div>Surname: <?= $user['surname'] ?></div>
            <div>Account balance: <?= $user['acc_balance'] ?></div>


            <label>Add funds: </label>
            <input type="text" name="acc_balance">
            <button type="submit">Withdraw funds</button>
        </fieldset>

    </form>


</body>

</html>