<?php

include_once './view/eventmemberscard/EventmemberscardView.php';

class EventmemberscardController extends Controller {

    protected function create() {
	
    }

    protected function index() {
        $view = new EventmemberscardView();
        $view->assign('user', MysqlAdapter::getInstance()->getUserList());
        $view->display();
    }

    protected function init() {
	
    }

    protected function show() {

    }

}

?>
