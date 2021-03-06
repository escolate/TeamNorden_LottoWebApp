<?php

class ContactInitView extends View {

    public function display() {
        echo "<h1>Kontakt</h1>";
        if (!empty($this->vars['notification'])) {
            echo "<p>{$this->vars['notification']}</p>";
        }
        echo <<<FORM
        <form id="contactform" action="{$this->vars['contactUri']}" method="post" name="contactform">
            <label for="contactform-subject" class="required">Betreff</label>
            <input type="text" id="contactform-subject" name="subject" required autocomplete="off" list="subjects" {$this->vars['validatedSubject']}>
            <datalist id="subjects">
                <option value="Beispiel Eins">
                <option value="Beispiel Zwei">
                <option value="Beispiel Drei">
                <option value="Bestellung">
                <option value="Rechnung">
                <option value="Medien">
                <option value="Fehler auf der Seite">
                <option value="Generelles">
            </datalist>

            <label for="contactform-message" class="required">Mitteilung</label>
            <textarea id="contactform-message" name="message" rows="8" cols="50" required {$this->vars['messageClasses']}>{$this->vars['message']}</textarea>

            <label for="contactform-lastname">Name</label>
            <input type="text" id="contactform-lastname" name="lastname" {$this->vars['validatedlastName']}>

            <label for="contactform-first_name">Vorname</label>
            <input type="text" id="contactform-first_name" name="first_name" {$this->vars['validatedFirstName']}>

            <label for="contactform-phone">Telefon-Nr.</label>
            <input type="tel" id="contactform-phone" name="phone" {$this->vars['validatedPhone']}>

            <label for="contactform-email" class="required">Email-Adresse</label>
            <input type="email" id="contactform-email" name="email" required {$this->vars['validatedEmail']}>

            <label for="contactform-newsletter">Newsletter abonnieren</label>
            <input type="checkbox" id="contactform-newsletter" name="newsletter" checked>

            <input type="text" id="contactform-name" name="name">
            <input type="hidden" name="contact" value="1">
            <input type="submit" name="contactform_submit" value="Senden">
        </form>
FORM;
    }

}

