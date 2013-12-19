<?php

class Event {

private $evt_id;
private $evt_name;
private $evt_location;
private $evt_city;
private $evt_zip;
private $evt_datetime;
private $evt_cre_dat;
private $evt_cre_id;
private $evt_mod_date;
private $evt_mod_id;
private $evt_del;
/**
 *
 * @var type \User
 */
private $user;

public function getUser() {
    return $this->user;
}

public function setUser($user) {
    $this->user = $user;
}

public function getEvt_id() {
    return $this->evt_id;
}

public function setEvt_id($evt_id) {
    $this->evt_id = $evt_id;
}

public function getEvt_name() {
    return $this->evt_name;
}

public function setEvt_name($evt_name) {
    $this->evt_name = $evt_name;
}

public function getEvt_location() {
    return $this->evt_location;
}

public function setEvt_location($evt_location) {
    $this->evt_location = $evt_location;
}

public function getEvt_city() {
    return $this->evt_city;
}

public function setEvt_city($evt_city) {
    $this->evt_city = $evt_city;
}

public function getEvt_zip() {
    return $this->evt_zip;
}

public function setEvt_zip($evt_zip) {
    $this->evt_zip = $evt_zip;
}

public function getEvt_datetime() {
    return $this->evt_datetime;
}

public function setEvt_datetime($evt_datetime) {
    $this->evt_datetime = $evt_datetime;
}

public function getEvt_cre_dat() {
    return $this->evt_cre_dat;
}

public function setEvt_cre_dat($evt_cre_dat) {
    $this->evt_cre_dat = $evt_cre_dat;
}

public function getEvt_cre_id() {
    return $this->evt_cre_id;
}

public function setEvt_cre_id($evt_cre_id) {
    $this->evt_cre_id = $evt_cre_id;
}

public function getEvt_mod_date() {
    return $this->evt_mod_date;
}

public function setEvt_mod_date($evt_mod_date) {
    $this->evt_mod_date = $evt_mod_date;
}

public function getEvt_mod_id() {
    return $this->evt_mod_id;
}

public function setEvt_mod_id($evt_mod_id) {
    $this->evt_mod_id = $evt_mod_id;
}

public function getEvt_del() {
    return $this->evt_del;
}

public function setEvt_del($evt_del) {
    $this->evt_del = $evt_del;
}


}
?>
