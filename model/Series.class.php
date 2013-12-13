<?php

class Series extends Lotto{

private $ser_id;
private $eve_id;
private $ser_cre_dat;
private $ser_cre_id;
private $ser_mod_dat;
private $ser_mod_id;
private $ser_del;
private $ser_evt_name;

public function getSer_evt_name() {
    return $this->ser_evt_name;
}

public function setSer_evt_name($ser_evt_name) {
    $this->ser_evt_name = $ser_evt_name;
}


public function getSer_id() {
    return $this->ser_id;
}

public function setSer_id($ser_id) {
    $this->ser_id = $ser_id;
}

public function getEve_id() {
    return $this->eve_id;
}

public function setEve_id($eve_id) {
    $this->eve_id = $eve_id;
}

public function getSer_cre_dat() {
    return $this->ser_cre_dat;
}

public function setSer_cre_dat($ser_cre_dat) {
    $this->ser_cre_dat = $ser_cre_dat;
}

public function getSer_cre_id() {
    return $this->ser_cre_id;
}

public function setSer_cre_id($ser_cre_id) {
    $this->ser_cre_id = $ser_cre_id;
}

public function getSer_mod_dat() {
    return $this->ser_mod_dat;
}

public function setSer_mod_dat($ser_mod_dat) {
    $this->ser_mod_dat = $ser_mod_dat;
}

public function getSer_mod_id() {
    return $this->ser_mod_id;
}

public function setSer_mod_id($ser_mod_id) {
    $this->ser_mod_id = $ser_mod_id;
}

public function getSer_del() {
    return $this->ser_del;
}

public function setSer_del($ser_del) {
    $this->ser_del = $ser_del;
}



}
?>
