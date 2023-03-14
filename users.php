<?php
$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

// echo '<pre>';

// var_dump($users);

$page = (int) ($_GET['page'] ?? 1);

$sort = $_GET['sort'] ?? '';

if ($sort == 'surname_asc') {
    usort($users, fn($a, $b) => $a['surname'] <=> $b['surname']);
}
elseif ($sort == 'surname_desc') {
    usort($users, fn($a, $b) => $b['surname'] <=> $a['surname']);
}
// elseif ($sort == 'id_asc') {
//     usort($users, fn($a, $b) => $a['user_id'] <=> $b['user_id']);
// }
// elseif ($sort == 'id_desc') {
//     usort($users, fn($a, $b) => $b['user_id'] <=> $a['user_id']);
// }

// $users = array_slice($users, ($page - 1) * 10, 10);


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
            <div class="d-flex justify-content-end">
                <legend></legend>
                <select name="sort">
                    <option value="surname_asc" <?php if ($sort == 'surname_asc') echo 'selected' ?>>Surname A-Z
                    </option>
                    <option value="surname_desc" <?php if ($sort == 'surname_desc') echo 'selected' ?>>Surname Z-A
                    </option>
                </select>
                <button type="submit">sort</button>
            </div>
        </fieldset>
    </form>


    <h3>ACCOUNTS LIST</h3>
    <?php foreach($users as $user): ?>

    <table class="table ">
        <thead>
            <tr>
                <th scope="col"><b>ID</b></th>
                <th scope="col"><b>Name</b></th>
                <th scope="col"><b>Surname</b></th>
                <th scope="col"><b>Personal code</b></th>
                <th scope="col"><b>Account balance</b></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td><?= $user['user_id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['surname'] ?></td>
                <td><?= $user['personal_code'] ?></td>
                <td><?= $user['acc_balance'] ?> Eur</td>
                <td>
                    <form action="http://localhost:8080/ciupakabros/php_u2_hw/delete.php?id=<?= $user['user_id'] ?>"
                        method="post">
                        <button type="submit" class="btn btn-outline-danger">delete</button>
                </td>
                <td><a href="http://localhost:8080/ciupakabros/php_u2_hw/addfunds.php?id=<?= $user['user_id'] ?>"
                        class="btn btn-primary d-inline">Add funds</a></td>
                <td> <a href="http://localhost:8080/ciupakabros/php_u2_hw/withdrawfunds.php?id=<?= $user['user_id'] ?>"
                        class="btn btn-primary d-inline">Withdraw funds</a> </td>
            </tr>
        </tbody>
    </table>



    <?php endforeach ?>



</body>

</html>