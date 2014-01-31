<?php

class WinnerShowView extends View {

    /**
     *
     * @var \Winner
     */
    private $winner;
    /**
     *
     * @var \Cards
     */
    private $card;

    public function display() {
       
	// Set member
	$this->winner = $this->vars['winner'];
	$this->card = $this->vars['card'];
	$credate = new DateTime($this->winner->getWin_cre_dat());

	// Get winner status confirmation text
	if ($this->winner->getWin_notificated() != '') {
	    $confirmation = new DateTime($this->winner->getWin_notificated());
	    $confirmationtext = $confirmation->format('d.m.Y H:i');
	} else {
	    $confirmationtext = "pendent";
	}




	echo <<<HTML
        <div class="content-box">
    <h1>Gewinn</h1>
    <div class="event-card">

    <table class="show-table">
	    <tbody>
		<tr>
		<td>Gewinner:</td>
		<td>{$this->winner->getUser()->getUse_firstname()} {$this->winner->getUser()->getUse_lastname()}</td>
		</tr>
		<tr>
		<td>Event:</td>
		<td>{$this->winner->getSeries()->getEvent()->getEvt_name()}</td>
		</tr>
		<tr>
		<td>Serie:</td>
		<td>{$this->winner->getSeries()->getSer_id()}</td>
		</tr>
		<tr>
		<td>Datum und Zeit:</td>
		<td>{$credate->format('d.m.Y H:i')}</td>
		</tr>
		<tr>
		<td>Gezogene Zahlen:</td>
		<td>
HTML;

	// Put card-numbers in array
	$numbersOfCard = array();
	for ($j = 1; $j <= 3; $j++) {
	    for ($i2 = 1; $i2 <= 5; $i2++){
		 $numbersOfCard[] = $this->card->{'getRow' . $j}()->{'getRow_nr' . $i2}();
	    }
	}
	// Check if winning number
	$y = 7; // How many balls per line should be displayed
	$i3 = $y;
	$numbersOfSeries = array();
	foreach ($this->vars['numberList'] as $object) {
	    $class = "ball";
	    if(in_array($object->getNum_num(), $numbersOfCard)){
		$class = "ball winning";
	    }
	    echo "<div class=\"{$class}\">";
	    echo $object->getNum_num();
	    echo '</div>' . "\n";
	    $i3--;
	    if (!$i3) {
		echo '<br>';
		$i3 = $y;
	    }
	    $numbersOfSeries[] = $object->getNum_num();
	}
	echo <<<HTML
		</td>
		</tr>
	    </tbody>
	</table>
    </div>


<div class="event-card">
  	<div class="lotto-number">
	    <span>Nr.</span>
	    <span>{$this->winner->getCard()->getCar_serialnumber()}</span>
	</div>
  <div class="card">
    <div> 
        <table>
HTML;
	$i = 1;
	for ($j = 1; $j <= 3; $j++) {
	    $ten = 10;
	    $row = 1;
	    echo "<tr>";
	    while ($i <= 5) {
		while ($this->card->{'getRow' . $j}()->{'getRow_nr' . $i}() >= $ten) {
		    echo "<td></td>";
		    $ten += 10;
		    $row++;
		}
		$class = "";
		if(in_array($this->card->{'getRow' . $j}()->{'getRow_nr' . $i}(), $numbersOfSeries)){
		    $class = "yellow";
		}
		echo "<td class=\"{$class}\">{$this->card->{'getRow' . $j}()->{'getRow_nr' . $i}()}</td>";
		$row++;
		$ten += 10;
		$i++;
	    }
	    $i = 1;
	    while ($row++ < 10) {
		echo "<td></td>";
	    }
	    echo "</tr>";
	}

	echo <<<HTML

	</table>
      </div>
    </div>
</div>
	
    <div class="event-card">
    <form method="post" action="">
    <table class="show-table">
     <tbody>
	<tr>
	 <td>Gewinn:</td>
	 <td><input required type="text" name="win_prize" value="{$this->winner->getWin_prize()}" autofocus ></td>
	</tr>
	<tr>
	<td>Bestätigung:</td>
	<td>{$confirmationtext}</td>
	</tr>
     </tbody>	
    </table>
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="win_id" value="{$this->winner->getWin_id()}">
            <input type="submit" value="Bestätigen (E-Mail!)">
            <input type="hidden" name="action" value="cancel">
            <input type="hidden" name="win_id" value="{$this->winner->getWin_id()}">
            <input type="submit" value="Stornieren">
        </form>
    </div>
</div>
HTML;
    }

}

?>
