<?php

function getUnique($to){
    static $ids = [];
 do {
    $id= rand(1, $to);
 }while(in_array($id, $ids));
 $ids[]=$id;
 return $id;
}

$users = array_map(fn($_)=>['user_id' => getUnique(30), 'place_in_row' => rand(1,100)], range (1, 30));

echo '<pre>';
print_r($users);


usort($users, fn($a, $b) => $a['user_id'] <=> $b['user_id']);

echo '<pre>';
print_r($users);
echo '<br>';

usort($users, fn($a, $b) => $b['place_in_row'] <=> $a['place_in_row']);


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
    return $user;
}, $users);

file_put_contents(__DIR__ . '/users.ser', serialize($users));

echo '<pre>';
print_r($users);

$users = array_map(function($user) {
    $user['amount'] = randString('');
    return $user;
}, $users);

file_put_contents(__DIR__ . '/users.ser', serialize($users));

echo '<pre>';
print_r($users);


$users = array_map(function($user) {
    $user['personal_code'] = randString('');
    return $user;
}, $users);

file_put_contents(__DIR__ . '/users.ser', serialize($users));

echo '<pre>';
print_r($users);

$users = array_map(function($user) {
    $user['account_number'] = randString('');
    return $user;
}, $users);

file_put_contents(__DIR__ . '/users.ser', serialize($users));

echo '<pre>';
print_r($users);

$users = array_map(function($user) {
    $user['initial_amount'] = 0;
    return $user;
}, $users);

file_put_contents(__DIR__ . '/users.ser', serialize($users));

echo '<pre>';
print_r($users);


// $personal_code = uniqid('my_prefix_', true);
// echo $personal_code;