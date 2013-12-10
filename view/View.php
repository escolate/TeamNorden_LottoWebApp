<?php

abstract class View {

    protected $vars = array();

    public function assign($key, $value) {
	$this->vars[$key] = $value;
    }

    abstract function display();

    public function getTime($value) {
	$obj = new DateTime($value);
	return $obj->format('H:i');
    }

    public function getDate($value) {
	$obj = new DateTime($value);
	return $obj->format('d.m.Y');
    }

    public function getDateTime($value) {
	$obj = new DateTime($value);
	return $obj->format('d. M Y - H:i');
    }

}

