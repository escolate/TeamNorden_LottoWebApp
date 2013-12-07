<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'view/winner/WinnerView.php';
include_once 'view/winner/WinnerShowView.php';
/**
 * Description of WinnerController
 *
 * @author tscheurer
 */
class WinnerController extends Controller {
    
    protected function create() {
        
    }

    protected function index() {
        $view = new WinnerView();
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        $view = new WinnerShowView();
	$winner = MysqlAdapter::getInstance()->getWinner($this->resourceId);
	$view->assign('winner', $winner);
	$view->assign("user", MysqlAdapter::getInstance()->getUser($winner->getUse_id()));
        $view->display();
    }    //put your code here
}

?>
