<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //surasyti validacijas
    // if ($_POST['name']) maziau 3 raidziu nuderektinam i create


    // $personal_code = uniqid('my_prefix_', true);
// echo $personal_code;



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
            <input type="text" name="acc_number" class="form-control" placeholder="Account number">
            <!-- <?= $user['acc_number'] ?> -->
        </div>
        <div class="col-md-3 visually-hidden">
            <label>Account balance: </label>
            <input type="number" name="acc_balance" value="0">
        </div>
        <button type="submit" class="btn btn-success">ADD</button>
        </fieldset>

    </form>


</body>

</html>