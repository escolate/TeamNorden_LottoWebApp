<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cardDetailView
 *
 * @author tscheurer
 */
class CardShowView extends View {

    /**
     *
     * @var \Cards
     */
    private $card;

    public function display() {
        $this->card = $this->vars['card'];

        echo <<<OUT
         <div class="content-box">
    <h1>Karten-Nr. {$this->card->getCar_serialnumber()}</h1>
    <div class="button-box">
	<a href="/card/edit/{$this->card->getCar_id()}-Cardnr_{$this->card->getCar_serialnumber()}" class="button grey">Bearbeiten</a>
    </div>
    <div class="event-card">
      	<div class="lotto-number">
	    <span>Nr.</span>
	    <span>{$this->card->getCar_serialnumber()}</span>
	</div>
        <div class="card">
        <div> 
        <table>
OUT;
        
        $i = 1;
        for ($j = 1; $j <= 3; $j++) {
            $ten = 10;
            $row = 1;
            echo "<tr>\n";
            while ($i <= 5) {
                while ($this->card->{'getRow'.$j}()->{'getRow_nr'.$i}() >= $ten) {
                    echo "\t<td></td>\n";
                    $ten += 10;
                    $row++;
                }

                echo "\t<td>{$this->card->{'getRow'.$j}()->{'getRow_nr'.$i}()}</td>\n";
                $row++;
                $ten += 10;
                $i++;
            }
            $i = 1;
            while ($row++ < 10) {
                echo "\t<td></td>\n";
            }
            echo "</tr>\n";
        }

        echo <<<OUT
        </table>
        </div>
        </div>
    </div>
	    
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
		<td>Erstellt:</td>
		<td>{$this->card->getCar_cre_dat()}</td>
		</tr>
                <tr>
		<td>Geändert:</td>
		<td>{$this->card->getCar_mod_dat()}</td>
		</tr>
	    </tbody>
	</table>
    </div>
</div>
OUT;
    }

}

?>
