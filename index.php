<?php

function getUnique($to){
    static $ids = [];
 do {
    $id= rand(1, $to);
 }while(in_array($id, $ids));
 $ids[]=$id;
 return $id;
}

$users = array_map(fn($_)=>['user_id' => getUnique(20)], range (1, 5));

echo '<pre>';
print_r($users);


usort($users, fn($a, $b) => $a['user_id'] <=> $b['user_id']);

echo '<pre>';
print_r($users);
echo '<br>';


function randString()
{
    $letters = range('a', 'z');
    $out = '';
    foreach(range(1, rand(5, 15)) as $_) {
        $out .= $letters[rand(0, count($letters) - 1 )];
    }
    return $out;
}

$users = array_map(function($user) {
    $user['name'] = randString();
    $user['surname'] = randString();
    $user['personal_code'] = randString();
    $user['acc_number'] = randString();
    $user['acc_balance'] = 0;
    return $user;
}, $users);


file_put_contents(__DIR__ . '/users.ser', serialize($users));

echo '<pre>';
print_r($users);


// $personal_code = uniqid('my_prefix_', true);
// echo $personal_code;