<html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="app/public/main.css" >
        </head>
        <body>
            <div class="container">
                <?php
                if(isset($_SESSION['user_id'])){
                    ?>
                    <a href="?c=users&m=logout">
                        <button type="button" class="submmitBtn">Izloguj se</button>
                    </a>
                    <?php
                }else{
                    ?>
                    <a href="?c=users&m=login">
                        <button type="button" class="submmitBtn">Uloguj se</button>
                    </a>
                    <?php
                }
                ?>
<?php
