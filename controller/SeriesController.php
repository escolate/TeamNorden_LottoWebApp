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
	// get data from url
	$seriesId = $_GET['seriesId'];
	$eventId = $_GET['eventId'];
	$seriesName = $_GET['seriesName'];
	$view = new SeriesShowView();
	// Event
	$event = MysqlAdapter::getInstance()->getEvent($eventId);
	$view->assign('event', $event);
	// Series list
	$seriesList = MysqlAdapter::getInstance()->getSeriesList($eventId);
	$view->assign('seriesList', $seriesList);
	if (!$seriesList[0]) {
	    $serId = 0;
	} else {
	    $serId = $seriesList[0]->getSer_id();
	}
	// Numbers list
	$numberList = MysqlAdapter::getInstance()->getNumberList($seriesId);
	$view->assign('numberList', $numberList);
	$view->assign('newestSeries', $seriesId);
	$view->assign('seriesName', $seriesName);
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	
    }

}

?>
