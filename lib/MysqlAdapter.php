<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Message.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Eventmember.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Series.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Number.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Card.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Cards.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Rows.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Log.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Eventmembercard.class.php';

final class MysqlAdapter {

    /**
     *
     * @var MysqlAdapter
     */
    private static $MysqlAdapter;

    /**
     *
     * @var \mysqli
     */
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

	if (self::$MysqlAdapter == NULL) {
	    self::$MysqlAdapter = new MysqlAdapter();
	}

	return self::$MysqlAdapter;
    }

    public function getCardList($limit = 0) {
	$query = "SELECT * FROM card WHERE car_del IS NULL ORDER BY car_cre_dat DESC";
	if ($limit != 0) {
	    $query .= " LIMIT " . $limit;
	}
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$card = new Card();
		$card->setCar_cre_dat($row['car_cre_dat']);
		$card->setCar_cre_id($row['car_cre_id']);
		$card->setCar_del($row['car_del']);
		$card->setCar_id($row['car_id']);
		$card->setCar_mod_dat($row['car_mod_dat']);
		$card->setCar_mod_id($row['car_mod_id']);
		$card->setCar_row1_nr1($row['car_row1_nr1']);
		$card->setCar_row1_nr2($row['car_row1_nr2']);
		$card->setCar_row1_nr3($row['car_row1_nr3']);
		$card->setCar_row1_nr4($row['car_row1_nr4']);
		$card->setCar_row1_nr5($row['car_row1_nr5']);
		$card->setCar_row2_nr1($row['car_row2_nr1']);
		$card->setCar_row2_nr2($row['car_row2_nr2']);
		$card->setCar_row2_nr3($row['car_row2_nr3']);
		$card->setCar_row2_nr4($row['car_row2_nr4']);
		$card->setCar_row2_nr5($row['car_row2_nr5']);
		$card->setCar_row3_nr1($row['car_row3_nr1']);
		$card->setCar_row3_nr2($row['car_row3_nr2']);
		$card->setCar_row3_nr3($row['car_row3_nr3']);
		$card->setCar_row3_nr4($row['car_row3_nr4']);
		$card->setCar_row3_nr5($row['car_row3_nr5']);
		$card->setCar_serialnumber($row['car_serialnumber']);
		$arr[] = $card;
	    }
	    return $arr;
	}
	return NULL;
    }

    /**
     * 
     * @param type $id
     * @return \User|null
     */
    public function getUser_($id) {
	$user = new User();
	$ide = $this->con->real_escape_string($id);
	$query = "SELECT * FROM user WHERE use_id = '{$ide}'";
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    $row = $result->fetch_assoc();
	    $user->setUse_id($row['use_id']);
	    $user->setUse_lastname($row['use_lastname']);
	    $user->setUse_firstname($row['use_firstname']);
	    $user->setUse_email($row['use_email']);
	    $user->setUse_address($row['use_address']);
	    $user->setUse_zip($row['use_zip']);
	    $user->setUse_city($row['use_city']);
	    $user->setUse_administrator($row['use_administrator']);
	    $user->setUse_birth($row['use_birth']);
	    $user->setUse_phone($row['use_phone']);
	    $user->setUse_mobile($row['use_mobile']);
	    $user->setUse_lastlogin($row['use_lastlogin']);
	    $user->setUse_mod_dat($row['use_mod_dat']);
	    $user->setUse_cre_dat($row['use_cre_dat']);
	    $user->setUse_status($row['use_status']);
	}
	return $user;
    }

// Saves a number in the database
    public function saveNumber($number, $ser_id) {

// Duplicate numbers are not allowed but the user must know if he want do that
	$query = "INSERT INTO numbers (ser_id, num_num, num_cre_dat, num_cre_id, num_mod_dat, num_mod_id) 
            VALUES ('$ser_id', '$number', NOW(), '{$_SESSION['user']['id']}', NOW(), {$_SESSION['user']['id']})";

	return $this->con->query($query);
    }

    // Set the delete flag for numbers
    public function deleteNumber($num_id, $ser_id) {
	$query = "
	    UPDATE 
		numbers 
	    SET 
		num_del = '1',
		num_mod_id = '{$_SESSION['user']['id']}',
		num_mod_dat = NOW()
	    WHERE 
		num_id = '$num_id'
	    AND
		ser_id = '$ser_id';
	";
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	return TRUE;
    }

    // Creates a new series
    public function saveSeries($eve_id) {
//<<<<<<< HEAD
//	$query = "INSERT INTO series (eve_id, ser_cre_dat, ser_cre_id, ser_mod_dat, ser_mod_id) VALUES ('$eve_id', NOW(), {$_SESSION['user']['id']}, NOW(), {$_SESSION['user']['id']});";
//	if (!$this->con->query($query)) {
//	    $this->error($query);
//	    return FALSE;
//	}
//	return mysqli_insert_id($this->con);
//=======
	$query = "INSERT INTO series (eve_id, ser_cre_dat, ser_cre_id, ser_mod_dat, ser_mod_id) VALUES ('$eve_id', NOW(), {$_SESSION['user']['id']}, NOW(), {$_SESSION['user']['id']});";
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	return mysqli_insert_id($this->con);
    }

    // Adds a user to an event
    public function addEventmember($user_id, $event_id) {
	$query = "
	    INSERT INTO 
		eventmembers
	    VALUES 
		('$event_id', '$user_id');
	";
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	return TRUE;
    }

    // Removes a user to an event
    public function removeUser($user_id, $event_id) {
	$query = "
	    DELETE FROM 
		eventmembers 
	    WHERE 
		eve_id='$event_id' 
		    AND 
		use_id='$user_id';
	";
//	exit($query);
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	return TRUE;
    }

    /**
     * 
     * @param User $user
     * @return boolean
     */
    public function saveUser(User $user) {
	$id = $user->getUse_id();
	if (empty($id)) {
//Check if user already exists
	    $q = "SELECT use_id FROM user WHERE use_email = '{$user->getUse_email()}' AND use_del is not true";

	    /* @var $res mysqli_result */
	    $res = $this->con->query($q);

	    if ($res->num_rows) {
		$row = $res->fetch_assoc();
		$user->setUse_id($row['use_id']);
		return false;
	    }

//Insert
	    $query = "INSERT INTO user (
                use_lastname, use_firstname, use_status, use_address, use_zip, use_city, use_birth, use_country, use_phone, use_mobile, use_email, use_administrator, use_salt, use_cre_dat, use_cre_id) 
                VALUES (
                '{$this->con->real_escape_string($user->getUse_lastname())}',
                '{$this->con->real_escape_string($user->getUse_firstname())}',
                '1',
                '{$this->con->real_escape_string($user->getUse_address())}',
                '{$this->con->real_escape_string($user->getUse_zip())}',
                '{$this->con->real_escape_string($user->getUse_city())}',
                nullif('{$this->con->real_escape_string($user->getUse_birth())}',''),
                '{$this->con->real_escape_string($user->getUse_country())}',
                '{$this->con->real_escape_string($user->getUse_phone())}',
                '{$this->con->real_escape_string($user->getUse_mobile())}',
                '{$this->con->real_escape_string($user->getUse_email())}',
                '{$this->con->real_escape_string($user->getUse_administrator())}',
                sha(rand()),
                now(),
                '{$_SESSION['user']['id']}')";
	} else {
//Update
	    $query = "UPDATE user SET 
                use_lastname = '{$this->con->real_escape_string($user->getUse_lastname())}',
                use_firstname = '{$this->con->real_escape_string($user->getUse_firstname())}',
                use_status = '{$this->con->real_escape_string($user->getUse_status())}',
                use_address = '{$this->con->real_escape_string($user->getUse_address())}',
                use_zip = '{$this->con->real_escape_string($user->getUse_zip())}',
                use_city = '{$this->con->real_escape_string($user->getUse_city())}',
                use_birth = nullif('{$this->con->real_escape_string($user->getUse_birth())}',''),
                use_country = '{$this->con->real_escape_string($user->getUse_country())}',
                use_phone = '{$this->con->real_escape_string($user->getUse_phone())}',
                use_mobile = '{$this->con->real_escape_string($user->getUse_mobile())}',
                use_administrator = {$this->con->real_escape_string($user->getUse_administrator())},
                use_mod_id = '{$_SESSION['user']['id']}',
                use_mod_dat = now()
                WHERE use_id = " . $user->getUse_id() . " AND use_del is not true";
	}

//Save
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}

//Assign id to User
	if (empty($id)) {
	    $user->setUse_id($this->con->insert_id);
	}

//Check if PW should be set and do so if is not empty, return false if password could not be set
	$pw = $user->getUse_password();
	if (!empty($pw)) {
	    return $this->setPassword($user->getUse_email(), $pw);
	}

	return true;
    }

    /**
     * 
     * @param type $id UserID
     * @return boolean
     */
    public function deleteUser($id) {
	$query = "UPDATE user SET use_del = true WHERE id = " . $id;
	/* @var $result mysqli_result */
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    return TRUE;
	}
	return FALSE;
    }

    /**
     * 
     * @param type $email E-Mail
     * @param type $pw Password
     * @return boolean
     */
    public function setPassword($email, $pw) {

//<<<<<<< HEAD
	$pwe = $this->con->real_escape_string($pw);
	$emaile = $this->con->real_escape_string($email);
	$query = "UPDATE user SET use_password = password(concat(use_salt,'{$pwe}')) WHERE use_email = '{$emaile}' AND use_del is not true";
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	if (!$this->con->affected_rows) {
	    return FALSE;
	}

	$log = new Log();
	$log->setLog_action("Das Passwort für $emaile wurde geändert.");
	$log->setLog_level(Log::NOTICE);
	$log->send();
	$this->saveLog($log);

	return true;
    }

    /**
     * 
     * @return array\User
     */
    public function getUserList($limit = 0) {

	$arr = array();
	$order = '';
	$lim = '';

	if ($limit) {
	    $order = 'use_cre_dat DESC,';
	    $lim = 'LIMIT ' . $limit;
	}

	$query = "SELECT * FROM user ORDER BY {$order}use_lastname,use_firstname " . $lim;
	$result = $this->con->query($query);

	while ($row = $result->fetch_assoc()) {
	    $user = new User();
	    $user->setUse_id($row['use_id']);
	    $user->setUse_lastname($row['use_lastname']);
	    $user->setUse_firstname($row['use_firstname']);
	    $user->setUse_email($row['use_email']);
	    $user->setUse_address($row['use_address']);
	    $user->setUse_zip($row['use_zip']);
	    $user->setUse_city($row['use_city']);
	    $user->setUse_administrator($row['use_administrator']);
	    $user->setUse_birth($row['use_birth']);
	    $user->setUse_cre_dat($row['use_cre_dat']);
	    $arr[] = $user;
	}
	return $arr;
    }

    public function getWinner($id) {
	$query = "
	SELECT 
	    *
	FROM 
	    winner 
	WHERE
	    win_id = $id;
	";
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    $row = $result->fetch_assoc();

	    $winner = new Winner();
	    $winner->setWin_id($row['win_id']);
	    $winner->setWin_notificated($row['win_notificated']);
	    $winner->setWin_cre_dat($row['win_cre_dat']);
	    $winner->setWin_cre_id($row['win_cre_id']);
	    $winner->setWin_del($row['win_del']);
	    $winner->setWin_mod_dat($row['win_mod_dat']);
	    $winner->setWin_mod_id($row['win_mod_id']);
	    $winner->setWin_prize($row['win_prize']);

	    $winner->setUser($this->getUser_($row['use_id']));
	    $winner->setSeries($this->getSeries($row['ser_id']));
	    $winner->setRow_id($row['row_id']);
	    $winner->setCard($this->getCardsByRowId($row['row_id']));

	    return $winner;
	}
	return NULL;
    }

    private function getCardsByRowId($id) {
	$query = "SELECT car_id FROM cards WHERE row1 = $id OR row2 = $id OR row3 = $id";
	$result = $this->con->query($query);
	if ($result != false) {
	    $row = $result->fetch_assoc();
	    $result->free();
	    return $this->getCards($row['car_id']);
	}
	return new Cards();
    }

    public function getWinnerList($limit = 0) {

	$query = "SELECT * FROM winner WHERE win_del is false ORDER BY win_cre_dat DESC";
	if ($limit != 0) {
	    $query .= " LIMIT " . $limit;
	}

	$result = $this->con->query($query);
	$list = array();
	if ($result) {
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
		$winner->setUser($this->getUser_($row['use_id']));
		$winner->setSeries($this->getSeries($row['ser_id']));
		$list[] = $winner;
	    }
	}
	return $list;
    }

    public function getEvent($id) {
	$query = "
	SELECT 
		*,date_format(evt_datetime,'%d.%m.%Y') as date
	FROM 
		event 
	WHERE 
	    evt_id = $id;";

	$result = $this->con->query($query);
	$event = new Event();
	if ($result) {
	    $row = $result->fetch_assoc();
	    $event->setEvt_id($row['evt_id']);
	    $event->setEvt_name($row['evt_name']);
	    $event->setEvt_location($row['evt_location']);
	    $event->setEvt_city($row['evt_city']);
	    $event->setEvt_cre_dat($row['evt_cre_dat']);
	    $event->setEvt_cre_id($row['evt_cre_id']);
	    $event->setEvt_datetime($row['evt_datetime']);
	    $event->setEvt_del($row['evt_del']);
	    $event->setevt_mod_dat($row['evt_mod_dat']);
	    $event->setEvt_zip($row['evt_zip']);
	    $event->setEvt_mod_id($row['evt_mod_id']);
	    $event->setDate($row['date']);
	}
	return $event;
    }

    /**
     * 
     * @param type $limit
     * @param type $upcoming
     * @return array\Event
     */
    public function getEventList($limit = 0, $upcoming = false) {  // http://dev.mysql.com/doc/refman/5.0/en/select.html --> SELECT * FROM tbl LIMIT 95,18446744073709551615;
	$eventList = array();
	$query = "SELECT *,date_format(evt_datetime,'%d.%m.%Y') as date FROM event WHERE evt_del IS NULL";
	if ($upcoming) {
	    $query .= " AND date(evt_datetime) >= date(now())";
	}
	$query .= " ORDER BY evt_datetime DESC";

	if ($limit) {
	    $query .= ' LIMIT ' . $limit;
	}

	$result = $this->con->query($query);
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
		$event->setevt_mod_dat($row['evt_mod_dat']);
		$event->setEvt_zip($row['evt_zip']);
		$event->setEvt_mod_id($row['evt_mod_id']);
		$event->setDate($row['date']);
		$eventList[] = $event;
	    }
	}
	return $eventList;
    }

    public function getAvailableCards($eventid) {
	$query = "";
    }

    public function getEventmemberList($id, $limit = "0,18446744073709551615") {
	$query = "
	    SELECT 
	     *
	    FROM 
	     eventmembers
	    where 
	     eve_id = $id
	    LIMIT
	     $limit;";

	$result = $this->con->query($query);
	$eventmemberList = array();
	if ($result) {
	    while ($row = $result->fetch_assoc()) {
		$eventmember = new Eventmember();
		$eventmember->setEve_id($row['eve_id']);
		$eventmember->setUse_id($row['use_id']);
		$eventmemberList[] = $eventmember;
	    }
	    return $eventmemberList;
	}
	return NULL;
    }

    public function getSeriesList($id, $limit = "0,18446744073709551615") {
	$query = "
	    SELECT 
		*
	    FROM 
		series 
	    left join 
		event e 
	    on 
		eve_id = e.evt_id
	    WHERE 
		series.eve_id = $id
	    AND
		series.ser_del IS NULL
	    ORDER by
		ser_id
	    DESC
	    LIMIT
		$limit	    
	    ;";
	$result = $this->con->query($query);
	$list = array();
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$series = new Series();
		$series->setSer_id($row['ser_id']);
		$series->setSer_cre_dat($row['ser_cre_dat']);
		$series->setSer_cre_id($row['ser_cre_id']);
		$series->setSer_del($row['ser_del']);
		$series->setSer_id($row['ser_id']);
		$series->setSer_mod_dat($row['ser_mod_dat']);
		$series->setSer_mod_id($row['ser_mod_id']);
		$list[] = $series;
	    }
	    return $list;
	}
	return NULL;
    }

    public function getNewestSeries($id) {
	$query = "
	    SELECT 
		*
	    FROM 
		series 
	    left join 
		event e 
	    on 
		eve_id = e.evt_id
	    WHERE 
		series.eve_id = $id
	    ORDER by
		ser_id
	    DESC
	    LIMIT
		1	    
	    ;";
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$series = new Series();
		$series->setSer_id($row['ser_id']);
		$series->setSer_cre_dat($row['ser_cre_dat']);
		$series->setSer_cre_id($row['ser_cre_id']);
		$series->setSer_del($row['ser_del']);
		$series->setSer_id($row['ser_id']);
		$series->setSer_mod_dat($row['ser_mod_dat']);
		$series->setSer_mod_id($row['ser_mod_id']);
	    }
	    return $series;
	}
	return NULL;
    }

    public function getNumberList($id, $limit = "0,18446744073709551615") {
	$query = "
	    select 
		numbers.* 
	    from 
		numbers 
	    left join 
		series s 
	    on 
		s.ser_id = numbers.ser_id 
	    where 
		    numbers.ser_id = $id
		AND
		    numbers.num_del is null
		OR 
		    numbers.num_del <> 1
	    ORDER BY
		numbers.num_id 
	    DESC
	    LIMIT
		$limit;	    
";
	$result = $this->con->query($query);
	$list = array();
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$number = new Number();
		$number->setNum_cre_dat($row['num_cre_dat']);
		$number->setNum_cre_id($row['num_cre_id']);
		$number->setNum_del($row['num_del']);
		$number->setNum_mod_dat($row['num_mod_dat']);
		$number->setNum_mod_id($row['num_mod_id']);
		$number->setNum_num($row['num_num']);
		$number->setNum_id($row['num_id']);
		$list[] = $number;
	    }
	    return $list;
	}
	return NULL;
    }

    /**
     * 
     * @param type $email
     * @param type $pw unescaped password
     * @return User|null
     */
    public function authenticateUser($email, $pw) {
	$pwe = $this->con->real_escape_string($pw);
	$emaile = $this->con->real_escape_string($email);
	$query = "SELECT use_id FROM user WHERE use_email = '{$emaile}' AND use_password = password(concat(use_salt,'{$pwe}')) AND use_del is not true AND use_administrator is true";
	$result = $this->con->query($query);

	if ($result->num_rows) {
	    $row = mysqli_fetch_assoc($result);
	    $user = $this->getUser_($row['use_id']);
	    $result->free();
	    $query = "UPDATE user SET use_lastlogin = now() WHERE use_email = '{$emaile}' AND use_del is not true";
	    if (!$this->con->query($query)) {
		$this->error($query);
	    }
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

    /**
     * 
     * @param string ZIP
     * @return string Location to ZIP or ''
     */
    public function getLocation($zip) {

	$query = "SELECT plz_ort FROM plz WHERE plz_plz = " . $this->con->real_escape_string($zip);
	$result = $this->con->query($query);


	if ($result->num_rows) {
	    $row = mysqli_fetch_assoc($result);
	    return $row['plz_ort'];
	}

	return "";
    }

    /**
     * 
     * @param type $userid
     * @return array
     */
    public function getUserCards($userid) {

	$arr = array();
	$query = "SELECT date_format(c.evt_datetime,'%d.%m.%Y') date,c.evt_name,b.ser_id,d.car_serialnumber,a.car_id FROM eventmemberscard a

	LEFT JOIN series b ON a.ser_id = b.ser_id
	LEFT JOIN event c ON b.eve_id = c.evt_id
	LEFT JOIN card d ON a.car_id = d.car_id
        WHERE use_id = {$userid} AND date(evt_datetime) >= date(now()) ORDER BY evt_datetime";
	$result = $this->con->query($query);


	while ($row = mysqli_fetch_assoc($result)) {
	    $emc = new Eventmembercard();
	    $emc->setCard($this->getCards($row['car_id']));
	    $emc->saveSeries($this->getSeries($row['ser_id']));

	    $arr[] = $emc;
	}


	return $arr;
    }

    public function getCard($id) {
	$car = new Card();
	$query = "SELECT * FROM card WHERE car_id =  " . $id;
	$result = $this->con->query($query);

	if ($result instanceof mysqli_result && $result->num_rows) {
	    while ($row = mysqli_fetch_assoc($result)) {
		$car->setCar_id($row['car_id']);
		$car->setCar_cre_id($row['car_cre_id']);
		$car->setCar_cre_dat($row['car_cre_dat']);
		$car->setCar_mod_id($row['car_mod_id']);
		$car->setCar_mod_dat($row['car_mod_dat']);
		$car->setCar_serialnumber($row['car_serialnumber']);

		for ($i = 1; $i < 4; $i++) {
		    for ($j = 1; $j < 6; $j++) {
			$car->{'setCar_row' . $i . '_nr' . $j}($row['car_row' . $i . '_nr' . $j]);
		    }
		}
	    }
	}
	return $car;
    }

    public function getCards($id) {
	$car = new Cards();
	$query = "SELECT * FROM cards WHERE car_id =  " . $id;
	$result = $this->con->query($query);

	if ($result != false) {
	    $row = $result->fetch_assoc();
	    $car->setCar_id($row['car_id']);
	    $car->setCar_serialnumber($row['car_serialnumber']);
	    $car->setRow1($this->getRows($row['row1']));
	    $car->setRow2($this->getRows($row['row2']));
	    $car->setRow3($this->getRows($row['row3']));
	    $result->free();
	}

	return $car;
    }

    public function saveCards(\Cards $cards) {
	if ($cards->getCar_id() != '') {
	    $query = "UPDATE cards SET car_serialnumber = '{$cards->getCar_serialnumber()}',row1 = '{$cards->getRow1()->getRow_id()}',row2 = '{$cards->getRow2()->getRow_id()}',row3 = '{$cards->getRow3()->getRow_id()}',car_mod_dat = NOW(), car_mod_id ='{$_SESSION['user']['id']}' WHERE car_id = " . $cards->getCar_id();
	    $this->con->query($query);

	    $this->saveRows($cards->getRow1());
	    $this->saveRows($cards->getRow2());
	    $this->saveRows($cards->getRow3());
	} else {
	    $query = "INSERT INTO cards (car_serialnumber,row1,row2,row3) VALUES ()";
	    $this->con->query($query);

	    $cards->setCar_id($this->con->insert_id);
	    $cards->getRow1()->setCar_id($cards->getCar_id());
	    $cards->getRow2()->setCar_id($cards->getCar_id());
	    $cards->getRow3()->setCar_id($cards->getCar_id());

	    $this->saveRows($cards->getRow1());
	    $this->saveRows($cards->getRow2());
	    $this->saveRows($cards->getRow3());
	}
	return $cards->getCar_id();
    }

    /**
     * 
     * @param type $id
     * @return \Rows
     */
    public function getRows($id) {
	$rows = new Rows();
	$query = "SELECT * FROM rows WHERE row_id =  " . $id;
	$result = $this->con->query($query);
	if ($result != false) {
	    $row = $result->fetch_assoc();
	    $rows->setCar_id($row['car_id']);
	    $rows->setCar_serialnumber($row['car_serialnumber']);
	    $rows->setRow_id($row['row_id']);
	    $rows->setRow_nr($row['row_nr']);
	    $rows->setRow_nr1($row['row_nr1']);
	    $rows->setRow_nr2($row['row_nr2']);
	    $rows->setRow_nr3($row['row_nr3']);
	    $rows->setRow_nr4($row['row_nr4']);
	    $rows->setRow_nr5($row['row_nr5']);
	    $result->free();
	}
	return $rows;
    }

    public function saveRows(\Rows $rows) {
	if ($rows->getRow_id() != '') {
	    $query = "UPDATE rows SET car_id = '{$rows->getCar_id()}', car_serialnumber = '{$rows->getCar_serialnumber()}', row_nr = '{$rows->getRow_nr()}',row_nr1 = '{$rows->getRow_nr1()}', row_nr2 = '{$rows->getRow_nr2()}', row_nr3 = '{$rows->getRow_nr3()}', row_nr4 = '{$rows->getRow_nr4()}', row_nr5 = '{$rows->getRow_nr5()}' WHERE row_id = " . $rows->getRow_id();
	    $this->con->query($query);
	} else {
	    $query = "INSERT INTO rows (car_id, car_serialnumber, row_nr, row_nr1, row_nr2, row_nr3, row_nr4, row_nr5) VALUES
                ('{$rows->getCar_id()}','{$rows->getCar_serialnumber()}',row_nr = '{$rows->getRow_nr()}','{$rows->getRow_nr1()}','{$rows->getRow_nr2()}','{$rows->getRow_nr3()}','{$rows->getRow_nr4()}','{$rows->getRow_nr5()}',)";
	    $this->con->query($query);

	    $rows->setCar_id($this->con->insert_id);
	}
    }

    public function getSeries($id) {
	$ser = new Series();
	$query = "SELECT * FROM series WHERE ser_id = " . $id;
	$result = $this->con->query($query);

	while ($row = mysqli_fetch_assoc($result)) {
	    $ser->setSer_id($row['ser_id']);
	    $ser->setEvent($this->getEvent($row['eve_id']));
	}
	$result->free();
	return $ser;
    }

    /**
     * 
     * @param Eventmembercard $emc
     * @return boolean
     */
    public function deleteUserCard(Eventmembercard $emc) {
	$query = "DELETE FROM eventmemberscard WHERE use_id = '{$emc->getUser()->getUse_id()}' AND car_id = '{$emc->getCard()->getCar_id()}' AND ser_id = '{$emc->getSeries()->getSer_id()}'";
	return $this->con->query($query);
    }

    public function deleteSeries($ser_id) {
	$query = "
	    UPDATE 
		series 
	    SET 
		ser_del = '1',
		ser_mod_id = '{$_SESSION['user']['id']}',
		ser_mod_dat = NOW()
	    WHERE 
		ser_id = '$ser_id';
	";
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	return TRUE;
    }

    /**
     * 
     * @param Eventmembercard $emc
     * @return boolean
     */
    public function saveUserCard(Eventmembercard $emc) {
	$query = "INSERT INTO eventmemberscard VALUES ('{$emc->getUser()->getUse_id()}','{$emc->getCard()->getCar_id()}','{$emc->getSeries()->getSer_id()}')";
	return $this->con->query($query);
    }

    public function getUserWins($userid) {
	$arr = array();
	$query = "SELECT c.evt_datetime,c.evt_name,a.win_prize FROM winner a LEFT JOIN series b ON a.ser_id = b.ser_id LEFT JOIN event c ON b.eve_id = c.evt_id WHERE a.use_id = {$userid} AND a.win_del is false";

	$result = $this->con->query($query);
	if ($result != false) {
	    while ($row = mysqli_fetch_assoc($result)) {
		$info = array();
		$info[] = $row['evt_datetime'];
		$info[] = $row['evt_name'];
		$info[] = $row['win_prize'];
		$arr[] = $info;
	    }
	}

	return $arr;
    }

    public function saveCard(Card $card) {
	if ($card->getCar_id() > 0) {
	    $query = "UPDATE card SET 
                car_serialnumber = {$card->getCar_serialnumber()},
                car_row1_nr1 = {$card->getCar_row1_nr1()},
                car_row1_nr2 = {$card->getCar_row1_nr2()},
                car_row1_nr3 = {$card->getCar_row1_nr3()},
                car_row1_nr4 = {$card->getCar_row1_nr4()},
                car_row1_nr5 = {$card->getCar_row1_nr5()},
                car_row2_nr1 = {$card->getCar_row2_nr1()},
                car_row2_nr2 = {$card->getCar_row2_nr2()},
                car_row2_nr3 = {$card->getCar_row2_nr3()},
                car_row2_nr4 = {$card->getCar_row2_nr4()},
                car_row2_nr5 = {$card->getCar_row2_nr5()},
                car_row3_nr1 = {$card->getCar_row3_nr1()},
                car_row3_nr2 = {$card->getCar_row3_nr2()},
                car_row3_nr3 = {$card->getCar_row3_nr3()},
                car_row3_nr4 = {$card->getCar_row3_nr4()},
                car_row3_nr5 = {$card->getCar_row3_nr5()},
                car_mod_dat = now(),
                car_mod_id = {$_SESSION['user']['id']}
                WHERE car_id = " . $card->getCar_id();
	} else {
	    $query = "INSERT INTO card (
                car_serialnumber,
                car_row1_nr1,
                car_row1_nr2,
                car_row1_nr3,
                car_row1_nr4,
                car_row1_nr5,
                car_row2_nr1,
                car_row2_nr2,
                car_row2_nr3,
                car_row2_nr4,
                car_row2_nr5,
                car_row3_nr1,
                car_row3_nr2,
                car_row3_nr3,
                car_row3_nr4,
                car_row3_nr5,
                car_cre_dat,
                car_cre_id
                ) VALUES (
                {$card->getCar_serialnumber()},
                {$card->getCar_row1_nr1()},
                {$card->getCar_row1_nr2()},
                {$card->getCar_row1_nr3()},
                {$card->getCar_row1_nr4()},
                {$card->getCar_row1_nr5()},
                {$card->getCar_row2_nr1()},
                {$card->getCar_row2_nr2()},
                {$card->getCar_row2_nr3()},
                {$card->getCar_row2_nr4()},
                {$card->getCar_row2_nr5()},
                {$card->getCar_row3_nr1()},
                {$card->getCar_row3_nr2()},
                {$card->getCar_row3_nr3()},
                {$card->getCar_row3_nr4()},
                {$card->getCar_row3_nr5()},
                now(),
                {$_SESSION['user']['id']}
                )";
	}
	$this->con->query($query);
	if ($this->con->insert_id > 0) {
	    return $this->con->insert_id;
	}
	return $card->getCar_id();
    }

    /**
     * Find winner of given series-id
     * @param int $serieid
     * @return array\Eventmembercard
     */
    public function findWinner($serieid) {
	$arr = array();
	$numbers = "";
	$i = 0;

	$query = "SELECT num_num FROM numbers WHERE ser_id = " . $serieid;
	$result = $this->con->query($query);

	if ($result->num_rows >= 5) {
	    while ($row = $result->fetch_assoc()) {
		if ($i++) {
		    $numbers .= ',';
		}
		$numbers .= $row['num_num'];
	    }

	    //NEW
	    $query = "SELECT b.car_id,b.row_id,a.use_id,c.win_id FROM eventmemberscard a JOIN rows b ON a.car_id = b.car_id LEFT JOIN (SELECT * FROM winner WHERE win_del is false) c ON a.ser_id = c.ser_id AND b.row_id = c.row_id


                    WHERE a.ser_id = {$serieid} AND c.win_notificated is null AND
                    (
                        row_nr1 IN ({$numbers}) 
                        AND row_nr2 IN ({$numbers}) 
                        AND row_nr3 IN ({$numbers}) 
                        AND row_nr4 IN ({$numbers}) 
                        AND row_nr5 IN ({$numbers}) 
                    )";
	    $result = $this->con->query($query);

	    //Put winner to arry
	    if ($result != false) {
		$out = array();
		while ($row = $result->fetch_assoc()) {
		    $out[] = $row;
		}
		$result->free();
		return $out;
	    }
	}

	return $arr;
    }

    /**
     * 
     * @param \Log $log
     * @return boolean true on success, false on error
     */
    public function saveLog(Log $log) {

	//Save Message
	$query = "INSERT INTO log (use_id, log_action, log_ip, log_level) VALUES ('{$log->getUse_id()}','{$this->con->escape_string($log->getLog_action())}','{$this->con->escape_string($log->getLog_ip())}',{$log->getLog_level()})";


	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}


	return true;
    }

    /**
     * 
     * @param type $id
     * @return \Log|null
     */
    public function getLog($id) {
	$query = "SELECT * FROM log WHERE log_id = " . $id;
	$result = $this->con->query($query);

	if ($result->num_rows) {
	    $row = mysqli_fetch_assoc($result);
	    $log = new Log();
	    $log->setLog_id($row['log_id']);
	    $log->setUse_id($row['use_id']);
	    $log->setLog_action($row['log_action']);
	    $log->setLog_level($row['log_level']);
	    $log->setLog_timestamp($row['log_timestamp']);
	    $log->setLog_ip($row['log_ip']);

	    return $log;
	}

	return NULL;
    }

    /**
     * 
     * @param int $limit
     * @return array\Log
     */
    public function getLogList($limit = 0) {
	$arr = array();
	$order = '';
	$lim = '';

	if ($limit) {
	    $order = 'ORDER BY log_timestamp DESC';
	    $lim = 'LIMIT ' . $limit;
	}

	$query = "SELECT * FROM log {$order} " . $lim;
	$result = $this->con->query($query);

	if ($result->num_rows) {
	    while ($row = mysqli_fetch_assoc($result)) {
		$log = new Log();
		$log->setLog_id($row['log_id']);
		$log->setUse_id($row['use_id']);
		$log->setLog_action($row['log_action']);
		$log->setLog_level($row['log_level']);
		$log->setLog_timestamp($row['log_timestamp']);
		$log->setLog_ip($row['log_ip']);
		$arr[] = $log;
	    }
	}

	return $arr;
    }

    /**
     * 
     * @return array
     */
    public function getStatusList() {
	$arr = array();
	$result = $this->con->query("SELECT DISTINCT use_status FROM user WHERE use_del is not true AND use_status != ''");
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$arr[] = $row['use_status'];
	    }
	}
	return $arr;
    }

    public function getEventCards($seriesid) {
	$arr = array();

	$query = "SELECT a.car_id,b.use_id FROM card a LEFT JOIN eventmemberscard b ON a.car_id = b.car_id WHERE ser_id is null OR ser_id = " . $seriesid . " ORDER BY car_serialnumber";
	$result = $this->con->query($query);

	if ($result->num_rows) {
	    $series = $this->getSeries($seriesid);
	    while ($row = $result->fetch_assoc()) {
		$emc = new Eventmembercard();
		$emc->saveSeries($series);
		$emc->setCard($this->getCards($row['car_id']));
		if (!empty($row['use_id'])) {
		    $emc->setUser($this->getUser_($row['use_id']));
		}
		$arr[] = $emc;
	    }
	}
	return $arr;
    }

    /**
     * 
     * @param type $eventid
     * @return array \Series
     */
    public function getEventSeries($eventid) {
	$arr = array();
	$query = "SELECT * FROM series WHERE eve_id = {$eventid} ORDER BY ser_id DESC";
	$result = $this->con->query($query);
	if ($result->num_rows) {
	    while ($row = $result->fetch_assoc()) {
		$series = new Series();
		$series->setEvent($this->getEvent($row['eve_id']));
		$series->setSer_id($row['ser_id']);
		$arr[] = $series;
	    }
	}
	return $arr;
    }

    public function deleteCard($carid) {
	$query = "DELETE FROM card WHERE car_id = " . $carid;
	return $this->con->query($query);
    }

    public function addUserCard(Eventmembercard $emc) {
	$query = "INSERT INTO eventmemberscard VALUES ({$emc->getUser()->getUse_id()},{$emc->getCard()->getCar_id()},{$emc->getSeries()->getSer_id()})";
	return $this->con->query($query);
    }

    private function error($query) {
	if (DEBUG) {
	    exit('Error ' . $this->con->errno . ': ' . $this->con->error . '\n<br>' . $query);
	}
    }

    public function saveEvent(Event $event) {
	$query = "
	    INSERT INTO event 
	    (evt_name, evt_location, evt_city, evt_zip, evt_datetime, evt_cre_id, evt_mod_id, evt_cre_dat, evt_mod_dat) 
	    VALUES 
	    ('{$this->con->escape_string($event->getEvt_name())}', '{$this->con->escape_string($event->getEvt_location())}', '{$this->con->escape_string($event->getEvt_city())}', '{$this->con->escape_string($event->getEvt_zip())}', '{$event->getEvt_datetime()}', '{$_SESSION['user']['id']}', '{$_SESSION['user']['id']}', NOW(), NOW());";
	//Save
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	// Write log
	$log = new Log();
	$log->setLog_action("Die Veranstaltung {$event->getEvt_name()} wurde erstellt.");
	$log->setLog_level(Log::NOTICE);
	$log->send();
	$this->saveLog($log);
	// return id 
	$eventId = mysqli_insert_id($this->con);
	return $eventId;
    }

    // Delete event
    public function deleteEvent($evt_id) {
	$query = "UPDATE event SET evt_del='1' WHERE evt_id='$evt_id';";
	//Save
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	// Write log
	$log = new Log();
	$log->setLog_action("Die Veranstaltung ".$this->getEvent($evt_id)->getEvt_name()." wurde gelöscht.");
	$log->setLog_level(Log::WARNING);
	$log->send();
	$this->saveLog($log);
	return TRUE;
    }

    /**
     * Set current eventusercards to new Series
     * @param type $seriesid NEUE SerienID
     * @return boolean
     */
    public function recycleCards($seriesid) {
	//Letzte gespielte Serie
	$query = "SELECT ser_id FROM series WHERE eve_id = (SELECT eve_id FROM series WHERE ser_id = {$seriesid}) AND ser_id != {$seriesid} ORDER BY ser_id DESC LIMIT 1";
	$result = $this->con->query($query);

	/* @var $result \mysqli_result */
	if ($result !== false) {
	    $row = $result->fetch_assoc();
	    //Letzte Serie duplizieren
	    $query = "INSERT INTO eventmemberscard (SELECT use_id,car_id,{$seriesid} FROM eventmemberscard WHERE ser_id = {$row['ser_id']})";
	    $result->free();
	    return $this->con->query($query);
	}
	return false;
    }

    /**
     * 
     * @param type $seriesid
     * @return \Eventmembercard
     */
    public function getPlayingUsers($seriesid) {
	$arr = array();
	$query = "SELECT * FROM eventmemberscard WHERE ser_id = {$seriesid}";
	$result = $this->con->query($query);
	if ($result !== false) {
	    while ($row = $result->fetch_assoc()) {
		$emc = new Eventmembercard();
		$emc->setCard($this->getCards($row['car_id']));
		$emc->setUser($this->getUser_($row['use_id']));
		$arr[] = $emc;
	    }
	}
	return $arr;
    }

    /**
     * 
     * @return \Eventmembercard|boolean
     */
    public function getEventMemberCard($car_id, $ser_id) {
	$emc = new Eventmembercard();
	$query = "SELECT * FROM lotto.eventmemberscard WHERE ser_id = {$ser_id} AND car_id = {$car_id}";
	$result = $this->con->query($query);
	if ($result !== false) {
	    $row = $result->fetch_assoc();
	    $emc->setCard($this->getCards($row['car_id']));
	    $emc->setUser($this->getUser_($row['use_id']));
	    $emc->setSeries($this->getSeries($row['ser_id']));
	    return $emc;
	}
	return false;
    }

    public function saveWinner(Winner $winner) {
	$id = $winner->getWin_id();
	if (isset($id)) {
	    //update
	    $query = "UPDATE winner SET
                use_id = {$winner->getUser()->getUse_id()} ,ser_id = {$winner->getSeries()->getSer_id()} ,win_mod_dat = now(), row_id = {$winner->getRow_id()}
                ,win_mod_id = {$_SESSION['user']['id']} ,win_del = '{$winner->getWin_del()}' ,win_prize = '{$this->con->real_escape_string($winner->getWin_prize())}' ,win_notificated = NULLIF('{$winner->getWin_notificated()}','')
                WHERE win_id = {$winner->getWin_id()}";
	} else {
	    //insert
	    $query = "INSERT INTO winner (use_id,ser_id,win_cre_dat,win_cre_id,win_prize,row_id) 
                VALUES ({$winner->getUser()->getUse_id()},{$winner->getSeries()->getSer_id()},now(),{$_SESSION['user']['id']},'{$this->con->real_escape_string($winner->getWin_prize())}',{$winner->getRow_id()})";
	}

	if ($this->con->query($query)) {
	    if (!isset($id)) {
		$winner->setWin_id($this->con->insert_id);
	    }
	    return true;
	}

	return FALSE;
    }

    public function setWinnerNotification($win_id) {
	$query = "UPDATE winner SET win_notificated = now() WHERE win_id = " . $win_id;
	return $this->con->query($query);
    }

    public function updateEvent(Event $event) {
	$query = "
	    UPDATE lotto.event 
	    SET evt_name='{$this->con->escape_string($event->getEvt_name())}', evt_location='{$this->con->escape_string($event->getEvt_location())}', evt_city='{$this->con->escape_string($event->getEvt_city())}', evt_zip='{$this->con->escape_string($event->getEvt_zip())}', evt_datetime='{$event->getEvt_datetime()}', evt_mod_dat= NOW() , evt_mod_id='{$_SESSION['user']['id']}' 
	    WHERE evt_id='{$event->getEvt_id()}';
	";
	//Save
	if (!$this->con->query($query)) {
	    $this->error($query);
	    return FALSE;
	}
	// return id
	$eventId = mysqli_insert_id($this->con);
	return $eventId;
    }

}

?>
