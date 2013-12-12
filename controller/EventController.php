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
	$view->display();
    }
}

?>
