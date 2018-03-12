<?php

class Controller
{

    public static function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
