<?php
session_start();
//Check login
if(!isset($_SESSION['user']['id'])) {
    header("Location: /login.php",TRUE,303);
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/view/View.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Lotto.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/MysqlAdapter.php';
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
            <div id="account" title="Bearbeite dein Account."><a href="#"><?php echo $_SESSION['user']['name']; ?></a> | <form action="/login.php" method="post"> <input type="hidden" name="action" value="logout"><a id="logoutlink" href="#" title="Hier beendest du die Lotto Web App.">Logout</a></form></div> 
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
		case URI_CARD:
		    include_once './controller/CardController.php';
		    $controller = new CardController();
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
function getBreadCrumbs() {
    $arr = explode("/", $_SERVER['REQUEST_URI']);
    $out = '<a href="/" >Start</a>';
    $href = "";
    $end =  end($arr);

    foreach ($arr as $val) {
		if(!empty($val)){
	   $out .= " &gt;"; 
	}
	if (!empty($val) AND $val != $end AND !empty($end)) {
	    $href .= $val . "/";
	    $out .= "<a href=\"/{$href}\" >" . preg_replace("/^[0-9]+-/", "", ucfirst($val)) . "</a>";
	}else{
	    $out .= preg_replace("/^[0-9]+-/", "", ucfirst($val));
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