<?php include_once(__DIR__ . '/../../controllers/AdController.php'); ?>

<!DOCTYPE HTML>

<html>
    <head>
        <title>Bulletin board</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="Bulletin board" />

        <link rel="stylesheet" href="/static/css/main.css" />
    </head>

    <body>
       <header>
            <h1>Bulletin board</h1>
            <nav>
                <a href="/">Main page</a> |
                <a href="/cabinet">My profile</a> |
                <a href="/ads">Ads</a> |
                <a href="/ad/create">New ad</a> |
                <a href="/login">Login</a> |
                <a href="/logout">Logout</a>
            </nav>
        </header>

        <p class="alert"><?php
            if(!empty($_SESSION['message']))
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </p>