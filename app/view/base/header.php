<html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="app/public/main.css" >
        </head>
        <body>
        <div class="navbar">
            <a href="/<?php echo APPNAME ?>"><div class="appLogo">  <span>PHP application</span>  </div></a>
            <div class="buttons">
                <?php
                if(isset($_SESSION['user_id'])){
                    ?>
                    <a href="?c=auth&m=logout">
                        <button type="button" class="submmitBtn">Izloguj se</button>
                    </a>
                    <?php
                }else{
                    ?>
                    <a href="?c=auth&m=login">
                        <button type="button" class="submmitBtn">Uloguj se</button>
                    </a>
                    <?php
                }
                ?>
            </div>

        </div>
            <div class="container">
                <?php include "app/view/base/errors.php"?>

<?php
