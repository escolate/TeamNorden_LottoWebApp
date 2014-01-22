<?php

class SeriesShowView extends View {
    private $seriesCounter;
    private $drawCounter;
    
    public function display() {
	// Counts the series
	$this->seriesCounter = count($this->vars['seriesList']);
	// Counts the numbers
	$this->drawCounter = count($this->vars['numberList']);
	echo $this->seriesCounter;
	echo '<div class = "content-box">';
	$sTitleCounter = $this->seriesCounter;
	++$sTitleCounter;
	echo "<h1>Serie $sTitleCounter</h1>";

	echo <<<HTML
	<form action="" method="POST">
	    <input type="hidden" name="form" value="closeSeries">
	    <input type="hidden" name="eventId" value="{$this->vars['event']->getEvt_id()}">
	    <input type="submit" value="Serie $sTitleCounter abschliessen" class="button red">
	</form>
	
	<form action="/event/create" method="POST">
	    <fieldset id="save-number">
		<legend>Zahl ziehen!</legend>
		<input type="hidden" name="form" value="saveNumber">
		<input type="hidden" value="{$this->vars['event']->getEvt_id()}" name="eventId">
		<input type="hidden" value="{$this->vars['newestSeries']->getSer_id()}" name="seriesId">
		<input type="text" placeholder="Zahl" autocomplete="off" name="number">
		<input type="submit" value="Ziehen!">
	    </fieldset>
	</form>
	
	<div class="list">
	    <form action="/event/create" method="POST">
	    <input type="hidden" name="form" value="number">
	    <input type="hidden" value="{$this->vars['newestSeries']->getSer_id()}" name="seriesId">
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
		    <select name="events-action">
			<option>[Aktion]</option>"
			<option value="delete">Löschen</option>
		    </select>
		    <input type="submit" value="Ausführen">
		</form>
	    </div>
	</div>

HTML;
    }

}

?>
