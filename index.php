<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <title>Musikverein Lotto</title>
        <script src="/js/vendor/jquery-1.10.2.min.js"></script>
        <script src="/js/application.js"></script>
    </head>
    <body lang="de">

        <div id="header">
            <img src="/images/logos/logo.png" id="logo">
            <div id="breadcrumb"><?php echo getBreadCrumbs(); ?></div>
            <div id="account" data-tip="Hier kannst du dein Profil bearbeiten oder dich ausloggen."><a href="#">zakaria.agoulif@gmail.com</a> | <a href="#">Logout</a></div> 
        </div>
        <div id="content">
            <a href="#"><div class="alert blue">Hinweis. Spiel "Lotto und Biergarten" läuft!</div></a>
            <div id="debugg"></div>
            <?php
            include_once './config/config.php';
            include_once './controller/Controller.php';
            include_once './view/View.php';

            switch (getUriFirst()) {
                case URI_EVENT:
                    include_once './controller/EventController.php';
                    $controller = new EventController();
                    break;
                case URI_WINNER:
                    include_once './controller/WinnerController.php';
                    $controller = new WinnerController();
                    break;
                case URI_HOME:
                default :
                    include_once './controller/HomeController.php';
                    $controller = new HomeController();
                    break;
            }

            $controller->route();
            ?>
        </div>
    </body>
</html>

<?php

/**
 * @return string HTML-Code
 */
function getBreadCrumbs() {
    $arr = explode("/",$_SERVER['REQUEST_URI']);
    $out = '<a href="/" >Start</a>';
    $href = "";
    
    foreach ($arr as $val) {
        if(!empty($val)) {
            $href .= $val."/";
            $out .= " &gt; <a href=\"/{$href}\" >".  ucfirst($val)."</a>";
        }
    }
    
    return $out;
}

function getUriFirst() {
    
    if($_SERVER['REQUEST_URI'] == '/') {
        return "/";
    }
    
    $arr = explode("/",$_SERVER['REQUEST_URI']);
    if(count($arr) >= 2 && !empty($arr[1])) {
        return "/".$arr[1];
    }
    else {
        return "/";
    }
}
?>