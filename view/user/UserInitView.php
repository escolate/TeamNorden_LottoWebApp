<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserView
 *
 * @author tscheurer
 */
class UserInitView extends View {

    /**
     *
     * @var User
     */
    private $user;

    public function display() {
        if (isset($this->vars['user']) && $this->vars['user'] instanceof User) {
            $this->user = $this->vars['user'];
        } else {
            $this->user = new User();
        }

        $gebdat = $this->getBirthDateInput($this->user->getUse_birth());
        $isAdmin = ($this->user->getUse_administrator() ? 'checked' : '');

        echo <<<OUT
        <div class="content-box">
    <h1>Neuer Benutzer anlegen</h1>
    <div class="list">
        <form id="userdata" action="/user/init" method="POST">
            <input type="hidden" name="userid" value="{$this->user->getUse_id()}"/>
            
            <fieldset>
                <legend>Login</legend>
                <input type="email" id="email" placeholder="E-Mail Adresse" name="email" value="{$this->user->getUse_email()}"/>
                <input type="password" autocomplete="off" id="password1" placeholder="Passwort" name="password1" />
                <input type="password" autocomplete="off" id="password2" placeholder="Passwort wiederholen" name="password2" />
                <input type="checkbox" {$isAdmin} id="admin" name="admin"> <label for="admin">Administrator</label>
            </fieldset>
        
            <fieldset>
                <legend>Name</legend>
                <input type="text" id="firstname" placeholder="Vorname" name="firstname" value="{$this->user->getUse_firstname()}"/>
                <input type="text" id="lastname" placeholder="Nachname" name="lastname" value="{$this->user->getUse_lastname()}"/>
                {$gebdat}
            </fieldset>
        
            <fieldset>
                <legend>Adresse</legend>
                <input type="text" id="street" placeholder="Strasse" name="street" value="{$this->user->getUse_address()}" />
                <input type="text" id="zip" placeholder="PLZ" name="zip" value="{$this->user->getUse_zip()}"/>
                <input type="text" id="place" placeholder="Ort" name="place" value="{$this->user->getUse_city()}"/>
            </fieldset>
                
            <fieldset>
                <legend>Kontakt</legend>
                <input type="text" id="phone" placeholder="Telefon" name="phone" value="{$this->user->getUse_phone()}"/>
                <input type="text" id="mobile" placeholder="Mobiltelefon" name="mobile" value="{$this->user->getUse_mobile()}"/>
            </fieldset>
                <button type="submit">speichern</button> <button>abbrechen</button>
        </form>
    </div>
</div>
OUT;
    }

    private function getBirthDateInput($bd) {
        $d = '';
        $m = '';
        $y = '';

        if (!empty($bd)) {
            $arr = explode(".", $bd);
            $d = $arr[0];
            $m = $arr[1];
            $y = $arr[2];
        }

        $out = "";
        $out .= '<select id="day" name="day"><option>Tag</option>';
        for ($i = 1; $i <= 31; $i++) {
            if ($i == $d) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        $out .= '</select>';

        $out .= '<select id="month" name="month"><option>Monat</option>';
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $m) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        $out .= '</select>';

        $out .= '<select id="year" name="year"><option>Jahr</option>';
        for ($i = date("Y"); $i >= date("Y") - 100; $i--) {
            if ($i == $y) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . $i . '</option>';
        }
        $out .= '</select>';

        return $out;
    }

}

?>
