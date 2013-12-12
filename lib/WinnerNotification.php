<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../model/Winner.class.php';
include_once '../model/User.class.php';
include_once './MysqlAdapter.php';
include_once '../config/config.php';
$winner = new Winner();
$winner->setUser(new User());
$winner->getUser()->setUse_email("tobi@example.com");
$not = new WinnerNotification($winner,WinnerNotification::WIN);
$not->send();

/**
 * Description of WinnerNotification
 *
 * @author tscheurer
 */
class WinnerNotification {

    const WIN = 1;
    const PWR = 2;

    /**
     *
     * @var Winner
     */
    private $winner;
    private $type;
    private $param = array();

    //put your code here
    public function __construct(Winner $winner, $type) {
        $this->winner = $winner;
        $this->type = $type;
    }
    
    private function addParam($key,$value) {
        $this->param[$key] = $value;
    }

    private function getWinNotification() {
        $temp = <<<NOTIFICATION
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body style="margin: 0;font-family: 'Segoe UI',sans-serif;">
    <h1 style="background-color: #4679BD;padding:5px; margin: 0px;color: white;">Musikverein Lotto</h1>
    <div style="padding: 10px;">
<h2>Herzlichen Glückwunsch!</h2>
<p>Sie haben an unserem Lottoevent teilgenommen und Gewonnen.</p>

<table style="border-spacing: 15px 0;">
    <tr>
        <td><b>Event:</b></td>
        <td>Biergarten und Lotto (27.10.3013)</td>
    </tr>
    <tr>
        <td><b>Serie:</b></td>
        <td>2</td>
    </tr>
    <tr>
        <td><b>Gewinn:</b></td>
        <td>Badewannenkissen</td>
    </tr>
</table>

<p>Bitte melden sie sich zwecks empfang ihres Preises beim Zakaria Agulif.<br>Tel: 079 000 00 00<br>E-Mail: zaki@lotto.local</p>
<p>Hinweis: Gewinne können nicht zurückgegeben oder in Bargeld umgetauscht werden.</p>
<br>
<p>Freundlich Grüsse<br><br><b>Musikgesellschaft XY</b><br>5400 Baden</p>
</div>
</body>

</html>
NOTIFICATION;

        return $temp;
    }

    /**
     * 
     * @return boolean
     */
    public function send() {
        $empfaenger = $this->winner->getUser()->getUse_email();
        $message = MysqlAdapter::getInstance()->getMessage($this->type);
        if ($empfaenger !== null && $message !== null) {
            $body = $message->getBody();
            //replace params
            foreach ($this->param as $key => $val) {
                $body = str_replace('#'.$key.'#', $val, $body);
            }
            
            $header = 'Content-Type: text/html; charset=UTF-8' . '\r\n'
                    . 'X-Mailer: PHP/' . phpversion();

            //Send Message
            return mail($empfaenger, $message->getSubject(), $body, $header);
        }
        return false;
    }

}

?>