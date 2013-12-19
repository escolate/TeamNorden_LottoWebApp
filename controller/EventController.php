<?php

include_once './view/event/EventView.php';
include_once './view/event/EventShowView.php';

class EventController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	$view = new EventView();
	$eventList = MysqlAdapter::getInstance()->getEventList();
	$view->assign('eventList', $eventList);
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	$view = new EventShowView();
	$event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
	$view->assign('event', $event);
	$eventmemberList = MysqlAdapter::getInstance()->getEventmemberList($this->resourceId);
	$view->assign('eventmemberList', $eventmemberList);
	$seriesList = MysqlAdapter::getInstance()->getSeriesList($this->resourceId);
	$view->assign('seriesList', $seriesList);
	if(!$seriesList[0]){
	    $serId = 0;
	}else{
	    $serId = $seriesList[0]->getSer_id();
	}
	$numberList = MysqlAdapter::getInstance()->getNumberList($serId); // Muss noch angepasst werden
	$view->assign('numberList', $numberList);
	$view->display();
    }

}

?>
