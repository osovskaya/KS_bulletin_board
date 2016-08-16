<?php

require_once(__DIR__ . '/../models/AdModel.php');
require_once(__DIR__ . '/../models/CategoryModel.php');


class AdController
{
    /*
     * CREATE, READ, UPDATE, DELETE
     */

    public static function getOneAd()
    {
        $ad = AdModel::getOneAd($_GET['id']);
        if (!$ad)
        {
            header('Location: /notfound');
            exit;
        }

        if (!file_exists(__DIR__ . '/../views/ads/one_ad.php'))
        {
            header('Location: /main');
            exit;
        }
        require_once(__DIR__ . '/../views/ads/one_ad.php');
    }

    public static function getManyAds()
    {
        if (!empty($_GET['category']))
        {
            $ads = AdModel::getManyAds($_GET['category']);
        }
        else
        {
            $ads = AdModel::getManyAds();
        }

        if (!$ads)
        {
            header('Location: /notfound');
            exit;
        }

        if (!file_exists(__DIR__ . '/../views/ads/many_ads.php'))
        {
            header('Location: /main');
            exit;
        }
        require_once(__DIR__ . '/../views/ads/many_ads.php');
    }

    public static function getOwnAds()
    {
        $ads = AdModel::getOwnAds($_SESSION['userid']);

        require_once(__DIR__ . '/../views/users/my_ads.php');
    }

    public static function getNextAds()
    {
        if(!file_exists(__DIR__ . '/../config.php'))
        {
            return false;
        }

        include(__DIR__ . '/../config.php');

        if (!empty($_GET['next']) || $_GET['next'] > 0)
        {
            $next = $_GET['next'];
        }
        else
        {
            $next = 0;
        }
        session_start();
        $_SESSION['page'] = $next;
        return AdModel::getManyAds($offset=$next * $config['pagination']);
    }

    /**
     * add ads to database
     */
    public static function addAd()
    {
        // add user to database
        $ad = AdModel::addAd();

        if (!$ad)
        {
            session_start();
            $_SESSION['message'] = 'Error occurred while saving ad. Please try again later.';
            exit;
        }

        header('Location: /ads');
    }

    /**
     * edit ad
     */
    public static function editAd()
    {
        $ad = AdModel::getOneAd($_POST['id']);
        $categories = CategoryModel::getManyCategories();
        if ($_SESSION['group'] != 'admin' && $_SESSION['userid'] != $ad['author'])
        {
            $_SESSION['message'] = 'You are not allowed to do this action';
            header('Location: /cabinet/ads');
            exit;
        }

        if (!$ad)
        {
            header('Location: /notfound');
            exit;
        }

        require_once(__DIR__ . '/../views/ads/edit_ad.php');
    }

    public static function updateAd()
    {
        $ad = AdModel::getOneAd($_POST['id']);
        if ($_SESSION['group'] != 'admin' && $_SESSION['userid'] != $ad['author'])
        {
            $_SESSION['message'] = 'You are not allowed to do this action';
            header('Location: /cabinet/ads');
            exit;
        }

        if (!AdModel::updateAd())
        {
            $_SESSION['message'] = 'Error occurred. Please try again later.';
            exit;
        }

        header('Location: /ads');
    }

    public static function deleteAd()
    {
        $ad = AdModel::getOneAd($_POST['id']);
        if ($_SESSION['group'] != 'admin' && $_SESSION['userid'] != $ad['author'])
        {
            $_SESSION['message'] = 'You are not allowed to do this action';
            header('Location: /cabinet/ads');
            exit;
        }

        if (!$ad)
        {
            //header('Location: /notfound');
        }

        AdModel::deleteAd();
        header('Location: /cabinet/ads');
    }
}
