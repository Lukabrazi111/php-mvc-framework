<?php

namespace app\core\controllers;

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