<?php

class Messages {

private $mes_id;
private $mes_type;
private $mes_subject;
private $mes_body;
private $mes_sender;
private $mes_status;

public function getMes_id() {
    return $this->mes_id;
}

public function setMes_id($mes_id) {
    $this->mes_id = $mes_id;
}

public function getMes_type() {
    return $this->mes_type;
}

public function setMes_type($mes_type) {
    $this->mes_type = $mes_type;
}

public function getMes_subject() {
    return $this->mes_subject;
}

public function setMes_subject($mes_subject) {
    $this->mes_subject = $mes_subject;
}

public function getMes_body() {
    return $this->mes_body;
}

public function setMes_body($mes_body) {
    $this->mes_body = $mes_body;
}

public function getMes_sender() {
    return $this->mes_sender;
}

public function setMes_sender($mes_sender) {
    $this->mes_sender = $mes_sender;
}

public function getMes_status() {
    return $this->mes_status;
}

public function setMes_status($mes_status) {
    $this->mes_status = $mes_status;
}


}
?>
