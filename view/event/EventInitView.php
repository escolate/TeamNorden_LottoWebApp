<?php

class EventInitView extends View {

    private $notification = "";
    private $formType = "createEvent";
    public function display() {

	$gebdat = $this->getBirthDateInput();
	echo <<<HTML
		<div class="content-box">
		    <h1>LALA</h1>
		    {$this->notification}
		    <div class="list">
		    <form id="userdata" action="/event/new" method="POST">
			<input type="hidden" name="form" value="$this->formType"/>
			<fieldset>
			    <legend>Veranstaltung</legend>
			    <input type="text" id="evt_name" placeholder="Name der Veranstaltung" name="evt_name" value=""/>
			</fieldset>
			
			<fieldset>
			    <legend>Datum</legend>
			    {$gebdat}
			</fieldset>
			
			<fieldset>
			    <legend>Details</legend>
			    <input type="text" id="evt_location" placeholder="Adresse" name="evt_location" value=""/>
			    <input type="text" id="evt_city" placeholder="Ort" name="evt_city" value=""/>
			    <input type="text" id="evt_zip" placeholder="PLZ" name="evt_zip" value=""/>
			</fieldset>
			
			<button type="submit">speichern</button> <button>abbrechen</button>
		    </form>
		</div>
	    </div>
HTML;
    }

}

?>
