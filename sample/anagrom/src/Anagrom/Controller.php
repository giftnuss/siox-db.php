<?php

namespace Anagrom;

class Controller
{
    protected $model;
    public $method;
    
    public function __construct($model)
    {
        $this->model = $model;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
	
    public function handleRequest()
    {
        $do = $_GET['s'] . "_" . $this->method;
        $do = str_replace('-','_',$do);
        if(method_exists($this,$do)) {
            $this->$do();
        }
    }
}
