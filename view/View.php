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

     public function getBirthDateInput($bd = null) {
        $d = '';
        $m = '';
        $y = '';

        if (!empty($bd)) {
            $arr = explode(".", $bd);
            $d = $arr[0];
            $m = $arr[1];
            $y = $arr[2];
        }

        $out = "";
        $out .= '<select id="day" name="day"><option>Tag</option>';
        for ($i = 1; $i <= 31; $i++) {
            if ($i == $d) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        $out .= '</select>';

        $out .= '<select id="month" name="month"><option>Monat</option>';
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $m) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        $out .= '</select>';

        $out .= '<select id="year" name="year"><option>Jahr</option>';
        for ($i = date("Y"); $i >= date("Y") - 100; $i--) {
            if ($i == $y) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . $i . '</option>';
        }
        $out .= '</select>';

        return $out;
    }
}

