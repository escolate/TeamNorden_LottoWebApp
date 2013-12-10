<?php
session_start();
    if(!empty($_POST['email'])) {
        //->VALIDATE
        if($_POST['email'] == "login@lotto") {
            $_SESSION['user']['id'] = 1;
            header("Location: /",TRUE,303);
        }
    }
    
    if(!empty($_POST['action']) && $_POST['action'] == 'logout') {
        unset($_SESSION['user']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Musikverein Lotto</title>
    </head>
    <body>
        <div id="login">
            <h1>Musikverein Lotto</h1>
            <?php
            $action = isset($_GET['action']) ? $_GET['action'] : '';
            $recoverlink = '<a href="/login.php?action=recover">Passwort vergessen?</a>';
            $passwordfield = '<input type="password" id="loginform-password" name="password" placeholder="Passwort">';
            $buttontext = "Login";

            if ($action == 'recover') {
                $recoverlink = "";
                $passwordfield = "";
                $buttontext = "Passwort anfordern";
            }
            ?>
            <form id="loginform" action="" method="post" name="loginform">
                <input type="email" id="loginform-email" name="email" placeholder="E-Mail Adresse">
                <?php echo $passwordfield; ?>
                <input type="submit" id="loginform-button" class="button blue" name="loginform_submit" value="<?php echo $buttontext; ?>">
            </form>
                <?php echo $recoverlink; ?>
        </div>
    </body>
</html>