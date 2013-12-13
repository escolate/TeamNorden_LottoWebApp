<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'view/series/SeriesView.php';

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
	$view->display();
    }

}

?>
