<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add funds</title>
</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>

    <form action="?id=<?= $user['user_id'] ?>" method="post">
        <fieldset>
            <legend>ADD FUNDS:</legend>
            <label>Name: </label>
            <input type="text" name="name" value="<?= $user['name'] ?>">
            <label>Surname: </label>
            <input type="text" name="surname" value="<?= $user['surname'] ?>">
            <label>Account balance: </label>
            <input type="number" name="account_balance" value="<?= $user['account_balance'] ?>">
            <label>Deduct funds: </label>
            <input type="number" name="put_amount" value="<?= $user['put_amount'] ?>">
            <button type="submit">Deduct funs</button>
        </fieldset>

    </form>


</body>

</html>