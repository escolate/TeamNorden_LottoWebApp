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
	$list = MysqlAdapter::getInstance()->getWinnerList();
	$view->assign('list', $list);
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
	$view = new WinnerShowView();
	$object = MysqlAdapter::getInstance()->getWinner($this->resourceId);
	$view->assign('winner', $object);
	$view->display();
    }
}

?>
