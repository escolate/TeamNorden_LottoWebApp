<?php

class CardView extends View {

    /**
     *
     * @var array\Card
     */
    private $list;

    public function display() {
        $this->list = $this->vars['cards'];
        echo <<<OUT
         <div class="content-box">
    <h1>Karten</h1>
    <div class="button-box">
	<a href="/karte/new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<form name="events" method="post">
	    <table>
		<thead>
                    <tr>
                        <th></th>
                        <th>Kartennr.</th>
                        <th>Reihe 1</th>  
                        <th>Reihe 2</th>  
                        <th>Reihe 3</th>
                        <th>Erstellungsdatum</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		    </tr>
		</tfoot>
		<tbody>
OUT;
        /* @var $card \Cards */
        foreach ($this->list as $card) {
            echo "<tr>\r\n";
            echo '<td><input type="checkbox" name="carid[]" value="' . $card->getCar_id() . '"></td>
                        <td><a href="/karte/' . $card->getCar_id() . '">' . $card->getCar_serialnumber() . '</a></td>';
            $row = 1;
            for ($line = 1; $line < 4; $line++) {
                echo '<td><a href="/karte/' . $card->getCar_id() . '">';
                for ($row = 1; $row < 6; $row++) {
                    if ($row > 1) {
                        echo ',';
                    }
		    echo $card->{'getRow'.$line}()->{'getRow_nr'.$row}();
                }
                echo "</a></td>";
            }

            echo '<td><a href="/karte/' . $card->getCar_id() . '">' . $card->getCar_cre_dat() . '</a></td>';
            echo "</tr>\r\n";
        }
        echo <<<OUT
                </tbody>
	    </table>
	    <select name="action">
		<option value="action">[Aktion]</option>
		<option value="delete">Löschen</option>
	    </select>
	    <input type="submit" value="Ausführen">
	</form>
    </div>
</div>
OUT;
    }

}

?>
