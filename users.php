<?php
$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

$page = (int) ($_GET['page'] ?? 1);

$sort = $_GET['sort'] ?? '';

if ($sort == 'surname_asc') {
    usort($users, fn($a, $b) => $a['surname'] <=> $b['surname']);
}
elseif ($sort == 'surname_desc') {
    usort($users, fn($a, $b) => $b['surname'] <=> $a['surname']);
}

$users = array_slice($users, ($page - 1) * 10, 10);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>users</title>

</head>

<body>
    <?php require __DIR__ . '/menu.php' ?>
    <form action="" method="get">
        <fieldset>
            <legend>SORT:</legend>
            <select name="sort">
                <option value="surname_asc" <?php if ($sort == 'surname_asc') echo 'selected' ?>>Surname A-Z</option>
                <option value="surname_desc" <?php if ($sort == 'surname_desc') echo 'selected' ?>>Surname Z-A</option>
            </select>
            <button type="submit" class="btn btn-secondary" disabled>sort</button>
        </fieldset>
    </form>
    <ul>


        <?php foreach($users as $user): ?>


        <li>
            <b>ID:</b>
            <?= $user['user_id'] ?>
            <div>
                <b>Personal code:</b>
                <i><?= $user['personal_code'] ?> </i>
            </div>
            <div>
                <b>Name:</b>
                <i><?= $user['name'] ?> </i>
            </div>
            <div>
                <b>Surname:</b>
                <?= $user['surname'] ?>
            </div>
            <div>
                <b>Amount:</b>
                <?= $user['amount'] ?>
            </div>
            <form action="http://localhost:8080/ciupakabros/php_u2_hw/delete.php?id=<?= $user['user_id'] ?>"
                method="post">
                <button type="submit" class="btn btn-outline-danger">delete</button>
                <a href="http://localhost:8080/ciupakabros/php_u2_hw/addfunds.php" class="btn btn-primary">Add funds</a>
                <a href="http://localhost:8080/ciupakabros/php_u2_hw/deductfunds.php" class="btn btn-primary">Deduct
                    funds</a>
            </form>
        </li>
        <?php endforeach ?>
    </ul>
</body>

</html>