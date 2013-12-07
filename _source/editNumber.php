<div class="content-box">
    <h1>Zahl</h1>
    <form class="forms">
	<fieldset>
	    <legend>Zu ändernde Zahl</legend>
	    <label for="drawing">Ziehung 1 mit Zahl</label>
	    <input type="text" id="drawing" value="9">
	</fieldset>

	<br>
	<fieldset>
	    <legend>Positionierung</legend>
	    <label for="same">Position belassen</label>
	    <input type="radio" name="position" value="same" id="same">

	    <label for="before">Vor</label>
	    <input type="radio" name="position" value="before" id="before">

	    <label for="after">Nach</label>
	    <input type="radio" name="position" value="after" id="after">
	    <select name="drawings">
		<option value="delete">Ziehnung 1 (9)</option>
		<option value="delete">Ziehnung 2 (12)</option>
		<option value="delete">Ziehnung 3 (78)</option>
		<option value="action">Ziehnung 4 (89)</option>
		<option value="delete">Ziehnung 5 (86)</option>
		<option value="delete">Ziehnung 6 (3)</option>
	    </select>
	</fieldset>
	<br>
	<input type="submit" value="Speichern">
    </form>
</div>