<?php
 session_start();
   
// POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = (int) $_GET['id'];
    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

    foreach($users as &$user) {
        if ($user['user_id'] == $id) {
            if ($_POST['acc_balance'] > $user['acc_balance']) {
                $_SESSION['msg'] = ['type' => 'error', 'text' => 'There are not enough funds in the account'];
                header('Location: http://localhost:8080/ciupakabros/php_u2_hw/withdrawfunds.php?id='. $_GET['id']);
                die;
            } else {
                $user['acc_balance'] = $user['acc_balance'] - $_POST['acc_balance'];
                $_SESSION['msg'] = ['type' => 'ok', 'text' => 'Funds was withdrawed!'];
                $users = serialize($users);
                file_put_contents(__DIR__ . '/users.ser', $users); 
                header('Location: http://localhost:8080/ciupakabros/php_u2_hw/withdrawfunds.php?id='. $_GET['id'] );
                die;
            }
        }   
    }  
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
    <title>WITHDRAW FUNDS</title>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>
    <h3>WITHDRAW FUNDS:</h3>
    <form action="?id=<?= $user['user_id'] ?>" method="post">
        <fieldset>
            <div>Name: <?= $user['name'] ?></div>
            <div>Surname: <?= $user['surname'] ?></div>
            <div>Account balance: <?= number_format($user['acc_balance'], 2, ',', ' ') ?> Eur</div>
            <label>Add funds: </label>
            <input type="text" name="acc_balance" placeholder="euro">
            <button type="submit">Withdraw funds</button>
        </fieldset>
    </form>
</body>

</html>