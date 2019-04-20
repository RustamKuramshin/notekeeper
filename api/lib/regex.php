<?php

$routePattern = "user/{userID}/{orderID}";
$path = "user/123456";

preg_match_all('/\{(?<bracesParams>\w+)\}/', $routePattern,  $matches, PREG_PATTERN_ORDER);
foreach ($matches["bracesParams"] as $param){
    $repl[] = '(?<'.$param.'>\w+)';
}
$routePattern = str_replace($matches[0],$matches[1], $routePattern);
$replStr = str_replace($matches[1],$repl, preg_quote($routePattern,'/'));
$patt = '/'.$replStr.'/';

preg_match_all($patt, $path, $pathParams, PREG_PATTERN_ORDER);

$a = 0;