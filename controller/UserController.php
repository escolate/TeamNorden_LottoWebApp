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
        $this->show();
    }

    protected function index() {
        include_once $_SERVER['DOCUMENT_ROOT'].'/view/user/UserView.php';
        $view = new UserView();
        $view->assign('user', MysqlAdapter::getInstance()->getUserList());
        $view->display();
    }

    protected function init() {
        include_once $_SERVER['DOCUMENT_ROOT'].'/view/user/UserInitView.php';
        $view = new UserInitView();
        $view->display();
    }

    protected function show() {
        include_once $_SERVER['DOCUMENT_ROOT'].'/view/user/UserInitView.php';
        $view = new UserInitView();
        $view->assign('user', MysqlAdapter::getInstance()->getUser_($this->resourceId));
        $view->display();
    } 
}

?>
