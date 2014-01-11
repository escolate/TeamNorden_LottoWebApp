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
    
    public function formatPhone($nr) {
        $nr = str_replace(array(' ','(0)'), "", $nr);
        $string = '';
        if(strlen(substr($nr, 0, -7)) > 3) {
            $string .= ' '.substr($nr, 0,-9).' '.substr($nr, -9, 2);
        }
        else {
            $string .= substr($nr,0,3);
        }
        $string .= ' '.substr($nr, -7, 3);
        $string .= ' '.substr($nr, -4,2);
        $string .= ' '.substr($nr, -2);
        return $string;
    }

}

