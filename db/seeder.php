<?php
$users = [
    ['log_name' => 'zebra@gmail.com', 'psw' => md5('123')],
    ['log_name' => 'avite@gmail.com', 'psw' => md5('123')],
];

file_put_contents(__DIR__ .'/users.json', json_encode($users));

echo 'All is OK';