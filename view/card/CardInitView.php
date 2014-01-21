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
     * @var \Card
     */
    private $card;

    public function display() {
        $this->card = $this->vars['card'];

        echo <<<OUT
         <div class="content-box">
    <h1>Karte Nr. {$this->card->getCar_serialnumber()}</h1>

    <div class="event-card">
        <form action="/card" method="post">
        <input type="hidden" name="id" value="{$this->card->getCar_id()}">
        Seriennummer: <input id="csnf" required name="serialnumber" type="number" value="{$this->card->getCar_serialnumber()}">
        <div class="card">
        <div> 
        <table>
OUT;
        $row = 0;
        $cell = 0;
        while ($row++ < 3) {
            echo "<tr>";
            while ($cell++ < 5) {
                echo '<td><input required x-moz-errormessage="Bitte füllen sie Zahlen in alle Felder!" name="row' . $row . 'nr' . $cell . '" type="number" value="' . $this->card->{'getCar_row' . $row . '_nr' . $cell}() . '"></td>';
            }
            echo "</tr>";
            $cell = 0;
        }

        echo "<tr>";
//        $i = 0;
//        $ten = 10;
//        $fieldcount = 0;
//        $items = 0;
//        foreach ($this->card->getRowList() as $val) {
//            while($val >= $ten) {
//                echo "<td></td>";
//                $ten = $ten + 10;
//                $fieldcount++;
//            }
//            
//            echo "<td>".$val."</td>";
//            $items++;
//            $ten = $ten + 10;
//            $fieldcount++;
//            if($i++ > 3 && $items < 15) {
//                echo "</tr><tr>";
//                $i = 0;
//                $ten = 10;
//            }
//        }
//        while($fieldcount++ < 27) {
//                echo "<td></td>";
//                $fieldcount++;
//            }
//        echo "</tr>";

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