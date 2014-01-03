<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author tscheurer
 */
class UserController extends Controller {

    private $notify;

    protected function create() {
        $admin = (isset($_POST['admin']) && $_POST['admin'] == 'on') ? '1' : '0';

        $user = new User();
        $user->setUse_id(trim($_POST['userid']));
        $user->setUse_email(trim($_POST['email']));
        $user->setUse_administrator($admin);
        $user->setUse_firstname(trim($_POST['firstname']));
        $user->setUse_lastname(trim($_POST['lastname']));
        $user->setUse_address(trim($_POST['street']));
        $user->setUse_zip(trim($_POST['zip']));
        $user->setUse_city(trim($_POST['place']));
        $user->setUse_phone(trim($_POST['phone']));
        $user->setUse_mobile(trim($_POST['mobile']));

        //Set password if values match
        if ($_POST['password1'] == $_POST['password2']) {
            $user->setUse_password($_POST['password1']);
        }

        //Set birthdate if set
        if (is_numeric($_POST['day']) && is_numeric($_POST['month']) && is_numeric($_POST['year'])) {
            $user->setUse_birth(trim($_POST['day']) . "." . trim($_POST['month']) . "." . trim($_POST['year']));
        }

        $adapter = MysqlAdapter::getInstance();
        if ($adapter->saveUser($user)) {
            header("Location: /user/" . $user->getUse_id(), TRUE, 303);
            exit();
        }

        $this->resourceId = $user->getUse_id();
        $this->notify = "Der Benutzer existiert bereits!";
        $this->show();
    }

    protected function index() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/user/UserView.php';
        $view = new UserView();
        $view->assign('user', MysqlAdapter::getInstance()->getUserList());
        $view->display();
    }

    protected function init() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/user/UserInitView.php';
        $view = new UserInitView();
        $view->display();
    }

    protected function show() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/user/UserShowView.php';
        $view = new UserShowView();
        $view->assign('user', MysqlAdapter::getInstance()->getUser_($this->resourceId));
        $view->assign('notify', $this->notify);
        $view->display();
    }

}

?>
