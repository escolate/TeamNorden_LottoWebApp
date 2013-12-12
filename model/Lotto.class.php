<?php

abstract class Lotto {
    private $use_cre_firstname;
    private $use_cre_lastname;
    private $use_mod_firstname;
    private $use_mod_lastname;
    
    public function getUse_cre_firstname() {
	return $this->use_cre_firstname;
    }

    public function setUse_cre_firstname($use_cre_firstname) {
	$this->use_cre_firstname = $use_cre_firstname;
    }

    public function getUse_cre_lastname() {
	return $this->use_cre_lastname;
    }

    public function setUse_cre_lastname($use_cre_lastname) {
	$this->use_cre_lastname = $use_cre_lastname;
    }

    public function getUse_mod_firstname() {
	return $this->use_mod_firstname;
    }

    public function setUse_mod_firstname($use_mod_firstname) {
	$this->use_mod_firstname = $use_mod_firstname;
    }

    public function getUse_mod_lastname() {
	return $this->use_mod_lastname;
    }

    public function setUse_mod_lastname($use_mod_lastname) {
	$this->use_mod_lastname = $use_mod_lastname;
    }


}

?>
