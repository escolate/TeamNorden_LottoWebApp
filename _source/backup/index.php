<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>LottoApp</title>
    </head>

    <body>
	<div id="container">
	    <div id="header">
		<div id="date"><?php echo date("d.m.Y H:m") . " Uhr"; ?></div>
		<div id="user"><a href="#">zaki@gmail.com</a> | <a href="#">Logout</a></div>
	    </div>
	    <div id="logo">
		<h1><a href="index.php?page=default">Musikverein Lotto</a></h1>
		<a href="login.php?page=">LOGIN</a> | 
		<a href="index.php?page=currentEvent">LAUFENDES SPIEL</a> | 
		<a href="index.php?page=events">VERANSTALTUNGEN</a> | 
		<a href="index.php?page=newLottoCard">NEUE LOTTOKARTE</a> | 
		<a href="index.php?page=newEvent">NEUE VERANSTALTUNG</a> | 
	    </div>
	    <div id="breadcrumbs"><a href="/">Start</a> &gt; Veranstaltung</div>
	    <!--<a href="#" class="notification yellow">"Biergarten & Lotto" wird gerade gespielt. Hier klicken um in das Spiel zu gelangen.</a>-->
	    <!--<div class="notification red">Bitte alle Pflichtfelder ausfüllen!</div>-->
	    <!--<div class="notification green">Super! Deine Daten sind gespeichert.</div>-->
	    <div id="content">
		<?php
		if (!empty($_GET)) {
		    switch ($_GET) {
			case $_GET['page'] == 'currentEvent':
			    include_once 'currentEvent.php';
			    break;
			case $_GET['page'] == 'newLottoCard':
			    include_once 'newLottoCard.php';
			    break;
			case $_GET['page'] == 'newEvent':
			    include_once 'newEvent.php';
			    break;
			case $_GET['page'] == 'events':
			    include_once 'events.php';
		    }
		}
		?>
	    </div>
	</div>
    </body>
</html>
