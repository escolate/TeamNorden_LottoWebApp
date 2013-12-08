<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';

/**
 * Description of MysqlAdapter
 *
 * @author tscheurer
 */
final class MysqlAdapter {

    /**
     *
     * @var MysqlAdapter
     */
    private static $MysqlAdapter;

    /**
     *
     * @var mysqli
     */
    private $con;

//put your code here
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

    /**
     * @return User
     */
    public function getUser($id) {
	$query = "SELECT * FROM user WHERE (use_del IS NULL OR use_del = 0) AND use_id = $id";
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    $row = $result->fetch_assoc();
	    $user = new User();
	    $user->setUse_id($row['use_id']);
	    $user->setUse_lastname($row['use_lastname']);
	    $user->setUse_firstname($row['use_firstname']);
	    // comming soon;
	    return $user;
	}
	return null;
    }

    /**
     * 
     * @param type $id
     * @return \Winner|null
     */
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

    /**
     * The param is optional. If param is empty or "[all]" the function return all events back.
     * 
     * @param type $id
     * @return \Event|null
     */
    public function getEvent($id = "[all]") {

	if ($id == "[all]") {
	    $query = "SELECT * FROM event";
	} elseif (is_int($id)) {
	    $query = "SELECT * FROM event WHERE evt_id = $id";
	}
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    $event = new Event();
	    while ($row = $result->fetch_assoc()) {
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
	    }
	    return $event;
	}
	return NULL;
    }

}

?>
