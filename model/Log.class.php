<?php

class Log {

    const EMERGENCY = 0;
    const ALERT = 1;
    const CRITICAL = 2;
    const ERROR = 3;
    const WARNING = 4;
    const NOTICE = 5;
    const INFORMATIONAL = 6;
    const DEBUG = 7;

    private $log_id;
    private $use_id;
    private $log_action;
    private $log_timestamp;
    private $log_level;
    private $log_ip;

    public function __construct() {
        $this->log_ip = $_SERVER['REMOTE_ADDR'];
        $this->use_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    }

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

    public function getLog_ip() {
        return $this->log_ip;
    }

    public function setLog_ip($log_ip) {
        $this->log_ip = $log_ip;
    }

    public function send() {
        //Send email
        if ($this->getLog_level() <= LOG_NOTIFICATIONLEVEL) {
            $message = "Timestamp: " . date("d.m.Y H:i:s") . PHP_EOL;
            $message .= "Level: {$this->getLevelString()}" . PHP_EOL;
            $message .= "IP-Address: {$this->getLog_ip()}" . PHP_EOL;
            $message .= "Message: {$this->getLog_action()}" . PHP_EOL;

            $headers .= 'Content-type: text/plain; charset=utf-8' . PHP_EOL
                    . 'From: <noreply@' . APP_DOMAIN . '>' . PHP_EOL
                    . 'Sender: <noreply@' . APP_DOMAIN . '>' . PHP_EOL
                    . 'Reply-To: <noreply@' . APP_DOMAIN . '>' . PHP_EOL
                    . 'X-Mailer: PHP ' . phpversion() . PHP_EOL;
            mail(LOG_MAILADDR, "LottoApplication Error", $message, $headers, '-fnoreply@' . APP_DOMAIN);
        }
    }

    private function getLevelString() {
        switch ($this->log_level) {
            case 0:
                return "Emergency";
            case 1:
                return "Alert";
            case 2:
                return "Critical";
            case 3:
                return "Error";
            case 4:
                return "Warning";
            case 5:
                return "Notice";
            case 6:
                return "Informational";
            case 7:
                return "Debug";
        }
    }

}

?>
