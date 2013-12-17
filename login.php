<?php
session_start();
$notification = "";

//Check login
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Lotto.class.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/MysqlAdapter.php';
    $user = MysqlAdapter::getInstance()->authenticateUser($_POST['email'], $_POST['password']);

    if ($user !== NULL) {
        $_SESSION['user']['id'] = $user->getUse_id();
        $_SESSION['user']['email'] = $user->getUse_email();
        $_SESSION['user']['name'] = $user->getUse_firstname() . " " . $user->getUse_lastname();
        header("Location: /", TRUE, 303);
        exit();
    } else {
        $notification = '<div class="red">Benutzername oder Passwort falsch.</div>';
    }
}

//logout
if (!empty($_POST['action']) && $_POST['action'] == 'logout') {
    unset($_SESSION['user']);
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action == 'reset') {
    //Send mail
    //Redirect
    header("Location: /login.php?action=sent", TRUE, 303);
    exit();
}
if ($action == 'sent') {
    $notification = '<div class="yellow">Ihr neues Passwort wurde per E-Mail an sie gesendet.</div>';
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
    <body lang="de">
        <div id="login">
            <h1>Musikverein Lotto</h1>
<?php
$recoverlink = '<a href="/login.php?action=recover">Passwort vergessen?</a>';
$passwordfield = '<input type="password" id="loginform-password" name="password" placeholder="Passwort">';
$buttontext = "Login";
$reset = '';

if ($action == 'recover') {
    $recoverlink = "";
    $passwordfield = "";
    $buttontext = "Passwort anfordern";
    $reset = '<input type="hidden" name="action" value="reset">';
}
?>
            <form id="loginform" action="" method="post" name="loginform">
            <?php echo $reset; ?>
                <input type="email" id="loginform-email" name="email" placeholder="E-Mail Adresse">
                <?php echo $passwordfield; ?>
                <input type="submit" id="loginform-button" class="button blue" name="loginform_submit" value="<?php echo $buttontext; ?>">
            </form>
                <?php echo $notification ?>
<?php echo $recoverlink; ?>
        </div>
    </body>
</html>