<?php

namespace App\Controllers;

class HomeController extends ViewController
{
    public function showHome()
    {
        $this->render('home/home');
    }
}
