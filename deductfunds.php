<?php

$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Deduct funds</title>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>

    <form action="?id=<?= $user['user_id'] ?>" method="post">
        <fieldset>
            <legend>DEDUCT FUNDS:</legend>
            <div class="col-3">
                <label>Name: </label>
                <input type="text" name="name" value="<?= $user['name'] ?>">
            </div>
            <div class="col-3">
                <label>Surname: </label>
                <input type="text" name="surname" value="<?= $user['surname'] ?>">
            </div>
            <div class="col-3">
                <label>Account balance: </label>
                <input type="number" name="account_balance" value="<?= $user['acc_balance'] ?>">
            </div>
            <div class="col-3">
                <label>Deduct funds: </label>
                <input type="number" name="put_amount" value="<?= $user['put_amount'] ?>">
            </div>
            <button type="submit" class="btn btn-success">Deduct funds</button>
        </fieldset>

    </form>


</body>

</html>