<?php

include_once 'view/home/HomeView.php';

class HomeController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	$view = new HomeView();
	// event
	$eventList = MysqlAdapter::getInstance()->getEventList(5);
	$view->assign('eventList', $eventList);
	// winner
	$winnerList = MysqlAdapter::getInstance()->getWinnerList(5);
	$view->assign('winnerList', $winnerList);
	// user
        $view->assign('userlist', MysqlAdapter::getInstance()->getUserList(5));
	// card
	$cardList = MysqlAdapter::getInstance()->getCardList(5);
	$view->assign('cardList', $cardList);
	// log
        $view->assign('logList', MysqlAdapter::getInstance()->getLogList(5));
	// display
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	
    }

}

?>
