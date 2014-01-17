<?php

include_once './view/event/EventView.php';
include_once './view/event/EventShowView.php';
include_once './view/event/EventAddUserView.php';
include_once './view/event/EventInitView.php';

class EventController extends Controller {

    protected function create() {
	if ($_POST['events-action'] != "action") { // action selected?
	    switch ($_POST['events-action']) {
		// Delete event
		case "deleteEvent":
		    $eventIds = $_POST['eventIds'];
		    if (count($eventIds)) {
			foreach ($eventIds as $eventId) {
			    MysqlAdapter::getInstance()->deleteEvent($eventId);
			}
		    }
		    header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
		    break;
	    }

	    switch ($_POST['form']) {
		// Add user
		case "addUser":
		    $userIds = $_POST['userIds'];
		    $eventId = $_POST['eventId'];
		    if (count($userIds)) {
			foreach ($userIds as $userId) {
			    MysqlAdapter::getInstance()->addUser($userId, $eventId);
			}
		    }
		    header("Location: /event/$eventId", TRUE, 303);
		    break;
		// Remove user
		case "removeUser":
		    $userIds = $_POST['userIds'];
		    $eventId = $_POST['eventId'];
		    if (count($userIds)) {
			foreach ($userIds as $userId) {
			    MysqlAdapter::getInstance()->removeUser($userId, $eventId);
			}
		    }
		    header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
		    break;
		// Create event
		case "createEvent":
		    // Get data from post form
		    $evt_name = trim($_POST['evt_name']);
		    $evt_day = $_POST['day'];
		    $evt_month = $_POST['month'];
		    $evt_year = $_POST['year'];
		    $evt_location = trim($_POST['evt_location']);
		    $evt_city = trim($_POST['evt_city']);
		    $evt_zip = trim($_POST['evt_zip']);
		    // Set data to event object
		    $event = new Event();
		    $event->setEvt_name($evt_name);
		    $event->setEvt_datetime($evt_year . "-" . $evt_month . "-" . $evt_day);
		    $event->setEvt_location($evt_location);
		    $event->setEvt_city($evt_city);
		    $event->setEvt_zip($evt_zip);
		    // Give event object to database adapter
		    MysqlAdapter::getInstance()->saveEvent($event);
		    break;
		// Delete event
		case "deleteEvent":
		    echo "lalala";
		    exit();
		    break;
		// Edit event
		case "editEvent":

		    break;
	    }
	    // create or delete a number from event
	    if ($_POST['form'] == "saveNumber") {
		if($_POST['seriesId']){
		    echo "leer";
		}
		$number = trim($_POST['number']);
		if (preg_match("/^\d+$/", $number)) {
		    $eventId = $_POST['eventId'];
		    $seriesId = $_POST['seriesId'];
		    MysqlAdapter::getInstance()->saveNumber($number, $seriesId, 4);
		}
		header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
	    } elseif ($_POST['form'] == "number") {
		$seriesId = $_POST['seriesId'];
		foreach ($_POST['numberIds'] as $numberId) {
		    MysqlAdapter::getInstance()->deleteNumber($numberId, $seriesId, 5);
		}
		header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
	    }
	    //Close Series
	    if ($_POST['form'] == "closeSeries") {
		$eventId = $_POST['eventId'];
		MysqlAdapter::getInstance()->setSeries($eventId);
	    }
	    header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
	} else {
	    header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
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
	if (preg_match("@/add/([0-9]+)$@", $_SERVER['REQUEST_URI'])) {
	    $view = new EventAddUserView();
	    $userList = MysqlAdapter::getInstance()->getUserList();
	    $eventmemberList = MysqlAdapter::getInstance()->getEventmemberList($this->resourceId);
	    $event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
	    $view->assign('user', $userList);
	    $view->assign('eventmember', $eventmemberList);
	    $view->assign('event', $event);
	    $view->display();
	} else {
	    $view = new EventInitView();
	    $view->display();
	}
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
