<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';

final class MysqlAdapter{

    private static $MysqlAdapter;
    private $con;

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

    public function getWinnerList($limit = "0,18446744073709551615") {
	$query = "SELECT 
		lotto.winner.*, 
		uc.use_firstname as use_cre_firstname,  
		uc.use_lastname as use_cre_lastname, 
		um.use_firstname as use_mod_firstname, 
		um.use_lastname as use_mod_lastname,
		e.evt_name as win_eventname,
		u.use_firstname as win_firstname,
		u.use_lastname as win_lastname,
		s.ser_id as ser_name
	FROM 
		lotto.winner 
		LEFT JOIN
		lotto.user uc
	ON 
		win_cre_id = uc.use_id 
	LEFT JOIN 
		lotto.user um 
	ON 
		win_mod_id = um.use_id
	LEFT JOIN
		lotto.event e
	on
		eve_id = e.evt_id
	LEFT join
		lotto.user u
	on
		winner.use_id = u.use_id
	LEFT JOIN
		lotto.series s
	on
		winner.ser_id = s.ser_id
	ORDER BY
	    win_cre_dat DESC
	LIMIT
	    $limit;";
	$result = $this->con->query($query);
	$list = array();
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$winner = new Winner();
		$winner->setWin_id($row['win_id']);
		$winner->setWin_notificated($row['win_notificated']);
		$winner->setWin_cre_dat($row['win_cre_dat']);
		$winner->setWin_cre_id($row['win_cre_id']);
		$winner->setWin_del($row['win_del']);
		$winner->setWin_mod_dat($row['win_mod_dat']);
		$winner->setWin_mod_id($row['win_mod_id']);
		$winner->setWin_prize($row['win_prize']);
		$winner->setWin_eventname($row['win_eventname']);
		$winner->setWin_firstname($row['win_firstname']);
		$winner->setWin_lastname($row['win_lastname']);
		$winner->setUse_cre_firstname($row['use_cre_firstname']);
		$winner->setUse_cre_lastname($row['use_cre_lastname']);
		$winner->setUse_mod_firstname($row['use_mod_firstname']);
		$winner->setUse_mod_lastname($row['use_mod_lastname']);
		$list[] = $winner;
	    }
	    return $list;
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

    public function getEventList($limit = "0,18446744073709551615") {  // http://dev.mysql.com/doc/refman/5.0/en/select.html --> SELECT * FROM tbl LIMIT 95,18446744073709551615;
	$query = "SELECT 
		event.*, 
		uc.use_firstname as use_cre_firstname,  
		uc.use_lastname as use_cre_lastname, 
		um.use_firstname as use_mod_firstname, 
		um.use_lastname as use_mod_lastname 
	    FROM 
		lotto.event 
	    LEFT JOIN 
		lotto.user uc
	    ON 
		evt_cre_id = uc.use_id 
	    LEFT JOIN 
		lotto.user um 
	    ON 
		evt_mod_id = um.use_id
	    ORDER BY
		evt_datetime DESC
	    LIMIT
		$limit;";
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
		$event->setUse_cre_firstname($row['use_cre_firstname']);
		$event->setUse_cre_lastname($row['use_cre_lastname']);
		$event->setUse_mod_firstname($row['use_mod_firstname']);
		$event->setUse_mod_lastname($row['use_mod_lastname']);
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

}

?>
