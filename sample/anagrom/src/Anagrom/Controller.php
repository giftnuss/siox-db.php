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
	
	
}
