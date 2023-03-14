<?php 
    $users_ = unserialize(file_get_contents(__DIR__ . '/users.ser'));
    $all = ceil(count($users_) / 20);
?>

<a href="http://localhost:8080/ciupakabros/php_u2_hw/users.php?page=home&sort=<?= $sort ?? '' ?>">HOME
</a>

<a href="http://localhost:8080/ciupakabros/php_u2_hw/create.php">Add New</a>