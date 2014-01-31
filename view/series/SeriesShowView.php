<?php

class SeriesShowView extends View {

    private $seriesCounter;
    private $drawCounter;

    public function display() {
	echo '<div class = "content-box">';

	$sTitleCounter = $this->seriesCounter;
	if (!$sTitleCounter) {
	    $sTitleCounter = 1;
	}
	echo "<h1>{$this->vars['event']->getEvt_name()}	    Serie {$this->vars['seriesName']}</h1>";
	if ($this->vars['newestSeries']) {
	    $newestSerId = $this->vars['newestSeries'];
	} else {
	    $newestSerId = "";
	}
	echo <<<HTML
    
    <form action="/veranstaltung/{$this->vars['event']->getEvt_id()}" method="POST">
	<fieldset id="save-number">
	    <legend>Zahl ziehen!</legend>
	    <input type="hidden" value="{$newestSerId}" name="seriesId">
	    <input type="text" placeholder="Zahl" autocomplete="off" name="number">
	    <button name="submit" name="submit" value="saveNumber"> Ziehen! </button>
	</fieldset>
    </form>
    
    <div class="list">
	<form action="/veranstaltung/{$this->vars['event']->getEvt_id()}" method="POST">
	<input type="hidden" value="{$newestSerId}" name="seriesId">
	    <table>
		<thead>
		    <tr>
			<th></th>
			<th>Ziehung</th>
			<th>Gezogene Zahl</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td  id="events">Alle auswählen</td>
			<td></td>
		    </tr>
		</tfoot>
		<tbody>
HTML;
	$drawCounter = $this->drawCounter;
	if ($this->vars['numberList']) {
	    foreach ($this->vars['numberList'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox" name="numberIds[]" value="' . $object->getNum_id() . '"></td>';
		echo "<td>Ziehung $drawCounter</td>";
		echo "<td>{$object->getNum_num()}</td>";
		echo '</tr>';
		$drawCounter--;
	    }
	} else {
	    echo '<tr>';
	    echo '<td></td>';
	    echo "<td>leer</td>";
	    echo "<td>leer</td>";
	    echo '</tr>';
	}
	echo <<<HTML

		</tbody>
	    </table>
	    <select name="submit">
		<option>[Aktion]</option>"
		<option value="deleteNumber">Löschen</option>
	    </select>
	    <button> Ausführen </button>
	    <button name="submit" value="backToEvent"> Zurück </button>
	</form>
    </div>
</div>

HTML;
    }

}

?>
