<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Message.class.php';

final class MysqlAdapter {

    private static $MysqlAdapter;
    private $con;
    private $limit;

    private function __construct() {
        $this->con = new mysqli(DB_SERVER, DB_USER, DB_PW, DB_DB);
        if ($this->con->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->con->connect_errno . ") " . $this->con->connect_error;
            exit();
        } else {
            $this->con->set_charset("utf8");
        }
    }

    /**
     * 
     * @return MysqlAdapter
     */
    public static function getInstance() {
        if (self::$MysqlAdapter == NULL) {
            self::$MysqlAdapter = new MysqlAdapter();
        }
        return self::$MysqlAdapter;
    }

    public function getUser($query) {
        $result = $this->con->query($query);
        $userList = array();
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $user = new User();
                $user->setUse_id($row['use_id']);
                $user->setUse_lastname($row['use_lastname']);
                $user->setUse_firstname($row['use_firstname']);
                return $userList;
            }
        }
        return null;
    }

    public function getUser_($id) {
        $ide = $this->con->real_escape_string($id);
        $query = "SELECT * FROM lotto.user WHERE use_id = '{$ide}'";
        $result = $this->con->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setUse_id($row['use_id']);
            $user->setUse_lastname($row['use_lastname']);
            $user->setUse_firstname($row['use_firstname']);
            $user->setUse_email($row['use_email']);
            return $user;
        }
        return null;
    }

    public function getWinner($id) {
        $query = "SELECT * FROM winner WHERE win_id = $id";
        $result = $this->con->query($query);

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $winner = new Winner();
            $winner->setUse_id($row['use_id']);

            // comming soon;
            return $winner;
        }
        return NULL;
    }

    public function getEvent($query) {
        $result = $this->con->query($query);
        $eventList = array();
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $event = new Event();
                $event->setEvt_id($row['evt_id']);
                $event->setEvt_name($row['evt_name']);
                $event->setEvt_location($row['evt_location']);
                $event->setEvt_city($row['evt_city']);
                $event->setEvt_cre_dat($row['evt_cre_dat']);
                $event->setEvt_cre_id($row['evt_cre_id']);
                $event->setEvt_datetime($row['evt_datetime']);
                $event->setEvt_del($row['evt_del']);
                $event->setEvt_mod_date($row['evt_mod_date']);
                $event->setEvt_zip($row['evt_zip']);
                $event->setEvt_mod_id($row['evt_mod_id']);
                $eventList[] = $event;
            }
            return $eventList;
        }
        return NULL;
    }

    /**
     * 
     * @param type $email
     * @param type $pw unescaped password
     * @return User
     */
    public function authenticateUser($email, $pw) {
        $pwe = $this->con->real_escape_string($pw);
        $emaile = $this->con->real_escape_string($email);
        $query = "SELECT use_id FROM user WHERE use_email = '{$emaile}' AND use_password = password(concat(use_salt,'{$pwe}'))";
        $result = $this->con->query($query);

        if ($result->num_rows) {
            $row = mysqli_fetch_assoc($result);
            $user = $this->getUser_($row['use_id']);
            $result->free();
            return $user;
        }

        return NULL;
    }

    /**
     * 
     * @param type $type
     * @return \Message|null
     */
    public function getMessage($type) {
        $query = "SELECT * FROM messages WHERE mes_type = {$type} AND mes_status = 1";
        $result = $this->con->query($query);

        if ($result->num_rows) {
            $row = mysqli_fetch_assoc($result);
            $message = new Message();
            $message->setId($row['mes_id']);
            $message->setType($row['mes_type']);
            $message->setSubject($row['mes_subject']);
            $message->setBody($row['mes_body']);
            $message->setSender($row['mes_sender']);
            $result->free();
            return $message;
        }

        return NULL;
    }
}

?>
