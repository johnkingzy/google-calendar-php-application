<?php

class Home extends Controller
{
    public function __construct()
    {

    }
    public static function index()
    {
        $data = ['title' => 'Mini PHP Framework'];
        return parent::view('home/index', $data);
    }
    public static function test()
    {
        echo 'test';
    }
}
