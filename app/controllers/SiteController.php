<?php

namespace App\controllers;

use Ryxo\Controller;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function home()
    {
        $this->render("home", ['isLogin' => $_SESSION['isLogin'] ?? false]);
    }
    public function login()
    {
        $this->render("login", ['isLogin' => false]);
    }
    public function signup()
    {
        $this->render("signup", ['isLogin' => false]);
    }

    public function profile()
    {
        $this->render("profile", ['isLogin' => false]);
    }
    public function logout($req)
    {
        session_unset();
        session_destroy();
        $req->redirect("/");
    }
}
