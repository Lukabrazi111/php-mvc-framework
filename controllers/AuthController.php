<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login() {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request) {
        $this->setLayout('auth');

        $registerModel = new RegisterModel();

        if($request->isPost()) {
            var_dump($registerModel->loadData($request->getBody()));
        }

        return $this->render('register');
    }
}