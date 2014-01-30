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
    private $win_del = 0;
    private $win_prize;
    private $win_notificated;

    /**
     *
     * @var type \User
     */
    private $user;

    /**
     *
     * @var \Event
     */
    private $event;

    /**
     *
     * @var \Series
     */
    private $series;
    
    /**
     *
     * @var \Card
     */
    private $card;

    /**
     * 
     * @return \Series
     */
    public function getSeries() {
        return $this->series;
    }

    public function saveSeries($series) {
        $this->series = $series;
    }

    public function getEvent() {
        return $this->event;
    }

    public function setEvent($event) {
        $this->event = $event;
    }

    /**
     * 
     * @return \User
     */
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

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

    public function getWin_notificated() {
        return $this->win_notificated;
    }

    public function setWin_notificated($win_notificated) {
        $this->win_notificated = $win_notificated;
    }

    public function setSeries(Series $series) {
        $this->series = $series;
    }
    
    public function getCard() {
        return $this->card;
    }

    public function setCard(Card $card) {
        $this->card = $card;
    }


}

?>
