<?php

include_once './view/eventmemberscard/EventmemberscardView.php';

class EventmemberscardController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	$userId = $_GET['user'];
	$eventId = $_GET['event'];

	$view = new EventmemberscardView();

	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {

    }

}

?>
