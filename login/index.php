<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1 LOGOUT
    if (isset($_GET['logout'])) {
        unset($_SESSION['logged'], $_SESSION['log_name']);
        header('Location: http://localhost:8080/ciupakabros/php_u2_hw/login/');
        die;
    }
    
    // 2 LOGIN
    $users = json_decode(file_get_contents(__DIR__ . '/../db/users.json'), 1);
    foreach($users as $user) {
        if ($user['log_name'] == $_POST['log_name'] && $user['psw'] == md5($_POST['psw'])) {
            $_SESSION['logged'] = 1;
            $_SESSION['log_name'] = $user['log_name'];
            header('Location: http://localhost:8080/ciupakabros/php_u2_hw/users.php');
            die;
        }
    }
    $_SESSION['msg'] = ['type' => 'error', 'text' => 'Login failed'];
    header('Location: http://localhost:8080/ciupakabros/php_u2_hw/login/');
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
    <title>Bank Login</title>
    <style>
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

    h1 {
        margin: 50px;
    }
    </style>
</head>

<body>
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
    <h2 style="color: <?= $color ?>">
        <?= $msg['text'] ?>
    </h2>
    <?php endif ?>

    <h1>Login</h1>
    <form action="" method="post">
        <div>
            <label>Name:</label>
            <input type="text" name="log_name">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="psw">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>

</html>