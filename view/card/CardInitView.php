<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CardInitView
 *
 * @author tscheurer
 */
class CardInitView extends View {

    /**
     *
     * @var \User
     */
    private $user;

    /**
     *
     * @var \Cards
     */
    private $card;

    public function display() {
        $this->card = $this->vars['card'];

        echo <<<OUT
         <div class="content-box">
    <h1>Karte Nr. {$this->card->getCar_serialnumber()}</h1>

    <div class="event-card">
        <form action="" method="post">
        <input type="hidden" name="id" value="{$this->card->getCar_id()}">
        Karten-Nr. <input id="csnf" required name="serialnumber" type="number" value="{$this->card->getCar_serialnumber()}">
        <div class="card">
        <div> 
        <table>
OUT;
        $row = 0;
        $cell = 0;
        while ($row++ < 3) {
            echo "<tr>";
            while ($cell++ < 5) {
                echo '<td><input required x-moz-errormessage="Bitte füllen sie Zahlen in alle Felder!" name="row' . $row . 'nr' . $cell . '" type="number" value="' . $this->card->{'getRow'.$row}()->{'getRow_nr'.$cell}() . '"></td>';
            }
            echo "</tr>";
            $cell = 0;
        }

        echo "<tr>";

        echo <<<OUT
        </table>
        </div>
        </div>
        <input type="submit" value="speichern" />
        </form>
    </div>
</div>
OUT;
    }

}

?>
