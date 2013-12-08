<?php

class EventShowView extends View {

    public function display() {
	echo <<<EVENTDETAIL
   <div class="content-box">
    <h1>Veranstaltung</h1>
    <div class="event-card">
	<div class="column1">
	    <p>Name:</p>
	    <p>Adresse:</p>
	    <p>Kanton:</p>
	    <p>Postleitzahl:</p>
	    <p>Datum:</p>
	</div> 
	<div class="column2">
	    <p>Biergarten und Lotto</p>
	    <p>Rheinstrasse 34</p>
	    <p>Zürich</p>
	    <p>8003</p>
	    <p>23.10.1998</p>
	</div> 
    </div>
    <form>
	<input type="submit" value="Bearbeiten">
    </form>
</div>
EVENTDETAIL;
    }
}

