<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeriesView
 *
 * @author stinkpad
 */
class SeriesView extends View{
   
    public function display() {

	echo <<<SERIES
   <div class="content-box">
    <h1>Serie</h1>
    <div class="event-card">
	<div class="column1">
	    <p>Serie:</p>
	    <p>Event:</p>
	    <p>Serie abgeschlossen am:</p>
	    <p>Gezogene Zahlen:</p>
	</div> 
	<div class="column2">
	    <p>7</p>
	    <p>Biergarten und Lotto</p>
	    <p>21. Januar 2012, 17:47 Uhr</p>
	</div> 
	<div>
	    <div class="ball">1</div> <div class="ball">3</div> <div class="ball">14</div>
	    <div class="ball">45</div> <div class="ball">65</div> <div class="ball">14</div>
	    <div class="ball">89</div> <div class="ball">41</div> <div class="ball">14</div>
	    <div class="ball">44</div> <div class="ball">39</div> <div class="ball">14</div>
	    <div class="ball">34</div> <div class="ball">42</div> <div class="ball">14</div>
	    <div class="ball">78</div> <div class="ball">3</div> <div class="ball">14</div>
	    <div class="ball">2</div> <div class="ball">76</div> <div class="ball">14</div>
	    <div class="ball">4</div> <div class="ball">5</div> <div class="ball">14</div>
	    <div class="ball">13</div> <div class="ball">56</div> <div class="ball">14</div>
	</div>
    </div>
    	<form>
	    <input type="submit" value="Bearbeiten">
	</form>
</div>

SERIES;
    }
}

?>
