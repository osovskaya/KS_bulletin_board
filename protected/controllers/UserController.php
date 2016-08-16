<?php

if (!file_exists(__DIR__ . '/../models/UserModel.php'))
{
    header('Location: /');
    exit;
}
// include model
require_once(__DIR__ . '/../models/UserModel.php');


class UserController
{
    /*
     * AUTHORIZATION
     */

    /**
     * user login
     */
    public static function login()
    {
        session_start();

        if(empty($_SESSION['userid']))
        {
            $_SESSION['message'] = 'Please login to enter your cabinet.';
        }
        else
        {
            $_SESSION['message'] = 'You have been already logged in';
        }

        require_once(__DIR__ . '/../views/login.php');
        exit;
    }

    /**
     * check login credentials
     */
    public static function authorize()
    {
        if(empty($_POST['email']) || empty($_POST['password']))
        {
            header('Location: /login');
            exit;
        }

        $user = UserModel::authorize();

        if (!$user)
        {
            session_start();
            $_SESSION['message'] = 'Incorrect login or password.';
            require_once(__DIR__ . '/../views/login.php');
            exit;
        }

        session_start();
        $_SESSION['userid'] = $user['id'];
        $_SESSION['group'] = $user['role'];
        header('Location: /cabinet');
    }

    /**
     * user logout
     */
    public static function logout()
    {
        session_start();
        unset($_SESSION['userid']);
        unset($_SESSION['group']);
        session_destroy();
        header('Location: /login');
    }

    /*
     * CREATE, READ, UPDATE, DELETE
     */

    /**
     * add user to database
     */
    public static function addUser()
    {
        // add user to database
        $user = UserModel::addUser();

        if (!$user)
        {
            session_start();
            $_SESSION['message'] = 'Error occurred while saving user. Please try again later.';
            exit;
        }

        header('Location: /login');
    }

    /**
     * show user info
     */
    public static function getUserInfo()
    {
        $user = UserModel::getUserInfo($_SESSION['userid']);

        if (!$user)
        {
            header('Location: /notfound');
            exit;
        }

        if (!file_exists(__DIR__ . '/../views/users/cabinet.php'))
        {
            header('Location: /form');
            exit;
        }
        require_once(__DIR__ . '/../views/users/cabinet.php');
    }

    /**
     * edit user info
     */
    public static function editUserInfo()
    {
        $user = UserModel::getUserInfo($_SESSION['userid']);

        if (!$user)
        {
            header('Location: /notfound');
        }

        if (!file_exists(__DIR__ . '/../views/users/cabinet.php'))
        {
            header('Location: /form');
            exit;
        }
        require_once(__DIR__ . '/../views/users/edituser.php');
    }

    public static function updateUserInfo()
    {
       if (!UserModel::updateUserInfo())
        {
            session_start();
            $_SESSION['message'] = 'Error occurred while updating user. Please try again later.';
            header('Location: /cabinet/edit');
            exit;
        }

        header('Location: /cabinet');
    }
}
