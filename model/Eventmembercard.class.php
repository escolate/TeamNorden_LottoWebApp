<?php

class Eventmembercard {

    /**
     *
     * @var User
     */
    private $user;

    /**
     *
     * @var Cards
     */
    private $card;

    /**
     *
     * @var Series
     */
    private $series;

    /**
     * 
     * @return \User
     */
    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    /**
     * 
     * @return \Cards
     */
    public function getCard() {
        return $this->card;
    }

    public function setCard(Cards $card) {
        $this->card = $card;
    }

    /**
     * 
     * @return \Series
     */
    public function getSeries() {
        return $this->series;
    }

    public function saveSeries(Series $series) {
        $this->series = $series;
    }

    public function setSeries(Series $series) {
        $this->series = $series;
    }


}

?>
