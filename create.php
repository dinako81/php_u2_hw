<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = json_decode(file_get_contents(__DIR__ . '/id.json'));
    $id++;
    file_put_contents(__DIR__ . '/id.json', json_encode($id));

    $user = [
        'user_id' => $id,
        'place_in_row' => (int) $_POST['place_in_row'],
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
    <title>Create</title>
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
    </style>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>
    
    <form action="" method="post">
        <fieldset>
            <legend>ADD NEW ACCOUNT:</legend>
            <input type="text" name="personal_code">         
            <label>account number: </label>
            <label>name: </label>
            <input type="text" name="name">
            <label>surname: </label>
            <input type="text" name="surname">  
            <label>personal code: </label>            
            <input type="text" name="account_number">
            <button type="submit">ADD</button>
        </fieldset>

    </form>


</body>

</html>