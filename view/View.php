<?php

abstract class View {

    protected $vars = array();

    public function assign($key, $value) {
	$this->vars[$key] = $value;
    }

    abstract function display();

    public function getTime($value) {
	if (!empty($value)) {
	    $obj = new DateTime($value);
	    return $obj->format('H:i');
	} else {
	    return NULL;
	}
    }

    public function getDate($value) {
	if (!empty($value)) {
	    $obj = new DateTime($value);
	    return $obj->format('d.m.Y');
	} else {
	    return NULL;
	}
    }

    public function getDateTime($value) {
	if (!empty($value)) {
	$obj = new DateTime($value);
	return $obj->format('d. M Y - H:i');
	} else {
	    return NULL;
	}
    }

}

