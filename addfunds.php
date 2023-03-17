<?php
session_start();
// POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //validacija: negalima prideti raidziu
    
    $id = (int) $_GET['id'];
    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));
    
    foreach($users as &$user) {
        if ($user['user_id'] == $id) {
            $user['acc_balance'] = $user['acc_balance']+$_POST['acc_balance'];
            $users = serialize($users);
            file_put_contents(__DIR__ . '/users.ser', $users);
            break;
        }
    }
    $_SESSION['msg'] = ['type' => 'ok', 'text' => 'Funds was added!'];
    header('Location: http://localhost:8080/ciupakabros/php_u2_hw/addfunds.php?id='. $_GET['id']);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Add funds</title>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>


    <div class="container">
        <h3>ADD FUNDS:</h3>
        <form action="?id=<?= $user['user_id'] ?>" method="post">
            <div class="col-md-3">Name:<b> <?= $user['name'] ?></b></div>
            <div class="col-md-3">Surname: <b><?= $user['surname'] ?></b></div>
            <div class="col-md-3">Account balance: <b><?= number_format($user['acc_balance'], 2, ',', ' ') ?></b>Eur
            </div>
            <div class="col-md-3">
                <label>Add funds:</label>
                <input type="text" name="acc_balance" placeholder="euro">
            </div>
            <button type="submit" class="btn btn-secondary">Add funds</button>
        </form>
    </div>
</body>

</html>