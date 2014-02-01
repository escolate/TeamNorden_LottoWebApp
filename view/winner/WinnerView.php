<?php

class WinnerView extends View {

    public function display() {

        echo <<<HTML
<div class="content-box">
    <h1>Gewinner</h1>
    <div class="list">
	<form name="events" action="" method="post">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    <th>Gewinndatum</th>  
		    <th>E-Mail Bestätigung</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
			<td></td>
			<td></td>
		    </tr>
		</tfoot>
		<tbody>
HTML;

        /* @var $winner \Winner */
        foreach ($this->vars['list'] as $winner) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="win_id[]" value="'.$winner->getWin_id().'"></td>';
            echo "<td><a href=\"/gewinner/{$winner->getWin_id()}\">{$winner->getUser()->getUse_firstname()} {$winner->getUser()->getUse_lastname()}</a></td>";
            echo "<td><a href=\"/gewinner/{$winner->getWin_id()}\">{$winner->getWin_cre_dat()}</a></td>";
            echo "<td><a href=\"/gewinner/{$winner->getWin_id()}\">" . (!is_null($winner->getWin_notificated()) ? $this->getDate($winner->getWin_notificated()) : "Ausstehend") . "</a></td>";
            echo '</tr>';
        }

        echo <<<HTML
		</tbody>
	    </table>
	    <select name="action">
		<option>[Aktion]</option>"
		<option value="cancel">Löschen</option>
	    </select>
	    <input type="submit" value="Ausführen">
	</form>
    </div>
</div>
HTML;
    }

}

?>
