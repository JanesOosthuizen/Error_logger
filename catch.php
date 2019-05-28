<?php

$data = $_POST;
$file = 'logs/'.md5($_POST['user'].''.$_POST['key']).'.txt';
// Open the file to get existing content
$current = file_get_contents($file);
$items = json_decode($current);
$newData = htmlspecialchars(json_decode($data['data']));
$item = array(
    'date' => date('Y-m-d H:i:s'),
    'content' => print_r($newData,true),
    'type' => $data['type']
);
// Append a new person to the file
$items[] = $item;
$newContent = json_encode($items);
// Write the contents back to the file
file_put_contents($file, $newContent);