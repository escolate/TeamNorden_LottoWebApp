<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'view/winner/WinnerView.php';
/**
 * Description of WinnerController
 *
 * @author tscheurer
 */
class WinnerController extends Controller {
    
    protected function create() {
        
    }

    protected function index() {
        $view = new WinnerView();
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        
    }    //put your code here
}

?>
