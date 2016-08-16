<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require_once(__DIR__ . '/protected/helpers/ACL.php');

$router = new Router;
$router->runController();

class Router
{
    public function runController()
    {
        switch (explode('?', $_SERVER['REQUEST_URI'])[0]) {
            case '/':
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::getManyAds();
                break;

            // registration
            case '/register':
                include(__DIR__ . '/protected/views/users/form.php');
                break;
            case '/adduser':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::addUser();
                break;

            // login, logout
            case '/login':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::login();
                break;
            case '/authorize':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::authorize();
                break;
            case '/logout':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::logout();
                break;

            // user
            case '/cabinet':
                ACL::checkAccess('/cabinet');
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::getUserInfo();
                break;
            case '/cabinet/edit':
                ACL::checkAccess('/cabinet/edit');
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::editUserInfo();
                break;
            case '/cabinet/save':
                ACL::checkAccess('/cabinet/save');
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::updateUserInfo();
                break;
            case '/cabinet/ads':
                ACL::checkAccess('/cabinet/ads');
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::getOwnAds();
                break;

            // ads
            case '/ads':
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::getManyAds();
                break;
            case '/ads/next':
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::getNextAds();
                break;
            case '/ad':
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::getOneAd();
                break;
            case '/ad/create':
                ACL::checkAccess('/ad/create');
                include(__DIR__ . '/protected/views/ads/create_ad.php');
                break;
            case '/ad/save':
                ACL::checkAccess('/ad/save');
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::addAd();
                break;
            case '/ad/edit':
                ACL::checkAccess('/ad/edit');
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::editAd();
                break;
            case '/ad/update':
                ACL::checkAccess('/ad/update');
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::updateAd();
                break;
            case '/ad/delete':
                ACL::checkAccess('/ad/delete');
                include(__DIR__ . '/protected/controllers/AdController.php');
                AdController::deleteAd();
                break;
            default:
                include(__DIR__ . '/protected/views/404NotFound.php');
        }
    }
}