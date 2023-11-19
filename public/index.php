<?php
define("BASE_PATH", dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';


use Ryxo\Route;
use App\controllers\SiteController;
use App\controllers\AuthController;

$app = new Route();

$app->get('/', [SiteController::class, 'home']);
$app->get('/_login', [SiteController::class, 'login']);
$app->get('/_signup', [SiteController::class, 'signup']);
$app->get('/_logout', [SiteController::class, 'logout']);

$app->post('/', [AuthController::class, 'shortUrl']);
$app->post('/_login_process', [AuthController::class, 'login_process']);
$app->post('/_signup_process', [AuthController::class, 'signup_process']);
$app->get('/_profile', [AuthController::class, 'profile']);

$app->get('/{key}', [AuthController::class, 'processKey']);

$app->run();
