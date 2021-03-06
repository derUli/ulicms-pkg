<?php

function kontaktformular_render()
{
    
    // check for Spam Protection Variable
    if (! getconfig("contact_form_refused_spam_mails")) {
        setconfig("contact_form_refused_spam_mails", "0");
    }
    
    $fehler = false;
    if (isset($_POST["absenden"])) {
        
        if (empty($_POST["vorname"])) {
            if ($_SESSION["language"] == "de") {
                $fehler = "Bitte geben Sie Ihren Vornamen ein.";
            } else {
                $fehler = "Please enter your first name.";
            }
        }
        
        if (empty($_POST["nachname"])) {
            if ($_SESSION["language"] == "de") {
                $fehler = "Bitte geben Sie Ihren Nachnamen ein.";
            } else {
                $fehler = "Please enter your first name";
            }
        }
        
        if (empty($_POST["emailadresse"])) {
            if ($_SESSION["language"] == "de") {
                $fehler = "Bitte geben Sie Ihren Emailadresse ein, da wir Ihre Mail sonst nicht beantworten können.";
            } else {
                $fehler = "please enter your mail adress, because if you do it not, we can't answer your request.";
            }
        }
        
        if (empty($_POST["betreff"])) {
            if ($_SESSION["language"] == "de") {
                $fehler = "Bitte geben Sie einen Betreff ein.";
            } else {
                $fehler = "Please enter a subject.";
            }
        }
        
        if (empty($_POST["nachricht"])) {
            if ($_SESSION["language"] == "de") {
                $fehler = "Sie haben keine Nachricht eingegeben.";
            } else {
                $fehler = "Please enter a message.";
            }
        }
        
        $spamfilter_enabled = getconfig("spamfilter_enabled") == "yes";
        
        // Spamschutz
        if ($spamfilter_enabled) {
            
            // Blacklist
            // Spamschutz per Honeypot
            if ($_POST["email"] != "") {
                if ($_SESSION["language"] == "de") {
                    $fehler = "Das Spamschutz-Feld bitte leer lassen.";
                } else {
                    $fehler = "Please don't fill the spam-protection field.";
                }
                setconfig("contact_form_refused_spam_mails", getconfig("contact_form_refused_spam_mails") + 1);
            }
            
            // Wortfilter (Badwords)
            if (stringcontainsbadwords($_POST["vorname"]) or stringcontainsbadwords($_POST["nachname"]) or stringcontainsbadwords($_POST["betreff"]) or stringcontainsbadwords($_POST["nachricht"])) {
                
                if (! $fehler) {
                    setconfig("contact_form_refused_spam_mails", getconfig("contact_form_refused_spam_mails") + 1);
                }
                
                if ($_SESSION["language"] == "de") {
                    $fehler = "<p class='ulicms-error'>" . "Ihre Nachricht enthält nicht erlaubte Wörter.</p>";
                } else {
                    $fehler = "<p class='ulicms-error'>" . "Your comment contains not allowed words.</p>";
                }
            }
            
            // Filter nach chinesisch
            if (getconfig("disallow_chinese_chars") and (AntiSpamHelper::isChinese($_POST["betreff"]) or AntiSpamHelper::isChinese($_POST["nachricht"]))) {
                
                setconfig("contact_form_refused_spam_mails", getconfig("contact_form_refused_spam_mails") + 1);
                
                if ($_SESSION["language"] == "de") {
                    $fehler = "<p class='ulicms-error'>" . "Chinesische Schriftzeichen sind nicht erlaubt!</p>";
                } else {
                    $fehler = "<p class='ulicms-error'>" . "Chinese chars are not allowed!</p>";
                }
            }
            // Filter nach russisch
            if (getconfig("disallow_cyrillic_chars") and (AntispamHelper::isCyrillic($_POST["betreff"]) or AntiSpamHelper::isChinese($_POST["nachricht"]))) {
                
                setconfig("contact_form_refused_spam_mails", getconfig("contact_form_refused_spam_mails") + 1);
                
                if ($_SESSION["language"] == "de") {
                    $fehler = "<p class='ulicms-error'>" . "Kyrillische Schriftzeichen sind nicht erlaubt!</p>";
                } else {
                    $fehler = "<p class='ulicms-error'>" . "Cyrillic chars are not allowed!</p>";
                }
            }
            // Filter nach Land
            if (function_exists("isCountryBlocked")) {
                if (AntiSpamHelper::isCountryBlocked()) {
                    
                    if (! $fehler) {
                        setconfig("contact_form_refused_spam_mails", getconfig("contact_form_refused_spam_mails") + 1);
                    }
                    
                    if ($_SESSION["language"] == "de") {
                        
                        $fehler = "Sie dürfen diesen Formular leider nicht nutzen, da ihr Land im Spamfilter gesperrt ist. Falls Sie denken, dass dies ein Fehler sein sollte, benachrichtigen Sie bitte den Administrator dieser Internetseite";
                    } else {
                        $fehler = "You can't use this form, because your country is blocked. If you think this is an failure, then contact the administrator of this website.";
                    }
                }
            }
        }
        
        if ($fehler == false) {
            $_POST["nachricht"] = preg_replace('/\r\n|\r/', "\n", $_POST["nachricht"]);
            // sanitize($_POST['emailadresse']);
            $headers = "From: " . $_POST['emailadresse'] . "\nReply-To: " . $_POST['emailadresse'] . "\nContent-Type: text/plain; charset=UTF-8";
            $betreff = "Kontaktformular (" . getconfig("homepage_title") . ")";
            $mailtext = "--------------------------------------------------------\n" . "Kontaktformular (" . getconfig("homepage_title") . ")\n" . "--------------------------------------------------------\n" . "Vorname:      " . $_POST["vorname"] . "\n" . "Nachname:     " . $_POST["nachname"] . "\n" . "Emailadresse: " . $_POST["emailadresse"] . "\n" . "--------------------------------------------------------\n" . "Betreff:      " . $_POST["betreff"] . "\n" . "-----------------------------\n" . "Nachricht:\n\n" . $_POST["nachricht"];
            
            if (@ulicms_mail(getconfig("contact_form_mail_to"), $betreff, $mailtext, $headers)) {
                $kontaktformular_thankyou_page = getconfig("kontaktformular_thankyou_page");
                if ($kontaktformular_thankyou_page) {
                    $kontaktformular_thankyou_page = buildSEOUrl($kontaktformular_thankyou_page);
                    return '<script type="text/javascript">
                   location.replace("' . $kontaktformular_thankyou_page . '");
                   </script>
                   <p>Wenn Sie nicht weitergeleitet werden, klicken Sie bitte <a href="' . $kontaktformular_thankyou_page . '">hier</a></p>';
                } else if ($_SESSION["language"] == "de") {
                    return "<p class='contactform-success'>Vielen Dank für Ihre Email.<br/>Wir werden diese schnellstmöglich beantworten.</p>";
                } else {
                    return "<p class='contactform-success'>Thank you for your message.<br/>We will answer it, as fast as possible.</p>";
                }
            } else {
                
                return "<p class='contactform-error'>Aufgrund technischer Probleme konnte Ihre Email nicht abgeschickt werden.<br/>Bitte wenden Sie sich direkt an uns.</p>";
            }
        } else {
            return "<p class='contactform-error'>" . $fehler . "</p>";
        }
    } else {
        
        $spam_counter = "";
        
        $acl = new ACL();
        if ($acl->hasPermission("kontaktformular")) {
            $spam_counter = "<p class='ulicms_success'>Bisher <strong>" . getconfig("contact_form_refused_spam_mails") . "</strong> Spam Mails 
   blockiert</p><hr/>";
        }
        
        if ($_SESSION["language"] == "de") {
            $translation_firstname = "Vorname";
            $translation_lastname = "Nachname";
            $translation_emailadress = "Emailadresse";
            $translation_subject = "Ihr Betreff";
            $translation_spam_protection = "Spamschutz bitte leer lassen";
            $translation_your_message = "Ihre Nachricht";
            $translation_reset = "Zurücksetzen";
            $translation_submit = "Absenden";
        } else {
            $translation_firstname = "firstname";
            $translation_lastname = "lastname";
            $translation_emailadress = "e-Mail Adress";
            $translation_subject = "Your Subject";
            $translation_spam_protection = "Spam protection, let this empty";
            $translation_your_message = "Your message";
            $translation_reset = "Reset";
            $translation_submit = "Submit";
        }
        
        return $spam_counter . '<form action="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '" method="post" class="kontaktformular">' . get_csrf_token_html() . '
	<table border="0" cellpadding="1" cellspacing="1" style="height: 479px; width: 100%; ">
		<tbody>
			<tr>
				<td>
					<strong>' . $translation_firstname . ': </strong></td>
				<td>
					<input name="vorname" size="40" type="text" required="true"/></td>
			</tr>
			<tr>
				<td>
					<strong>' . $translation_lastname . ':</strong></td>
				<td>
					<input name="nachname" size="40" type="text" required="true"/></td>
			</tr>
			<tr>
				<td>
					<strong>' . $translation_emailadress . ':</strong></td>
				<td>
					<input name="emailadresse" size="40"  required="true" type="email" /></td>
			</tr>
			<tr>
				<td>
					<strong>' . $translation_subject . ':</strong></td>
				<td>
					<input name="betreff" size="40" type="text" required="true"/></td>
			</tr>
			<tr style="display:none">
				<td>
					<strong>' . $translation_spam_protection . ':</strong></td>
				<td>
					<input name="email" size="40" type="text"/></td>
			</tr>
			<tr>
				<td>
					<strong>' . $translation_your_message . ':</strong></td>
				<td>
					<p>
						<textarea cols="60" name="nachricht" rows="20" required="true"></textarea></p>
					<p>
						&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Formular:</strong></td>
				<td><input type="submit" value="' . $translation_submit . '" /> <input name="absenden" type="hidden" value="absenden" /></td>
			</tr>
			<tr>
				<td>
					&nbsp;</td>
				<td>
					&nbsp;</td>
			</tr>
		</tbody>
	</table>
</form>
<p>
	&nbsp;</p>
';
    }
}

?>
