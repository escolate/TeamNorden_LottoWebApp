<?php


class EventmemberscardView extends View{
    public function display() {
	echo <<<OUT
         <div class="content-box">
    <h1>Spielerkarten</h1>
    <div class="event-card">
    <table class="show-table">
	    <tbody>
		<tr>
		<td>Spieler:</td>
		<td>Zakaria Agoulif</td>
		</tr>
		<tr>
		<td>Event:</td>
		<td>Lotto Spass für die ganze Familie</td>
		</tr>
	    </tbody>
	</table>
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
                        <th>Gültigkeitsbereich</th>
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
		    <tr>
			<td><input type="checkbox"></td>
			<td>102</td>
			<td>1,2,3,4,5</td>
			<td>1,2,3,4,5</td>
			<td>1,2,3,4,5</td>
			<td>Für alle Serien!</td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td>130</td>
			<td>1,2,3,4,5</td>
			<td>1,2,3,4,5</td>
			<td>1,2,3,4,5</td>
			<td>Serie: 1, 2, 5</td>
		    </tr>
                </tbody>
	    </table>
	    <select name="action">
		<option value="action">[Aktion]</option>
		<option value="delete">Bearbeiten</option>
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
