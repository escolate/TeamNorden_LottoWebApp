<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'view/home/HomeView.php';
/**
 * Description of HomeController
 *
 * @author tscheurer
 */
class HomeController extends Controller {
    
    protected function create() {
        
    }

    protected function index() {
        $view = new HomeView();
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        
    }   
}

?>