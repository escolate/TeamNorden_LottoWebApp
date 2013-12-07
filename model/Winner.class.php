<?php

class Winner {

private $win_id;
private $use_id;
private $eve_id;
private $ser_id;
private $win_cre_dat;
private $win_cre_id;
private $win_mod_dat;
private $win_mod_id;
private $win_del;
private $win_prize;

public function getWin_id() {
    return $this->win_id;
}

public function setWin_id($win_id) {
    $this->win_id = $win_id;
}

public function getUse_id() {
    return $this->use_id;
}

public function setUse_id($use_id) {
    $this->use_id = $use_id;
}

public function getEve_id() {
    return $this->eve_id;
}

public function setEve_id($eve_id) {
    $this->eve_id = $eve_id;
}

public function getSer_id() {
    return $this->ser_id;
}

public function setSer_id($ser_id) {
    $this->ser_id = $ser_id;
}

public function getWin_cre_dat() {
    return $this->win_cre_dat;
}

public function setWin_cre_dat($win_cre_dat) {
    $this->win_cre_dat = $win_cre_dat;
}

public function getWin_cre_id() {
    return $this->win_cre_id;
}

public function setWin_cre_id($win_cre_id) {
    $this->win_cre_id = $win_cre_id;
}

public function getWin_mod_dat() {
    return $this->win_mod_dat;
}

public function setWin_mod_dat($win_mod_dat) {
    $this->win_mod_dat = $win_mod_dat;
}

public function getWin_mod_id() {
    return $this->win_mod_id;
}

public function setWin_mod_id($win_mod_id) {
    $this->win_mod_id = $win_mod_id;
}

public function getWin_del() {
    return $this->win_del;
}

public function setWin_del($win_del) {
    $this->win_del = $win_del;
}

public function getWin_prize() {
    return $this->win_prize;
}

public function setWin_prize($win_prize) {
    $this->win_prize = $win_prize;
}


}
?>
