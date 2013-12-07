<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/model/FAQ.php";

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
        }
        else {
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
     * @return array Array of FAQ-Objects
     */
    public function getFAQs() {
        $FAQs = array();
        $query = "SELECT * FROM faqs WHERE state = 'active'";
        $result = $this->con->query($query);
        $result->data_seek(0);
        
        while ($row = $result->fetch_assoc()) {
            $faq = new FAQ();
            $faq->setId($row['id']);
            $faq->setQuestion($row['question']);
            $faq->setAnswer($row['answer']);
            $faq->setState($row['state']);
            $FAQs[] = $faq;
        }
        
        return $FAQs;
        
    }

}

?>
