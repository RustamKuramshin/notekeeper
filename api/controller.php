<?php

require_once "./lib/router.php";

$router = new Router();

$router->get('notes', function ($req, $res) {
    $noteID = $req->query['id'];
    $res->headers = array('Content-Type' => 'application/json');
    $res->body = json_encode(array('$noteID' => $noteID));
    $res->send();
});