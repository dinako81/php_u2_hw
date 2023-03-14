<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));

    $user = [
        'user_id' => $id,
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'personal_code' => $_POST['personal_code'],
        'account_number' => $_POST['account_number'],


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

    <form action="" method="post">
        <fieldset>
            <legend>ADD NEW ACCOUNT:</legend>
            <label>Name: </label>
            <input type="text" name="name">
            <label>Surname: </label>
            <input type="text" name="surname">
            <label>Personal code: </label>
            <input type="text" name="personal_code">
            <label>Account number: </label>
            <input type="text" name="account_number">
            <button type="submit" class="btn btn-success">ADD</button>
        </fieldset>

    </form>


</body>

</html>