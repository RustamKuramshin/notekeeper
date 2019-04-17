<?php
require_once "./lib/rest_controller.php";

$router = new Router();

$router->get('/', function ($req, $res) {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'].'/notekeeper';
    header('Location: '.$uri.'/www/');
    exit;
});

$router->get('notes', function ($req, $res) {
    $noteID = $req->query['id'];
    $res->headers = array('Content-Type' => 'application/json');
    $res->body = json_encode(array('$noteID' => $noteID));
    $res->send();
});
