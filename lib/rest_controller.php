<?php

class Request
{
    public $method;
    public $path;
    public $query;
    public $body;
    public $headers;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_REQUEST ? $_REQUEST['q'] : '';
        $this->query = array_filter($_REQUEST, function ($k) {
            return $k != 'q';
        }, ARRAY_FILTER_USE_KEY);
        $this->headers = getallheaders();
        $this->body = file_get_contents('php://input');
    }
}

class Response
{
    public $code = 200;
    public $headers;
    public $body;

    public function send()
    {
        if ($this->headers) {
            foreach ($this->headers as $k => $v) {
                header("$k: $v");
            }
        }

        http_response_code($this->code);
        echo $this->body;

    }
}

class Router
{
    private $req;
    private $res;

    public function __construct()
    {
        $this->req = new Request();
        $this->res = new Response();
    }

    function __call($name, $arguments)
    {
        list($route, $action) = $arguments;

        $this->{strtolower($name)}[$this->formatRoute($route)] = $action;
    }

    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        $result = ltrim($result, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private function resolve()
    {

        $action_map = $this->{strtolower($this->req->method)};

        $formatedRoute = $this->formatRoute($this->req->path);

        $action = $action_map[$formatedRoute];

        if ($action) {
            if ($action) call_user_func_array($action, array($this->req, $this->res));
        }

    }

    function __destruct()
    {
        $this->resolve();
    }

}