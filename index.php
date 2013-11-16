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
            <div id="user"><a href="#">zaki@gmail.com</a> | <a href="#">logout</a></div>
        </div>
        <div id="logo">
	    <h1><a href="#">Musikverein Lotto</a></h1>
	</div>
        <a href="#" class="notification alert">"Biergarten & Lotto" wird gerade gespielt. Hier klicken um in das Spiel zu gelangen.</a>
        <div class="notification error">Bitte alle Pflichtfelder ausfüllen!</div>
	<div class="notification successful">Super! Deine Daten sind gespeichert.</div>
	<div id="breadcrumbs"><a href="/">Start</a> &gt; Veranstaltung</div>
        <div id="content">
            <p>Content</p>
	    <a href="#" class="button buttoncreate">ERSTELLEN</a>
	    <a href="#" class="buttonclose">BEENDEN</a>
	    <a href="#" class="buttonadd">HINZUFÜGEN</a>
        </div>
    </body>
</html>
