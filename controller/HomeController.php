<?php

include_once 'view/home/HomeView.php';

class HomeController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	$view = new HomeView();
	$eventList = MysqlAdapter::getInstance()->getEventList(5);
	$view->assign('eventList', $eventList);
	$winnerList = MysqlAdapter::getInstance()->getWinnerList(5);
	$view->assign('winnerList', $winnerList);
	$cardList = MysqlAdapter::getInstance()->getCardList(5);
	$view->assign('cardList', $cardList);
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	
    }

}

?>
