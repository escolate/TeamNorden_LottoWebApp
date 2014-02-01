<?php

class EventmemberscardView extends View {

    private $user;

    public function display() {
	echo <<<OUT
        <div class="content-box">
    <h1>Spieler</h1>
    <div class="list">
	    <table>
		<thead>
		    <tr>
		    <th>Name</th>
		    <th>Strasse</th>  
		    <th>Ort</th>
		    <th>Geburtstag</th>
                    <th>Admin</th>
		    </tr>
		</thead>

		<tbody>
OUT;
	foreach ($this->vars['user'] as $user) {
	    $this->user = $user;
	    echo '
                <tr>
                    <td><a href="/benutzerkarten/' . $this->user->getUse_id() .'-'. $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() .'">' . $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() . '</a></td>
                    <td><a href="/benutzerkarten/' . $this->user->getUse_id() .'-'. $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() .'">' . $this->user->getUse_address() . '</a></td>
                    <td><a href="/benutzerkarten/' . $this->user->getUse_id() .'-'. $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() .'">' . $this->user->getUse_zip() . ' ' . $this->user->getUse_city() . '</a></td>
                    <td><a href="/benutzerkarten/' . $this->user->getUse_id() .'-'. $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() .'">' . $this->user->getUse_birth() . '</a></td>
                    <td><a href="/benutzerkarten/' . $this->user->getUse_id() .'-'. $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() .'">' . ($this->user->getUse_administrator() ? '<img alt="Ja" src="/images/icons/tick.png">' : '') . '</a></td>
                </tr>';
	}
	echo <<<OUT
                                    </tbody>
	    </table>
    </div>
</div>   
OUT;
    }

}

?>
