<?php 
   
    $users_ = unserialize(file_get_contents(__DIR__ . '/users.ser'));
    $all = ceil(count($users_) / 20);
?>



<?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) : ?>


<div style="float: right; margin-top: 20px; margin-right: 20px">
    <form action="http://localhost:8080/ciupakabros/php_u2_hw/login/?logout" method="post">
        <button type="submit" class="btn btn-dark" class="btn btn-secondary">Log
            out</button>
    </form>
</div>


<?php else : ?>
<a href="http://localhost:8080/ciupakabros/php_u2_hw/login/" class="btn
    btn-secondary">Login</a>
<?php endif ?>

<h3 style="margin-top: 10px; margin-left: 20px">Hi <?= $_SESSION['log_name'] ?>!</h3>

<a style="margin-top: 20px; margin-left: 20px"
    href="http://localhost:8080/ciupakabros/php_u2_hw/users.php?page=home&sort=<?= $sort ?? '' ?>"
    class="btn btn-secondary">Home</a>
<a style="margin-top: 20px" href="http://localhost:8080/ciupakabros/php_u2_hw/create.php" class="btn btn-success">Add
    new account</a>



<?php

    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
        $color = match($msg['type']) {
            'error' => 'crimson',
            'ok' => 'green',
            default => 'gray'
        };
    }
?>

<?php if(isset($msg)) : ?>
<h5 style="color: <?= $color ?>">
    <i> <?= $msg['text'] ?> </i>
</h5>
<?php endif ?>

<?php

unset($_SESSION['msg']);

?>