<?php

session_start();
//Check login
if(!isset($_SESSION['user']['id'])) {
    header("Location: /login.php",TRUE,303);
    exit();
}

include_once './config/config.php';
include_once './controller/Controller.php';
include_once './lib/MysqlAdapter.php';
include_once './view/View.php';
?>
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
            <noscript>
            <div id="noscript" class="red">
                Um die Applikation verwenden zu können müssen sie Javascript aktivieren!
                <img alt="X" src="/images/icons/cancel_sw.png">
            </div>
            </noscript>
            <img src="/images/logos/logo.png" id="logo">
            <div id="breadcrumb"><?php echo getBreadCrumbs(); ?></div>
            <div id="account" data-tip="Hier kannst du dein Profil bearbeiten oder dich ausloggen."><a href="#"><?php echo $_SESSION['user']['name']; ?></a> | <form action="/login.php" method="post"> <input type="hidden" name="action" value="logout"><a id="logoutlink" href="#">Logout</a></form></div> 
        </div>
        <div id="content">
            <div id="debugg"></div>
	    <?php
	    switch (getUriFirst()) {
		case URI_EVENT:
		    include_once './controller/EventController.php';
		    $controller = new EventController();
		    break;
		case URI_WINNER:
		    include_once './controller/WinnerController.php';
		    $controller = new WinnerController();
		    break;
		case URI_SERIES:
		    include_once './controller/SeriesController.php';
		    $controller = new SeriesController();
		    break;
		case URI_API:
		    include_once './controller/ApiController.php';
		    $controller = new ApiController();
		    break;
		case URI_ADMIN:
		    include_once './controller/AdminController.php';
		    $controller = new AdminController();
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
    $arr = explode("/", $_SERVER['REQUEST_URI']);
    $out = '<a href="/" >Start</a>';
    $href = "";

    foreach ($arr as $val) {
	if (!empty($val)) {
	    $href .= $val . "/";
	    $out .= " &gt; <a href=\"/{$href}\" >" . ucfirst($val) . "</a>";
	}
    }

    return $out;
}

function getUriFirst() {

    if ($_SERVER['REQUEST_URI'] == '/') {
	return "/";
    }

    $arr = explode("/", $_SERVER['REQUEST_URI']);
    if (count($arr) >= 2 && !empty($arr[1])) {
	return "/" . $arr[1];
    } else {
	return "/";
    }
}
?>