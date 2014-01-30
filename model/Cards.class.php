<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cards
 *
 * @author tscheurer
 */
class Cards {

    private $car_id;
    private $car_serialnumber;

    /**
     *
     * @var \Rows
     */
    private $row1;

    /**
     *
     * @var \Rows
     */
    private $row2;

    /**
     *
     * @var \Rows
     */
    private $row3;
    private $car_cre_dat;
    private $car_cre_id;
    private $car_mod_dat;
    private $car_mod_id;
    private $car_del;

    public function getCar_id() {
        return $this->car_id;
    }

    public function setCar_id($car_id) {
        $this->car_id = $car_id;
    }

    public function getCar_serialnumber() {
        return $this->car_serialnumber;
    }

    public function setCar_serialnumber($car_serialnumber) {
        $this->car_serialnumber = $car_serialnumber;
    }

    public function getRow1() {
        return $this->row1;
    }

    public function setRow1(\Rows $row1) {
        $this->row1 = $row1;
    }

    public function getRow2() {
        return $this->row2;
    }

    public function setRow2(\Rows $row2) {
        $this->row2 = $row2;
    }

    public function getRow3() {
        return $this->row3;
    }

    public function setRow3(\Rows $row3) {
        $this->row3 = $row3;
    }

    public function getCar_cre_dat() {
        return $this->car_cre_dat;
    }

    public function setCar_cre_dat($car_cre_dat) {
        $this->car_cre_dat = $car_cre_dat;
    }

    public function getCar_cre_id() {
        return $this->car_cre_id;
    }

    public function setCar_cre_id($car_cre_id) {
        $this->car_cre_id = $car_cre_id;
    }

    public function getCar_mod_dat() {
        return $this->car_mod_dat;
    }

    public function setCar_mod_dat($car_mod_dat) {
        $this->car_mod_dat = $car_mod_dat;
    }

    public function getCar_mod_id() {
        return $this->car_mod_id;
    }

    public function setCar_mod_id($car_mod_id) {
        $this->car_mod_id = $car_mod_id;
    }

    public function getCar_del() {
        return $this->car_del;
    }

    public function setCar_del($car_del) {
        $this->car_del = $car_del;
    }

}

?>
