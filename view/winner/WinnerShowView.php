<?php

class WinnerShowView extends View {

    /**
     *
     * @var \Winner
     */
    private $winner;

    public function display() {
        $this->winner = $this->vars['winner'];

        $credate = new DateTime($this->winner->getWin_cre_dat());

        if ($this->winner->getWin_notificated() != '') {
            $confirmation = new DateTime($this->winner->getWin_notificated());
            $confirmationtext = $confirmation->format('d.m.Y H.i');
        } else {
            $confirmationtext = "pendent";
        }

        echo <<<HTML
        <div class="content-box">
    <h1>Gewinn</h1>
    <div class="event-card">
        <form method="post" action="">
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
		<td>{$credate->format('d.m.Y H.i')}</td>
		</tr>
                <tr>
		<td>Bestätigung:</td>
		<td>{$confirmationtext}</td>
		</tr>
                <tr>
                    <td>Gewinn:</td>
                    <td><input required type="text" name="win_prize" value="{$this->winner->getWin_prize()}"></td>
                </tr>
		<tr>
		<td>Gezogene Zahlen:</td>
		<td>\n
HTML;
        $y = 7; // How many balls per line
        $i = $y;
        foreach ($this->vars['numberList'] as $object) {
            echo "\t\t".'<div class="ball winning">';
            echo $object->getNum_num();
            echo '</div>'."\n";
            $i--;
            if (!$i) {
                echo '<br>';
                $i = $y;
            }
        }
        echo <<<HTML
		</td>
		</tr>
	    </tbody>
	</table>
    </div>

    <div class="lotto-card">
	<div class="lotto-number">
	    <span>Nr.</span>
	    <span>{$this->winner->getCard()->getCar_serialnumber()}</span>
	</div>
	
HTML;
        $numarr = array();
        foreach ($this->vars['numberList'] as $num) {
            $numarr[] = $num->getNum_num();
        }


        $card = $this->winner->getCard();
        for ($i = 1; $i <= 3; $i++) {
            echo '<div class="lotto-row">
	    <span>Reihe ' . $i . '</span>';
            for ($j = 1; $j <= 5; $j++) {
//                $nr = $card->{'getCar_row' . $i . '_nr' . $j}();
                $nr = $card->{'getRow'.$i}()->{'getRow_nr'.$j}();
                if (in_array($nr, $numarr)) {
                    echo '<span class="num winning">' . $nr . '</span>';
                } else {
                    echo '<span class="num">' . $nr . '</span>';
                }
            }
            echo '</div>';
        }

        echo <<<HTML
    </div>
    <div class="event-card">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="win_id" value="{$this->winner->getWin_id()}">
            <input type="submit" value="speichern">
        </form>
        <form method="post" action="">
            <input type="hidden" name="action" value="cancel">
            <input type="hidden" name="win_id" value="{$this->winner->getWin_id()}">
            <input type="submit" value="stornieren">
        </form>
    </div>
</div>
HTML;
    }

}

?>
