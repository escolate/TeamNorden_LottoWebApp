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
     * @var \Card
     */
    private $card;
    
    public function display() {
        $this->card = $this->vars['card'];
        
        echo <<<OUT
         <div class="content-box">
    <h1>Karte Nr. {$this->card->getCar_serialnumber()}</h1>
    <div class="button-box">
	<a href="/card/edit/{$this->card->getCar_id()}-Cardnr_{$this->card->getCar_serialnumber()}" class="button grey">Bearbeiten</a>
    </div>
    <div class="event-card">
        <div class="card">
        <div> 
        <table>
OUT;
        echo "<tr>";
        $i = 0;
        $ten = 10;
        $fieldcount = 0;
        $items = 0;
        foreach ($this->card->getRowList() as $val) {
            while($val >= $ten) {
                echo "<td></td>";
                $ten = $ten + 10;
                $fieldcount++;
            }
            
            echo "<td>".$val."</td>";
            $items++;
            $ten = $ten + 10;
            $fieldcount++;
            if($i++ > 3 && $items < 15) {
                echo "</tr><tr>";
                $i = 0;
                $ten = 10;
            }
        }
        while($fieldcount++ < 27) {
                echo "<td></td>";
                $fieldcount++;
            }
        echo "</tr>";

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
		<td>{$this->vars['create']}</td>
		</tr>
		<td>Geändert:</td>
		<td>{$this->vars['mod']}</td>
		</tr>
	    </tbody>
	</table>
    </div>
</div>
OUT;
    }    
}

?>
