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
	$event = MysqlAdapter::getInstance()->getEvent("SELECT * FROM event WHERE evt_id = $this->resourceId");
	$view->assign('event', $event);
	$view->display();
    }

}

?>
