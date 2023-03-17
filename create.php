<?php
 session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

     foreach($users as $user) {
        if ($_POST['ak'] ?? ''){
            if ($user['personal_code'] == $_POST['personal_code']) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Personal code is not unique'];
            header('Location: http://localhost:8080/ciupakabros/php_u2_hw/create.php');
            die;}
        }
        if (strlen($_POST['name']) < 3 || strlen($_POST['surname']) < 3) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Name or surname is too short'];
            header('Location: http://localhost:8080/ciupakabros/php_u2_hw/create.php');
            die;
        }
    }
   
    //reikia papildyti, kad gavus pranesima ape klaida grazintu i pildoma forma su jau ivesta info. paimam informacija is sesijos ir perkialiame i laukelius
    
    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));

    $user = [
        'user_id' => $id,
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'personal_code' => $_POST['personal_code'],
        'acc_number' => $_POST['acc_number'],
        'acc_balance' => $_POST['acc_balance'],
    ];

    $users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

    $users[] = $user;

    $users = serialize($users);
    file_put_contents(__DIR__ . '/users.ser', $users);

    $_SESSION['msg'] = ['type' => 'ok', 'text' => 'User was created'];
    header('Location: http://localhost:8080/ciupakabros/php_u2_hw/users.php?sort=id_desc');
    die;
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
    <title>Create</title>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>

    <div class="container">
        <h3>ADD NEW ACCOUNT:</h3>
        <form action="" method="post">
            <div class="col-md-3">
                <label class="form-label">Name: </label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-3">
                <label class="form-label">Surname: </label>
                <input type="text" name="surname" class="form-control" placeholder="Surname">
            </div>
            <div class="col-md-3">
                <label class="form-label">Personal code: </label>
                <input type="text" name="personal_code" class="form-control" placeholder="Personal code">
            </div>
            <div class="col-md-3">
                <label class="form-label">Account number: </label>
                <input readonly type="text" name="acc_number" class="form-control" placeholder="Account number"
                    value="<?= 'LT' . rand(0, 9) . rand(0, 9) . ' ' . '0014' . ' ' . '7' . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9)  . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) ?>">
            </div>
            <div class=" col-md-3 visually-hidden">
                <label>Account balance: </label>
                <input type="number" name="acc_balance" value="0">
            </div>
            <button type="submit" class="btn btn-success">ADD</button>
        </form>
    </div>
</body>

</html>