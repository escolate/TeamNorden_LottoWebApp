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

    protected function create() {
        $admin = (isset($_POST['admin']) && $_POST['admin'] == 'on') ? '1' : '0';
        $user = new User();
        $user->setUse_id(trim($_POST['userid']));
        $user->setUse_email(trim($_POST['email']));
        $user->setUse_address(trim($_POST['password1']));
        $user->setUse_administrator($admin);
        $user->setUse_firstname(trim($_POST['firstname']));
        $user->setUse_lastname(trim($_POST['lastname']));
        $user->setUse_birth(trim($_POST['day']) . "." . trim($_POST['month']) . "." . trim($_POST['year']));
        $user->setUse_address(trim($_POST['street']));
        $user->setUse_zip(trim($_POST['zip']));
        $user->setUse_city(trim($_POST['place']));
        $user->setUse_phone(trim($_POST['phone']));
        $user->setUse_mobile(trim($_POST['mobile']));

        $adapter = MysqlAdapter::getInstance();
        if ($adapter->saveUser($user)) {
            header("Location: /user/" . $user->getUse_id(), TRUE, 303);
            exit();
        }
        
        header("Location: /user/" . $user->getUse_id(), TRUE, 303);
        exit();
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
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/user/UserInitView.php';
        $view = new UserInitView();
        $view->assign('user', MysqlAdapter::getInstance()->getUser_($this->resourceId));
        $view->display();
    }

}

?>
