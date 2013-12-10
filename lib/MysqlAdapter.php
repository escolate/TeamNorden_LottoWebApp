<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';


final class MysqlAdapter {


    private static $MysqlAdapter;


    private $con;
    private $limit;

    private function __construct() {
	$this->con = new mysqli(DB_SERVER, DB_USER, DB_PW, DB_DB);
	if ($this->con->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $this->con->connect_errno . ") " . $this->con->connect_error;
	} else {
	    $this->con->set_charset("utf8");
	}
    }

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

}

?>
