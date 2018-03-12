<?php

class Controller
{
    protected $calendar_service;

    public function __call($method, $args)
    {
        print_r($method, $args);
    }
    public static function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
