<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserCardController
 *
 * @author tscheurer
 */
class UserCardController extends Controller {
    
    protected function create() {
        switch ($_POST['action']) {
            case 'delete':
                //Delete Card
                echo 'delete';
                break;
            case 'add':
                //Add Item
                echo 'add';
                break;
        }
        $this->show();
    }

    protected function index() {
        
    }

    protected function init() {
        
    }

    protected function show() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/usercard/UserCardShowView.php';
        $view = new UserCardShowView();
        
        $user = MysqlAdapter::getInstance()->getUser_($this->resourceId);
        $view->assign('user', $user);
        $view->assign('usercards', MysqlAdapter::getInstance()->getUserCards($user->getUse_id()));
        
        $view->display();
    }    //put your code here
}

?>
