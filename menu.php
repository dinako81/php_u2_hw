<?php 
   
    $users_ = unserialize(file_get_contents(__DIR__ . '/users.ser'));
    $all = ceil(count($users_) / 20);
?>

<a href="http://localhost:8080/ciupakabros/php_u2_hw/users.php?page=home&sort=<?= $sort ?? '' ?>">HOME
</a>

<a href="http://localhost:8080/ciupakabros/php_u2_hw/create.php">Add New</a>

<?php

    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
        $color = match($msg['type']) {
            'error' => 'crimson',
            'ok' => 'skyblue',
            default => 'gray'
        };
    }
?>

<?php if(isset($msg)) : ?>
<h2 style="color: <?= $color ?>">
    <?= $msg['text'] ?>
</h2>
<?php endif ?>

<?php

unset($_SESSION['msg']);