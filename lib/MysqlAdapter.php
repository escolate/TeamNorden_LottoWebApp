<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Lotto.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Winner.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Event.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Message.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Eventmembers.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/Series.class.php';

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

// WERDEN GLAUBE ICH NICHT GEBRAUCHT
//    public function getUser($query) {
//	$result = $this->con->query($query);
//	$userList = array();
//	if ($result->num_rows) {
//	    while ($row = $result->fetch_assoc()) {
//		$user = new User();
//		$user->setUse_id($row['use_id']);
//		$user->setUse_lastname($row['use_lastname']);
//		$user->setUse_firstname($row['use_firstname']);
//		return $userList;
//	    }
//	}
//	return null;
//    }

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
                '{$this->con->real_escape_string($user->getUse_birth())}',
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
                use_birth = '{$this->con->real_escape_string($user->getUse_birth())}',
                use_country = '{$this->con->real_escape_string($user->getUse_country())}',
                use_phone = '{$this->con->real_escape_string($user->getUse_phone())}',
                use_mobile = '{$this->con->real_escape_string($user->getUse_mobile())}',
                use_administrator = {$this->con->real_escape_string($user->getUse_administrator())},
                use_mod_id = '{$_SESSION['user']['id']}'
                WHERE use_id = ".$user->getUse_id()." AND use_del is not true";
        }

        //Save
        if (!$this->con->query($query)) {
            $this->error($query);
            return FALSE;
        }
        
        //Assign id to User
        if(empty($id)) {
            $user->setUse_id($this->con->insert_id);
        }

        //Check if PW should be set and do so if is not empty, return false if password could not be set
        $pw = $user->getUse_password();
        if (!empty($pw)) {
            return $this->setPassword($user->getUse_email(), $user->getUse_password());
        }

        return true;
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

// WERDEN GLAUBE ICH NICHT GEBRAUCHT
//    public function getWinner($id) {
//	$query = "SELECT * FROM winner WHERE win_id = $id";
//	$result = $this->con->query($query);
//	if ($result->num_rows) {
//	    $row = $result->fetch_assoc();
//	    $winner = new Winner();
//	    $winner->setUse_id($row['use_id']);
//	    // comming soon;
//	    return $winner;
//	}
//	return NULL;
//    }

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

    public function getEvent($id) {
        $query = "
	SELECT 
		event.*, 
		uc.use_firstname as use_cre_firstname,  
		uc.use_lastname as use_cre_lastname, 
		um.use_firstname as use_mod_firstname, 
		um.use_lastname as use_mod_lastname
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
            $event->setUse_cre_firstname($row['use_cre_firstname']);
            $event->setUse_cre_lastname($row['use_cre_lastname']);
            $event->setUse_mod_firstname($row['use_mod_firstname']);
            $event->setUse_mod_lastname($row['use_mod_lastname']);
            return $event;
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

    public function getEventmemberList($id, $limit = "0,18446744073709551615") {
        $query = "
	    SELECT 
	     eventmembers.*, 
	     u.use_firstname, 
	     u.use_lastname 
	    FROM 
	     lotto.eventmembers 
	    LEFT 
	     join lotto.user u 
	    on 
	     eventmembers.use_id = u.use_id 
	    where 
	     eventmembers.eve_id = $id
	    LIMIT
	     $limit;";
        $result = $this->con->query($query);
        $list = array();
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $eventmembers = new Eventmembers();
                $eventmembers->setEve_id($row['eve_id']);
                $eventmembers->setUse_firstname($row['use_firstname']);
                $eventmembers->setUse_id($row['use_id']);
                $eventmembers->setUse_lastname($row['use_lastname']);
                $list[] = $eventmembers;
            }
            return $list;
        }
        return NULL;
    }

    public function getSeriesList($id, $limit = "0,18446744073709551615") { // like = '%' returns all
        $query = "
	    SELECT 
		series.*, 
		e.evt_name as ser_evt_name,
		uc.use_firstname as use_cre_firstname,  
		uc.use_lastname as use_cre_lastname, 
		um.use_firstname as use_mod_firstname, 
		um.use_lastname as use_mod_lastname 
	    FROM 
		series 
	    left join 
		lotto.event e 
	    on 
		eve_id = e.evt_id
	    LEFT JOIN 
		lotto.user uc
	    ON 
		ser_cre_id = uc.use_id 
	    LEFT JOIN 
		lotto.user um 
	    ON 
		ser_mod_id = um.use_id
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
                $series->setSer_evt_name($row['ser_evt_name']);
                $series->setSer_id($row['ser_id']);
                $series->setSer_mod_dat($row['ser_mod_dat']);
                $series->setSer_mod_id($row['ser_mod_id']);
                $series->setUse_cre_firstname($row['use_cre_firstname']);
                $series->setUse_cre_lastname($row['use_cre_lastname']);
                $series->setUse_mod_firstname($row['use_mod_firstname']);
                $series->setUse_mod_lastname($row['use_mod_lastname']);
                $list[] = $series;
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
