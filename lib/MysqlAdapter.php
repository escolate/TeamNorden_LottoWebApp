<?php

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
	include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
	$query = "SELECT * FROM user WHERE (use_del IS NULL OR use_del = 0) AND use_id = $id";
	$result = $this->con->query($query);

	if ($result->num_rows) {
	    $row = $result->fetch_assoc();
	    $user = new User();
	    $user->setUse_id($row['use_id']);
	    $user->setUse_lastname($row['use_lastname']);
	    // comming soon;
	    return $user;
	}
	return null;
    }

    /**
     * 
     * @param type $id
     * @return \Winner
     */
    public function getWinner($id) {
	include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
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

    public function getEvent($id) {
	include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';
	$query = "SELECT * FROM event WHERE evt_id = $id";
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    $row = $result->fetch_assoc();
	    $event = new Event();
	    $event->setEvt_id($row['evt_id']);
	    $event->setEvt_name('evt_name');
	    return $event;
	}
	return NULL;
    }
}

?>
