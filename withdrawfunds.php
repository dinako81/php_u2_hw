<?php
 session_start();
   
// POST scenarijus
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = (int) $_GET['id'];
    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

    foreach($users as &$user) {
        if ($user['user_id'] == $id) {
            if ($_POST['acc_balance'] > $user['acc_balance']) {
                $_SESSION['msg'] = ['type' => 'error', 'text' => 'There are not enough funds in the account!'];
                header('Location: http://localhost:8080/ciupakabros/php_u2_hw/withdrawfunds.php?id='. $_GET['id']);
                die;
                
            }
            // if (!is_numeric($_POST['acc_balance'] )) {
            //     $_SESSION['msg'] = ['type' => 'error', 'text' => 'The value should be only number!'];
            //     header('Location: http://localhost:8080/ciupakabros/php_u2_hw/withdrawfunds.php?id='. $_GET['id']);
            //     die;
            // }
            else {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>WITHDRAW FUNDS</title>
    <style>
    body {
        background-color: #cccccc;
    }

    h3,
    h6,
    h4,
    h5 {
        margin: 50px;
    }

    .container {
        margin-top: 50px;
    }
    </style>

</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>

    <div class="container">
        <h3 class="row">WITHDRAW FUNDS:</h3>
        <div class="row">
            <form action="?id=<?= $user['user_id'] ?>" method="post">
                <div class="col-md-3 form-label"><b>Name:</b> <?= $user['name'] ?> </div>
                <div class="col-md-3 form-label"><b>Surname:</b> <?= $user['surname'] ?></div>
                <div class="col-md-3 form-label"><b>Account balance: </b>
                    <?= number_format($user['acc_balance'], 2, ',', ' ') ?> Eur
                </div>
                <div class="col-md-3 form-label">
                    <label form-label><b>Withdraw funds:</b> </label>
                    <input type="text" name="acc_balance" placeholder="euro">
                </div>
                <button type="submit" class="btn btn-secondary">Withdraw funds</button>
            </form>
        </div>
</body>

</html>