<?php
$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

$page = (int) ($_GET['page'] ?? 1);

$sort = $_GET['sort'] ?? '';

if ($sort == 'surname_asc') {
    usort($users, fn($a, $b) => $a['surname'] <=> $b['surname']);
}
elseif ($sort == 'surname_desc') {
    usort($users, fn($a, $b) => $b['name'] <=> $a['surname']);
}

$users = array_slice($users, ($page - 1) * 10, 10);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <style>
    li {
        margin: 50px;
        padding: 20px;
        border: 1px solid black;
        width: 500px;
    }
    label {
        width: 100px;
        display: inline;
    }
    div {
        margin-bottom: 10px;
    }
    a {
        margin: 5px;
        padding: 5px;
        border: 1px solid black;
        width: 30px;
        font: 10px;
        background-color: white;
    }
    </style>
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
            <button type="submit">sort</button>
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
            <form action="http://localhost:8080/ciupakabros/php_u2_hw/delete.php?id=<?= $user['user_id'] ?>" method="post">
            <button type="submit">delete</button>
            <a href="http://localhost:8080/ciupakabros/php_u2_hw/addfunds.php">Add funds</a>
            <a href="http://localhost:8080/ciupakabros/php_u2_hw/deductfunds.php">Deduct funds</a>        
            </form>
        </li>
    <?php endforeach ?>
</ul>
</body>
</html>