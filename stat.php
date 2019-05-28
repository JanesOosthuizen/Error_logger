<?php

$stat = stat('errors.txt');

echo '<span>Last Modified: '.date('Y-m-d H:i:s',$stat['mtime']).'</span>';