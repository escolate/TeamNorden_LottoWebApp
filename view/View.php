<?php

/**
 * abstract class for all views 
 *
 * @author Marc Jenzer
 */
abstract class View {
    
    /**
     * it has the values of the query
     * 
     * @var array 
     * 
     */
    protected $vars = array();

    public function assign($key, $value) {
        $this->vars[$key] = $value;
    }
    
    abstract function display();
}

