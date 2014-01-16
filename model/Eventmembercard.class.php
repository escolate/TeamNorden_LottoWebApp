<?php

class Eventmembercard {

    /**
     *
     * @var User
     */
    private $user;

    /**
     *
     * @var Card
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
     * @return \Card
     */
    public function getCard() {
        return $this->card;
    }

    public function setCard(Card $card) {
        $this->card = $card;
    }

    /**
     * 
     * @return \Series
     */
    public function getSeries() {
        return $this->series;
    }

    public function setSeries(Series $series) {
        $this->series = $series;
    }

}

?>
