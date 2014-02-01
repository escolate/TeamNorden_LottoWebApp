<?php

class UserInitView extends View {

    /**
     *
     * @var User
     */
    private $user;
    
    private $notification = "";

    public function display() {
        if (isset($this->vars['user']) && $this->vars['user'] instanceof User) {
            $this->user = $this->vars['user'];
            $boxtitle = "Benutzer bearbeiten";
        } else {
            $this->user = new User();
            $boxtitle = "Neuer Benutzer anlegen";
        }
        
        if(isset($this->vars['notify'])) {
            $this->notification = '<div class="red">'.$this->vars['notify'].'</div>';
        }

        $gebdat = $this->getBirthDateInput($this->user->getUse_birth());
        $isAdmin = ($this->user->getUse_administrator() ? 'checked' : '');
        $autocomplete = $this->getStatusAutoComplete();

        echo <<<OUT
        <div class="content-box">
    <h1>{$boxtitle}</h1>
        {$this->notification}
    <div class="list">
        <form id="userdata" action="/benutzer/init" method="POST">
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
                <input type="text" id="status" placeholder="Status" name="status" list="statgroup" value="{$this->user->getUse_status()}"/>
                {$autocomplete}
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
                <button type="submit" name="action" value="save">speichern</button> <button>abbrechen</button>
        </form>
    </div>
</div>
OUT;
    }
           
    
    private function getStatusAutoComplete() {
        $temp = '<datalist id="statgroup">';
        foreach (MysqlAdapter::getInstance()->getStatusList() as $val) {
            $temp .= '<option value="'.$val.'" />';
        }
        $temp .= '</datalist>';
        
        return $temp;
    }

}

?>
