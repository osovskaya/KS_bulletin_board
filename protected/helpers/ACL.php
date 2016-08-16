<?php

class ACL
{
    private static $freeRoutes = ['/', '/register', '/adduser', '/login',
        '/logout', '/authorize', '/ads', '/ad'];

    public static function checkAccess($route)
    {
        session_start();
        if(empty($_SESSION['userid']))
        {
            if (!array_search($route, self::$freeRoutes))
            {
                // access denied
                header('Location: /login');
                exit;
            }
        }
        return true;
    }
}
