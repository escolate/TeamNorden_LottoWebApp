<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>LottoApp</title>
    </head>

    <body>
        <div id="bg">
            <div id="header">
                <div id="date"><?php echo date("d.m.Y H:m") . " Uhr"; ?></div>
                <div id="user">zaki@gmail.com | logout</div>
            </div>
            <div id="logo"><h1>Musikverein Lotto</h1></div>
            <div id="notifications">"Biergarten & Lotto" wird gerade gespielt. <a href="/">Hier klicken um in das Spiel zu gelangen.</a></div>
            <div id="breadcrumbs"><a href="/">Start</a> &gt; Veranstaltung</div>
            <div id="content">
                <?php
                include_once './config/config.php';
                $uri = $_SERVER['REQUEST_URI'];

                switch ($uri) {
                    case URI_HOME:
                    case "/":
                        include_once './controller/HomeController.php';
                        $controller = new HomeController();
                        break;
                    case URI_EVENTS:
                        include_once 'controller/EventController.php';
                        $controller = new EventController();
                        break;
                    default :
                        break;
                }

                $controller->route();
                ?>
                <a href="#" class="buttoncreate">ERSTELLEN</a>
                <a href="#" class="buttonclose">BEENDEN</a>
                <a href="#" class="buttonadd">HINZUFÜGEN</a>
            </div>
        </div>
    </body>

</html>
