<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Message.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Eventmember.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Series.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Number.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Card.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Log.class.php';

final class MysqlAdapter {

    /**
     *
     * @var MysqlAdapter
     */
    private static $MysqlAdapter;
    private $con;
    private $limit = 0;
    private $count = 0;
    private $order = '';

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
        self::$MysqlAdapter->setLimit('');
        self::$MysqlAdapter->setCount('');
        self::$MysqlAdapter->setOrder('');

        return self::$MysqlAdapter;

    }

    public function getCardList($limit = "0,18446744073709551615") {
        $query = "
	    SELECT 
		* 
	    FROM 
		card 
	    WHERE 
		car_del 
	    IS NULL ORDER BY 
		car_cre_dat 
	    DESC LIMIT 
		$limit;
";
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
            return $user;
        }
        return null;
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
                use_mod_id = '{$_SESSION['user']['id']}'
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
        $log->setLog_action("Das Passwort für $emaile würde geändert.");
        $log->setLog_level(Log::NOTICE);
        $log->send();
        $this->saveLog($log);
        
        return true;

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
	    $user->setUse_address($row['use_address']);
	    $user->setUse_zip($row['use_zip']);
	    $user->setUse_city($row['use_city']);
	    $user->setUse_administrator($row['use_administrator']);
	    $user->setUse_birth($row['use_birth']);
	    $user->setUse_phone($row['use_phone']);
	    $user->setUse_mobile($row['use_mobile']);
	    $user->setUse_status($row['use_status']);
	    return $user;
	}
	return null;

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
//=======
//	$arr = array();
//	$order = '';
//	$lim = '';
//
//	if ($limit) {
//	    $order = 'use_cre_dat DESC,';
//	    $lim = 'LIMIT ' . $limit;
//	}
//
//	$query = "SELECT * FROM user ORDER BY {$order}use_lastname,use_firstname " . $lim;
//	$result = $this->con->query($query);
//
//	while ($row = $result->fetch_assoc()) {
//	    $user = new User();
//	    $user->setUse_id($row['use_id']);
//	    $user->setUse_lastname($row['use_lastname']);
//	    $user->setUse_firstname($row['use_firstname']);
//	    $user->setUse_email($row['use_email']);
//	    $user->setUse_address($row['use_address']);
//	    $user->setUse_zip($row['use_zip']);
//	    $user->setUse_city($row['use_city']);
//	    $user->setUse_administrator($row['use_administrator']);
//	    $user->setUse_birth($row['use_birth']);
//	    $user->setUse_cre_dat($row['use_cre_dat']);
//	    $arr[] = $user;
//	}
//	return $arr;
//>>>>>>> zaki2
    }

    public function getWinner($id) {
        $query = "
	SELECT 
	    *
	FROM 
	    lotto.winner 
	WHERE
	    win_id = $id;
	";
	$result = $this->con->query($query);
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
	    }
	    return $winner;
	}
	return NULL;

    }

    public function getWinnerList($limit = "0,18446744073709551615") {
        $query = "
	SELECT 
		winner.*,
		e.evt_name,
		u.use_firstname,
		u.use_lastname,
		s.ser_id
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
	    $limit;
	";

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
                $list[] = $winner;
            }
            return $list;
        }
        return NULL;

    }

    public function getEvent($id) {
        $query = "
	SELECT 
		event.*,
		uc.use_firstname,
		uc.use_lastname,
		um.use_firstname,
		um.use_lastname
	FROM 
		event 
	LEFT JOIN
		lotto.user uc
	ON 
		evt_cre_id = uc.use_id 
	LEFT JOIN 
		lotto.user um 
	ON 
		evt_mod_id = um.use_id
	WHERE evt_id = $id;";

        $result = $this->con->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
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
            return $event;
        }
        return NULL;
    }

    public function getEventList($limit = "0,18446744073709551615") {  // http://dev.mysql.com/doc/refman/5.0/en/select.html --> SELECT * FROM tbl LIMIT 95,18446744073709551615;

	$query = "SELECT 
		*
	    FROM 
		event
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
                $eventList[] = $event;
            }
            return $eventList;
        }
        return NULL;
    }

    public function getEventmemberList($id, $limit = "0,18446744073709551615") {
        $query = "
	    SELECT 
	     *
	    FROM 
	     eventmember
	    where 
	     eve_id = $id
	    LIMIT
	     $limit;";
//<<<<<<< HEAD
//        $result = $this->con->query($query);
//        $list = array();
//        if ($result->num_rows) {
//            while ($row = $result->fetch_assoc()) {
//                $eventmembers = new Eventmembers();
//                $eventmembers->setEve_id($row['eve_id']);
//                $eventmembers->setUse_id($row['use_id']);
//                $list[] = $eventmembers;
//            }
//            return $list;
//        }
//        return NULL;
//=======
	$result = $this->con->query($query);
	$eventmemberList = array();
	if ($result->num_rows) {
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
		lotto.event e 
	    on 
		eve_id = e.evt_id
	    WHERE 
		series.eve_id = $id
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
		lotto.event e 
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
		number.* 
	    from 
		number 
	    left join 
		series s 
	    on 
		s.ser_id = number.ser_id 
	    where 
		number.ser_id = $id
	    ORDER BY
		number.num_id 
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
        $query = "SELECT plz_ort FROM lotto.plz WHERE plz_plz = " . $this->con->real_escape_string($zip);
        $result = $this->con->query($query);

        if ($result->num_rows) {
            $row = mysqli_fetch_assoc($result);
            return $row['plz_ort'];
        }

        return "";
    }

    /**
     * 
     * @param \Log $log
     * @return boolean true on success, false on error
     */
    public function saveLog(Log $log) {
        //Save Message
        $query = "INSERT INTO log (use_id, log_action, log_ip, log_level) VALUES ('{$log->getUse_id()}','{$log->getLog_action()}','{$log->getLog_ip()}',{$log->getLog_level()})";
        
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
        $query = "SELECT * FROM lotto.log WHERE log_id = " . $id;
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

        $query = "SELECT * FROM lotto.log {$order} " . $lim;
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
        $result = $this->con->query("SELECT DISTINCT use_status FROM lotto.user WHERE use_del is not true AND use_status != ''");
        if($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row['use_status'];
            }
        }
        return $arr;
    }

    public function setLimit($limit) {
	$this->limit = $limit;
    }

    public function setCount($count) {
	$this->count = $count;
    }

    public function setOrder($order) {
	$this->order = $order;
    }


    private function error($query) {
        if (DEBUG) {
            exit('Error ' . $this->con->errno . ': ' . $this->con->error . '\n<br>' . $query);
        }
    }


}

?>
