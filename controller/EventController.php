<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventController
 *
 * @author stinkpad
 */
class EventController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	include_once './view/event/EventListView.php';
	$view = new EventListView();
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	include_once './view/event/EventDetailView.php';
	$view = new EventDetailView();
	$event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
	$view->assign('event', $event);
	$view->display();
    }

}

?>
