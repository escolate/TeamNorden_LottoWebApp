<?php

class Number {

private $num_id;
private $ser_id;
private $num_num;
private $num_cre_dat;
private $num_cre_id;
private $num_mod_dat;
private $num_mod_id;
private $num_del;

public function getNum_id() {
    return $this->num_id;
}

public function setNum_id($num_id) {
    $this->num_id = $num_id;
}

public function getSer_id() {
    return $this->ser_id;
}

public function setSer_id($ser_id) {
    $this->ser_id = $ser_id;
}

public function getNum_num() {
    return $this->num_num;
}

public function setNum_num($num_num) {
    $this->num_num = $num_num;
}

public function getNum_cre_dat() {
    return $this->num_cre_dat;
}

public function setNum_cre_dat($num_cre_dat) {
    $this->num_cre_dat = $num_cre_dat;
}

public function getNum_cre_id() {
    return $this->num_cre_id;
}

public function setNum_cre_id($num_cre_id) {
    $this->num_cre_id = $num_cre_id;
}

public function getNum_mod_dat() {
    return $this->num_mod_dat;
}

public function setNum_mod_dat($num_mod_dat) {
    $this->num_mod_dat = $num_mod_dat;
}

public function getNum_mod_id() {
    return $this->num_mod_id;
}

public function setNum_mod_id($num_mod_id) {
    $this->num_mod_id = $num_mod_id;
}

public function getNum_del() {
    return $this->num_del;
}

public function setNum_del($num_del) {
    $this->num_del = $num_del;
}


}
?>
