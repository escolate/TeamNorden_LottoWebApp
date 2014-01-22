<?php
class WinnerView extends View {

    public function display() {
    
	echo <<<HTML
<div class="content-box">
    <h1>Gewinner</h1>
    <div class="list">
	<form name="events">
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
	
	    foreach ($this->vars['list'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/winner/{$object->getWin_id()}-\"></a></td>";
		echo "<td><a href=\"/winner/{$object->getWin_id()}-\"></a></td>";
		echo "<td><a href=\"/winner/{$object->getWin_id()}-\">". (!is_null($object->getWin_notificated()) ? $this->getDate($object->getWin_notificated()):"Ausstehend") ."</a></td>";
		echo '</tr>';
	    }
	
	echo <<<HTML
		</tbody>
	    </table>
	    <select name="events-action">
		<option>[Aktion]</option>"
		<option value="delete">Löschen</option>
	    </select>
	    <input type="submit" value="Ausführen">
	</form>
	<div class="pages">
	    Seite
	    <form>
		<select name="events-action">
		    <option value="delete">1</option>
		    <option value="delete">2</option>
		    <option value="delete">3</option>
		    <option value="delete">4</option>
		    <option value="action" selected>5</option>
		    <option value="delete">6</option>
		    <option value="delete">7</option>
		</select>
	    </form>
	    von 7
	</div>
    </div>
</div>
HTML;
    }
}

?>
