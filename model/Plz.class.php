<?php

class Plz {

private $plz_plz;
private $plz_ort;
private $plz_kanton;
private $plz_land;

public function getPlz_plz() {
    return $this->plz_plz;
}

public function setPlz_plz($plz_plz) {
    $this->plz_plz = $plz_plz;
}

public function getPlz_ort() {
    return $this->plz_ort;
}

public function setPlz_ort($plz_ort) {
    $this->plz_ort = $plz_ort;
}

public function getPlz_kanton() {
    return $this->plz_kanton;
}

public function setPlz_kanton($plz_kanton) {
    $this->plz_kanton = $plz_kanton;
}

public function getPlz_land() {
    return $this->plz_land;
}

public function setPlz_land($plz_land) {
    $this->plz_land = $plz_land;
}


}
?>
