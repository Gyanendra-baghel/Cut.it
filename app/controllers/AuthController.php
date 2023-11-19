<?php

namespace App\controllers;

use Ryxo\Controller;

class AuthController extends Controller
{
    private \PDO $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = new \PDO("mysql:host=localhost;dbname=cut_it", "root", "");
        session_start();
    }
    public function profile($req)
    {
        if (isset($_SESSION['isLogin'], $_SESSION['username'])) {
            $username = $_SESSION['username'];
            $email = $_SESSION['email'] ?? "gyanendrabaghel633@gmail.com";
            $result = $this->conn->query("SELECT * FROM urls WHERE user_id = '{$username}'", \PDO::FETCH_ASSOC);

            $this->render("profile", ["email" => $email, "username" => $username, "isLogin" => true, "result" => $result]);
        } else {
            $req->redirect("/");
        }
    }
    public function signup_process($req)
    {
        if (isset($req->body['username'], $req->body['email'], $req->body['password'])) {
            $username = $req->body['username'];
            $email = $req->body['email'];
            $password = $req->body['password'];
            $query1 = $this->conn->query("SELECT * FROM users WHERE username='$username'");
            if ($query1->rowCount() === 0) {
                $query = $this->conn->query("INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')");
                if ($query->rowCount() == 1) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['username'] = $username;
                    $req->redirect("/_profile");
                }
            } else {
                $_SESSION["error"] = "Username is already taken.";
            }
        }
        $req->redirect("/_signup");
    }
    public function login_process($req)
    {
        if (isset($req->body['username'], $req->body['password'])) {
            $username = $req->body['username'];
            $password = $req->body['password'];
            $query = $this->conn->query("SELECT * FROM users WHERE username = '$username' AND password='$password'");
            if ($query->rowCount() == 1) {
                $_SESSION['isLogin'] = true;
                $_SESSION['username'] = $username;
                $req->redirect("/_profile");
            } else {
                $_SESSION["error"] = "Credential is wrong either username or password.";
            }
        }
        $req->redirect("/_login");
    }
    public function shortUrl($req)
    {
        var_dump($_SESSION['username'], $req->body['originalUrl'], $req->body['shortUrl']);
        if (isset($_SESSION['username'], $req->body['originalUrl'], $req->body['shortUrl'])) {
            $originalUrl = $req->body['originalUrl'];
            $shortUrl = $req->body['shortUrl'];
            $username = $_SESSION['username'];

            $query1 = $this->conn->query("SELECT * FROM urls WHERE shortUrl='$shortUrl'");
            if ($query1->rowCount() === 0) {
                $query2 = $this->conn->query("INSERT INTO urls (user_id, fullurl, shortUrl) VALUES ('$username','$originalUrl','$shortUrl')");
                if ($query2->rowCount() == 1) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['username'] = $username;
                    $req->redirect("/_profile");
                }
            } else {
                $_SESSION['error'] = "This path ($shortUrl) is already in used.";
            }
            $req->redirect("/");
        }
    }
    public function processKey($req, $res, $matches)
    {
        $key = $matches['key'];
        $query = $this->conn->query("SELECT fullurl FROM urls WHERE shorturl='$key'");
        if ($query->rowCount() == 1) {
            $fullurl = $query->fetch(\PDO::FETCH_ASSOC)['fullurl'];
            $this->conn->exec("UPDATE urls SET clicks=clicks+1 WHERE shorturl='$key'");
            $req->redirect($fullurl);
        } else {
            $res->render404();
        }
    }
}
