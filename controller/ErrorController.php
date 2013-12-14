<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorController
 *
 * @author tscheurer
 */
class ErrorController extends Controller {
    protected function create() {
        
    }

    protected function index() {
        include_once $_SERVER['DOCUMENT_ROOT'].'/view/error/ErrorView.php';
        $view = new ErrorView();
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        
    }    
}

?>
