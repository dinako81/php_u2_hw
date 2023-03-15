<?php

function getUnique($to)
{
    static $ids = [];
    do {
        $id = rand(1, $to);
    } while(in_array($id, $ids));
    $ids[] = $id;
    return $id;
}

// $users = array_map(fn($_)=>['user_id' => getUnique(20)], range (1, 5));

usort($users, fn($a, $b) => $a['user_id'] <=> $b['user_id']);

echo '<pre>';
print_r($users);

// $personal_code = uniqid('my_prefix_', true);
// echo $personal_code;