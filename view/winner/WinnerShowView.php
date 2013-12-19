<?php

class WinnerShowView extends View {

    public function display() {

	echo <<<HTML
        <div class="content-box">
    <h1>Gewinn</h1>
    <div class="event-card">
    <table class="show-table">
	    <tbody>
		<tr>
		<td>Gewinner:</td>
		<td></td>
		</tr>
		<tr>
		<td>Event:</td>
		<td></td>
		</tr>
		<tr>
		<td>Serie:</td>
		<td></td>
		</tr>
		<tr>
		<td>Datum und Zeit:</td>
		<td></td>
		</tr>
		<tr>
		<td>Gezogene Zahlen:</td>
		<td>
HTML;
	$y = 7; // How many balls per line
	$i = $y;
	foreach ($this->vars['numberList'] as $object) {
	    echo '<div class="ball winning">';
	    echo $object->getNum_num();
	    echo '</div>';
	    $i--;
	    if(!$i){
		echo '<br>';
		$i = $y;
	    }
	}
	echo <<<HTML
		</td>
		</tr>
	    </tbody>
	</table>

	<div>

	</div>
    </div>

    <div class="lotto-card">
	<div class="lotto-number">
	    <span>Nr.</span>
	    <span>998789</span>
	</div>
	<div class="lotto-row">
	    <span>Reihe 1</span>
	    <span class="winning">2</span>
	    <span class="winning">42</span>
	    <span class="winning">56</span>
	    <span class="winning">65</span>
	    <span class="winning">89</span>
	</div>
	<div class="lotto-row">
	    <span>Reihe 2</span>
	    <span>12</span>
	    <span>26</span>
	    <span>82</span>
	    <span>89</span>
	    <span>90</span>
	</div>
	<div class="lotto-row">
	    <span>Reihe 3</span>
	    <span>1</span>
	    <span>4</span>
	    <span>9</span>
	    <span>11</span>
	    <span>56</span>
	</div>
    </div>
</div>
HTML;
    }

}

?>
