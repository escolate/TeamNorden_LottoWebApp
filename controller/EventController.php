<?php

include_once './view/event/EventView.php';
include_once './view/event/EventShowView.php';


class EventController extends Controller {

    protected function create() {
	$num_num = trim($_POST['number']);
	$eventId = trim($_POST['eventId']);
	$seriesId = trim($_POST['seriesId']);
	$number = new Number();
	$number->setNum_num($num_num);
	if(MysqlAdapter::getInstance()->saveNumber($number->getNum_num(),$seriesId,1)){
	    header("Location: /event/$eventId", TRUE, 303);
	    exit();
	}
    }

    protected function index() {
	$view = new EventView();
	$eventList = MysqlAdapter::getInstance()->getEventList();
	$view->assign('eventList', $eventList);
	$eventCreatorList = array();
	foreach ($eventList as $object) {
	    $eventCreatorList[] = MysqlAdapter::getInstance()->getUser_($object->getEvt_cre_id());
	}
	$view->assign('eventCreatorList', $eventCreatorList);
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	// Event shown
	$view = new EventShowView();
	$event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
	$view->assign('event', $event);
	// Event user and creator show
	$eventCre = MysqlAdapter::getInstance()->getUser_($event->getEvt_cre_id());
	$eventMod = MysqlAdapter::getInstance()->getUser_($event->getEvt_mod_id());
	$view->assign('eventCre', $eventCre);
	$view->assign('eventMod', $eventMod);
	// Event members
	$eventmemberList = MysqlAdapter::getInstance()->getEventmemberList($this->resourceId);
	$eventmemberNameList = array();
	if ($eventmemberList) {
	    foreach ($eventmemberList as $object) {
		$eventmemberNameList[] = MysqlAdapter::getInstance()->getUser_($object->getUse_id());
	    }
	}
	$view->assign('eventmemberNameList', $eventmemberNameList);
	// Series list
	$seriesList = MysqlAdapter::getInstance()->getSeriesList($this->resourceId);
	$view->assign('seriesList', $seriesList);
	if (!$seriesList[0]) {
	    $serId = 0;
	} else {
	    $serId = $seriesList[0]->getSer_id();
	}
	// Numbers list
	$numberList = NULL;
	$newestSeries = MysqlAdapter::getInstance()->getNewestSeries($this->resourceId);
	if ($newestSeries) {
	    $numberList = MysqlAdapter::getInstance()->getNumberList($newestSeries->getSer_id());
	}
	$view->assign('numberList', $numberList);
	//Also give the newest series id to the view
	$view->assign('newestSeries', $newestSeries);
	// Display the event
	$view->display();
    }

}

?>
