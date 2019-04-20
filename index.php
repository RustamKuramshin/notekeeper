<?php

$uri = 'http://' . $_SERVER['HTTP_HOST'] . '/notekeeper/www/index.html';
header('Location: ' . $uri);
exit;