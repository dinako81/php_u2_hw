<?php
$users = unserialize(file_get_contents(__DIR__ . '/users.ser'));

$page = (int) ($_GET['page'] ?? 1);

$sort = $_GET['sort'] ?? '';

if ($sort == 'name_asc') {
    usort($users, fn($a, $b) => $a['name'] <=> $b['name']);
}
elseif ($sort == 'name_desc') {
    usort($users, fn($a, $b) => $b['name'] <=> $a['name']);
}
elseif ($sort == 'id_asc') {
    usort($users, fn($a, $b) => $a['user_id'] <=> $b['user_id']);
}
elseif ($sort == 'id_desc') {
    usort($users, fn($a, $b) => $b['user_id'] <=> $a['user_id']);
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
</head>
<body>
    <ul>

    <?php foreach($users as $user): ?>
        <li>
        <b>ID:</b> <?= $user['user_id'] ?> <i><?= $user['name'] ?> <?= $user['surname'] ?></i>
        </li>
    <?php endforeach ?>
    </ul>
    <form action="" method="get">
        <fieldset>
            <legend>SORT:</legend>
            <select name="sort">
                <option value="name_asc" <?php if ($sort == 'name_asc') echo 'selected' ?>>Name A-Z</option>
                <option value="name_desc" <?php if ($sort == 'name_desc') echo 'selected' ?>>Name Z-A</option>
                <option value="id_asc" <?php if ($sort == 'id_asc') echo 'selected' ?>>ID 1-9</option>
                <option value="id_desc" <?php if ($sort == 'id_desc') echo 'selected' ?>>ID 9-1</option>
            </select>
            <button type="submit">sort</button>
        </fieldset>

    </form>

</body>
</html>