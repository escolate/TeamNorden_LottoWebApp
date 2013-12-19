<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WinnerNotification
 *
 * @author tscheurer
 */
class EmailNotification {

    const WIN = 1;
    const PWR = 2;
    private $email;
    
    /**
     *
     * @var Message
     */
    private $message;
    private $type;
    private $body;
    private $isComposed = false;
    private $param = array();

    //put your code here
    public function __construct($email, $type) {
        $this->email = $email;
        $this->type = $type;
        $this->message = MysqlAdapter::getInstance()->getMessage($this->type);
    }

    public function addParam($key, $value) {
        $this->param[$key] = $value;
    }

    public function getMessage() {
        return $this->body;
    }
    
    public function validate() {
        return preg_match('/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]+$/', $this->email);
    }

    public function compose() {
        $this->body = '<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body style="margin: 0;font-family: \'Segoe UI\',sans-serif;">
        <h1 style="background-color: #4679BD;padding:5px; margin: 0px;color: white;">'.MAIL_TITLE.'</h1>
        <div style="padding: 10px;">
            '.$this->message->getBody().'
            <br><br>
            <p>Freundlich Gr&uuml;sse<br>
            <br>
            <b>'.MAIL_ORGANIZATION.'</b><br>
            '.MAIL_ADDRESS.'<br>
            '.MAIL_CITY.'</p>
        </div>
    </body>
</html>';
        $this->isComposed = true;
    }

    /**
     * Send the composed message
     * @return boolean
     */
    public function send() {
        if(!$this->isComposed) {
            $this->compose();
        }
        
        if (!empty($this->email) && !empty($this->body) && $this->validate()) {
            //replace params
            foreach ($this->param as $key => $val) {
                $this->body = str_replace('#' . $key . '#', $val, $this->body);
            }

            //Set SMTP Headers
            $header = 'Content-type: text/html; charset=utf-8' . "\n"
                    . 'X-Mailer: PHP ' . phpversion();

            //Send Message
            return mail($this->email, $this->message->getSubject(), $this->body, $header);
        }
        return false;
    }

}

?>
