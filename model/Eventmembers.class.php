<?php

class Eventmembers extends Lotto{

    private $eve_id;
    private $use_id;
    private $use_firstname;
    private $use_lastname;
    
    public function getEve_id() {
	return $this->eve_id;
    }

    public function setEve_id($eve_id) {
	$this->eve_id = $eve_id;
    }

    public function getUse_id() {
	return $this->use_id;
    }

    public function setUse_id($use_id) {
	$this->use_id = $use_id;
    }

    public function getUse_firstname() {
	return $this->use_firstname;
    }

    public function setUse_firstname($use_firstname) {
	$this->use_firstname = $use_firstname;
    }

    public function getUse_lastname() {
	return $this->use_lastname;
    }

    public function setUse_lastname($use_lastname) {
	$this->use_lastname = $use_lastname;
    }



}

?>
