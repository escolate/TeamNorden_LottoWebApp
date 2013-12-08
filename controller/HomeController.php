<?php

class HomeController extends Controller {
    
    protected function create() {
        
    }

    protected function index() {
	include_once 'view/home/HomeView.php';
        $view = new HomeView();
	$event = MysqlAdapter::getInstance()->getEvent();
	$view->assign('event', $event);
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        
    }   
}

?>
