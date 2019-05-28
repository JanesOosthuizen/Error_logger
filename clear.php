<?php
$file = 'logs/'.md5($_POST['user'].''.$_POST['key']).'.txt';
$items = '';
$newContent = json_encode($items);
// Write the contents back to the file
file_put_contents($file, $newContent);