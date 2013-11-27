<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Musikverein Lotto</title>
    </head>
    <body>
	<div id="header">
	    <div id="breadcrumb"><a href="#">Start</a> &gt; <a href="#">Veranstaltung</a> &gt; Neue Veranstaltung erstellen</div>
	    <div id="account"><a href="#">zaki@gmail.com</a> | <a href="#">Logout</a></div> 
	</div>
	<div id="content">
	    <div id="logo">
		<a href="login.php?page=">LOGIN</a> | 
		<a href="index.php?page=create">CREATE</a> | 
		<a href="index.php?page=show">SHOW</a> | 
		<a href="index.php?page=list_index">INDEX</a> | 
		<a href="index.php?page=createLottocard">CREATE LOTTO</a> | 
		<a href="index.php?page=showWinner">SHOW WINNER</a> | 
	    </div>
	    <?php
	    if (!empty($_GET)) {
		switch ($_GET) {
		    case $_GET['page'] == 'create':
			include_once 'create.php';
			break;
		    case $_GET['page'] == 'show':
			include_once 'show.php';
			break;
		    case $_GET['page'] == 'list_index':
			include_once 'list_index.php';
			break;
		    case $_GET['page'] == 'createLottocard':
			include_once 'createLottocard.php';
			break;
		    case $_GET['page'] == 'showWinner':
			include_once 'showWinner.php';
			break;
		}
	    }
	    ?>
	</div>
    </body>
</html>
