<style>
h3,
form {
    display: inline-block;
    margin-left: 20px;
}

button {
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
}
</style>
<?php
defined('ENTER') || die('no entry here');
?>
<h2 style="color:darkgreen;">MENU</h2>
<a href="http://localhost:8080/ciupakabros/php_u2_hw/">HOME</a>
<a href="http://localhost:8080/ciupakabros/php_u2_hw/users/">Account list</a>

<?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) : ?>
<h3><?= $_SESSION['name'] ?></h3>
<form action="http://localhost:8080/ciupakabros/php_u2_hw/login/?logout" method="post">
    <button type="submit">LOG OUT</button>
</form>
<?php else : ?>
<a href="http://localhost:8080/ciupakabros/php_u2_hw/login/">LOGIN</a>
<?php endif ?>