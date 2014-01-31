<?php

include_once './view/log/logView.php';

class LogController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	$view = new logView();
        $view->assign('logList', MysqlAdapter::getInstance()->getLogList(50));
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	
    }

}

?>
