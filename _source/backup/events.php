<div class="content-box">
    <a href="#" class="content-box-button green">+ Neue Veranstaltung erstellen</a>
    <h2>Veranstaltungen</h2>
    <form name="events" class="action">
	<table border="1" class="list">
	    <thead>
		<tr>
		    <th></th>
		    <th>Name</th>
		    <th>Erstellt</th>
		</tr>
	    </thead>
	    <tfoot>
		<tr>
		    <td><input type="checkbox"></td>
		    <td>Alle auswählen</td>
		    <td></td>
		</tr>
	    </tfoot>
	    <tbody>
		<tr>
		    <td><input type="checkbox"></td>
		    <td><a href="#">Biergarten und Lotto</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><input type="checkbox"></td>
		    <td><a href="#">Pflaumentanz</a></td>
		    <td><a href="#">30.10.2013</a></td>
		</tr>
		<tr>
		    <td><input type="checkbox"></td>
		    <td><a href="#">Happa Happa Lotto wir sind luschtig heut!</a></td>
		    <td><a href="#">01.02.2012</a></td>
		</tr>
	    </tbody>
	</table>
	<select name="events-action">
	    <option value="action">[Aktion]</option>
	    <option value="delete">Löschen</option>
	</select>
	<input type="submit" value="Ausführen">
    </form>
    <div class="pages">
	Seite
	<select name="events-action">
	    <option value="delete">1</option>
	    <option value="delete">2</option>
	    <option value="delete">3</option>
	    <option value="delete">4</option>
	    <option value="action" selected>5</option>
	    <option value="delete">6</option>
	    <option value="delete">7</option>
	</select>
	von 7
    </div>
</div>