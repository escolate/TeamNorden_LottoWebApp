<?php

include_once 'view/home/HomeView.php';

class HomeController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	$view = new HomeView();
	$eventList = MysqlAdapter::getInstance()->getEvent("SELECT * FROM event ORDER BY evt_cre_dat DESC LIMIT 4");
	$view->assign('eventList', $eventList);
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	
    }

}

?>
