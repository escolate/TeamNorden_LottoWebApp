<?php

class EventAddUserView extends View {

    public function display() {
	echo <<<HTML
    <div class="content-box">
    <h1>Spieler hinzufügen für Event "{$this->vars['event']->getEvt_name()}"</h1>
    <div class="list">
	<form action="/event/create/{$this->vars['event']->getEvt_id()}" method="POST">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    <th>Strasse</th>  
		    <th>Ort</th>
		    <th>Geburtstag</th>
                    <th>Admin</th>
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
HTML;
	// Remove all users that allready playing from array
	if ($this->vars['eventmember']) {
	    foreach ($this->vars['user'] as $userKey => $user) {
		foreach ($this->vars['eventmember'] as $eventmember) {
		    if ($user->getUse_id() == $eventmember->getUse_id()) {
			unset($this->vars['user'][$userKey]);
			continue;
		    }
		}
	    }
	}

	if ($this->vars['user']) {
	    foreach ($this->vars['user'] as $user) {
		echo '
			<tr>
			    <td><input type="checkbox" name="userIds[]" value="' . $user->getUse_id() . '"></td>
			    <td>' . $user->getUse_lastname() . ' ' . $user->getUse_firstname() . '</td>
			    <td>' . $user->getUse_address() . '</td>
			    <td>' . $user->getUse_zip() . ' ' . $user->getUse_city() . '</td>
			    <td>' . $user->getUse_birth() . '</a></td>
			    <td>' . ($user->getUse_administrator() ? '<img alt="Ja" src="/images/icons/tick.png">' : '') . '</td>
			</tr>';
	    }
	} else {
	    echo '
			<tr>
			    <td></td>
			    <td>leer</td>
			    <td>leer</td>
			    <td>leer</td>
			    <td>leer</td>
			    <td>leer</td>
			</tr>';
	}
	echo <<<HTML
              </tbody>
	    </table>
	    <select name="submit">
		<option>[Aktion]</option>
		<option value="addUserToEvent">Hinzufügen</option>
	    </select>
	    <button> Ausführen </button>
	    <button name="submit" value="backToEvent"> Zurück</button>	
	</form>
    </div>
</div>   
HTML;
    }

}

?>
