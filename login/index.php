<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1 LOGOUT
    if (isset($_GET['logout'])) {
        unset($_SESSION['logged'], $_SESSION['log_name']);
        header('Location: http://localhost/ciupakabros/php_u2_hw/login/');
        die;
    }
    
    // 2 LOGIN
    $users = json_decode(file_get_contents(__DIR__ . '/../db/users.json'), 1);
    foreach($users as $user) {
        if ($user['log_name'] == $_POST['log_name'] && $user['psw'] == md5($_POST['psw'])) {
            $_SESSION['logged'] = 1;
            $_SESSION['log_name'] = $user['log_name'];
            header('Location: http://localhost/ciupakabros/php_u2_hw/users.php');
            die;
        }
    }
    $_SESSION['msg'] = ['type' => 'error', 'text' => 'Login failed!'];
    header('Location: http://localhost/ciupakabros/php_u2_hw/login/');
    die;
}

// 3 SHOW LOGIN FORM

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <title>Bank Login</title>
    <style>
    body {
        background-color: #cccccc;
    }

    form {
        margin: 50px;
        padding: 20px;
        border: 1px solid black;
        width: 300px;
    }

    label {
        width: 100px;
        display: inline-block;
    }

    div {
        margin-bottom: 10px;
    }

    h3,
    h6,
    h4,
    h5 {
        margin: 50px;
    }

    img {
        width: 300px;

        float: right;
    }
    </style>
</head>

<body>

    <h3>Welcome, </br> let's play the Zebra bank!</h3>

    <?php
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
        $color = match($msg['type']) {
            'error' => 'crimson',
            'ok' => 'skyblue',
            default => 'gray'
        };
    }
    ?>
    <?php if(isset($msg)) : ?>
    <h5 style="color: <?= $color ?>">
        <i><?= $msg['text'] ?></i>
    </h5>
    <?php endif ?>

    <h4>Try to Login!</h4>

    <img src="./img/zebra-bank.jpg" alt="Zebras">

    <div>
        <form action="" method="post">
            <div>
                <label>Name:</label>
                <input type="text" name="log_name">
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="psw">
            </div>
            <button class="btn btn-secondary" type="submit">Login</button>
        </form>
    </div>

    <h6> Please note that if you want a consultation in the branch, you have to register.
        </br>
        Keep your ID tools secure: learn more <a href="#">here. </a></h6>
</body>

</html>