<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return $this->render('index', ['name' => 'Luka']);
    }

    public function contact()
    {
        return $this->render('contact');
    }
}