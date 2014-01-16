<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'view/series/SeriesShowView.php';

/**
 * Description of SeriesController
 *
 * @author stinkpad
 */
class SeriesController extends Controller {

    protected function create() {
	
    }

    protected function index() {
	
    }

    protected function init() {
	
    }

    protected function show() {
	$view = new SeriesShowView();
	// Event
	$event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
	$view->assign('event', $event);
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
	$view->display();
    }

}

?>
