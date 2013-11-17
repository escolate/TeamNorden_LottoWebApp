<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>LottoApp</title>
    </head>

    <body>
        <div id="header">
            <div id="date"><?php echo date("d.m.Y H:m")." Uhr"; ?></div>
            <div id="user"><a href="#">zaki@gmail.com</a> | <a href="#">Logout</a></div>
        </div>
        <div id="logo">
	    <h1><a href="#">Musikverein Lotto</a></h1>
	</div>
        <a href="#" class="notification yellow">"Biergarten & Lotto" wird gerade gespielt. Hier klicken um in das Spiel zu gelangen.</a>
        <div class="notification red">Bitte alle Pflichtfelder ausfüllen!</div>
	<div class="notification green">Super! Deine Daten sind gespeichert.</div>
	<div id="breadcrumbs"><a href="/">Start</a> &gt; Veranstaltung</div>
        <div id="content">
	    <?php include_once 'event.php'; ?>
        </div>
    </body>
</html>
