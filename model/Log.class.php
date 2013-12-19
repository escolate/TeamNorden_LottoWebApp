<?php

class Log {

private $log_id;
private $use_id;
private $log_action;
private $log_timestamp;
private $log_level;
private $log_cre_dat;
private $log_cre_id;
private $log_mod_dat;
private $log_mod_id;
private $log_del;

public function getLog_id() {
    return $this->log_id;
}

public function setLog_id($log_id) {
    $this->log_id = $log_id;
}

public function getUse_id() {
    return $this->use_id;
}

public function setUse_id($use_id) {
    $this->use_id = $use_id;
}

public function getLog_action() {
    return $this->log_action;
}

public function setLog_action($log_action) {
    $this->log_action = $log_action;
}

public function getLog_timestamp() {
    return $this->log_timestamp;
}

public function setLog_timestamp($log_timestamp) {
    $this->log_timestamp = $log_timestamp;
}

public function getLog_level() {
    return $this->log_level;
}

public function setLog_level($log_level) {
    $this->log_level = $log_level;
}

public function getLog_cre_dat() {
    return $this->log_cre_dat;
}

public function setLog_cre_dat($log_cre_dat) {
    $this->log_cre_dat = $log_cre_dat;
}

public function getLog_cre_id() {
    return $this->log_cre_id;
}

public function setLog_cre_id($log_cre_id) {
    $this->log_cre_id = $log_cre_id;
}

public function getLog_mod_dat() {
    return $this->log_mod_dat;
}

public function setLog_mod_dat($log_mod_dat) {
    $this->log_mod_dat = $log_mod_dat;
}

public function getLog_mod_id() {
    return $this->log_mod_id;
}

public function setLog_mod_id($log_mod_id) {
    $this->log_mod_id = $log_mod_id;
}

public function getLog_del() {
    return $this->log_del;
}

public function setLog_del($log_del) {
    $this->log_del = $log_del;
}


}
?>
