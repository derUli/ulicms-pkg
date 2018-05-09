<?php
include getModulePath("newsletter", true) . "newsletter_install.php";
newsletter_check_install();

function cancel_newsletter($mail)
{
    $mail = db_escape($mail);
    if ($_SESSION["language"] == "de") {
        $translation_newsletter_canceled = "Ihre E-Mail Adresse wurde aus der Liste entfernt.";
        $translation_email_not_subscribed = "Diese E-Mail Adresse befindet sich nicht in der Liste";
    } else {
        $translation_newsletter_canceled = "Your mail adress was removed from the list";
        $translation_email_not_subscribed = "This mail adress is not in the list.";
    }
    
    if (! checkIfSubscribed($mail)) {
        return "<p>$translation_email_not_subscribed</p>";
    }
    
    db_query("DELETE FROM " . tbname("newsletter_subscribers") . " WHERE email = '$mail'");
    
    return "<p>$translation_newsletter_canceled</p>";
}

function subscribe_newsletter($mail)
{
    $html_output = "";
    
    if ($_SESSION["language"] == "de") {
        $translation_thank_you_for_subscribing = "Danke für das Abonnieren des Newsletters.<br/>Sie müssen den Empfang des Newsletters noch bestätigen, in dem Sie den Link in der E-Mail die wir an Sie versandt haben anklicken.";
        $translation_already_subscribed = "Sie haben den Newsletter bereits abonniert!";
        $translation_email_adress_invalid = "Diese E-Mail Adresse ist ungültig.";
    } else {
        $translation_thank_you_for_subscribing = "Thank you for subscribing! You have to confirm the newsletter by clicking on the link that we sent in an email to you";
        $translation_already_subscribed = "You've Subscribed the newsletter.";
        $translation_email_adress_invalid = "This mail adress is invalid.";
    }
    
    $subscribe_date = time();
    if (check_email_address($mail)) {
        
        if (checkIfSubscribed($mail)) {
            $html_output .= "<p>$translation_already_subscribed</p>";
        } else {
            
            $subscribe_date = time();
            
            $code = md5($mail . strval($subscribe_date));
            $unescaped_mail = $mail;
            $mail = db_escape($mail);
            
            db_query("INSERT INTO " . tbname("newsletter_subscribers") . "(email, subscribe_date) VALUES('$mail', " . $subscribe_date . ")");
            
            $headers = "From: " . getconfig("email") . "\n" . "Content-Type: text/plain; charset=UTF-8";
            
            $url = rootDirectory() . buildSEOUrl(get_requested_pagename()) . "?code=" . $code;
            
            $mailtext = "Vielen Dank für das Abonnieren, des E-Mail Newsletters von \"" . getconfig("homepage_title") . "\"!\n\n" . "Bitte klicken Sie auf folgenden Link, um den Empfang des Newsletters zu bestätigen:\n" . $url . "\n\n" . "Sollten Sie diese E-Mail ungewünscht empfangen haben, ignorieren Sie sie einfach.";
            
            if (@mail($unescaped_mail, "Bestätigung des Email-Newsletters", $mailtext, $headers)) {
                $html_output .= "<p>$translation_thank_you_for_subscribing</p>";
            } else {
                $html_output .= "Der Versand der Bestätigungs E-Mail ist aus technischen Gründen fehlgeschlagen.<br/>
             Bitte kontaktieren Sie den Administrator der Internetseite.";
            }
        }
    } else {
        
        $html_output .= "<p>" . $translation_email_adress_invalid . "</p>";
    }
    
    return $html_output;
}

function checkIfSubscribed($mail)
{
    $mail = db_escape($mail);
    $query = db_query("SELECT email FROM " . tbname("newsletter_subscribers") . " WHERE `email` = '$mail'");
    return db_num_rows($query) > 0;
}

function check_email_address($email)
{
    $at_array = explode("@", $email);
    $dot_array = explode(".", $email);
    return count($at_array) == 2 and count($dot_array) >= 2;
}

function newsletter_render()
{
    $html_output = "";
    
    if ($_SESSION["language"] == "de") {
        $translation_your_mail_adress = "Ihre E-Mail Adresse";
        $translation_subscribe_newsletter = "Newsletter abonnieren";
        $translation_cancel_newsletter = "Newsletter kündigen";
        $translation_submit = "Absenden";
    } else {
        $translation_your_mail_adress = "Your mail adress";
        $translation_subscribe_newsletter = "subscribe newsletter";
        $translation_cancel_newsletter = "Cancel newsletter";
        $translation_submit = "Submit";
    }
    
    $email = false;
    if (isset($_SESSION["login_id"])) {
        $userdata = getUserById($_SESSION["login_id"]);
        $email = $userdata["email"];
    }
    
    if (! empty($_POST["newsletter_email_adress"]) and ! empty($_POST["newsletter_subscribe"])) {
        if ($subscribe == "yes") {
            $subscribe = $_POST["newsletter_subscribe"];
            if (class_exists("PrivacyCheckbox")) {
                $checkbox = new PrivacyCheckbox(getCurrentLanguage(true));
                if ($checkbox->isEnabled()) {
                    if (! $checkbox->isChecked()) {
                        return "<p>" . get_translation("please_accept_privacy_conditions") . "</p>";
                    }
                }
            }
            return subscribe_newsletter($_POST["newsletter_email_adress"]);
        } else if ($subscribe == "no") {
            return cancel_newsletter($_POST["newsletter_email_adress"]);
        }
    }
    
    $html_output .= "<form class=\"newsletter_form\" action=\"" . get_requested_pagename() . ".html\" method=\"post\">";
    
    $html_output .= get_csrf_token_html();
    
    if ($email) {
        $html_output .= "<input name=\"newsletter_email_adress\" type=\"hidden\" value=\"$email\">";
    } else {
        
        if (isset($_POST["newsletter_email_adress"])) {
            $email = htmlspecialchars($_POST["newsletter_email_adress"]);
        } else {
            $email = "";
        }
        
        $html_output .= "$translation_your_mail_adress: <input name=\"newsletter_email_adress\" type=\"email\" value=\"$email\">";
        $html_output .= "<br/><br/>";
    }
    
    if ($email and ! empty($email)) {
        $subscribed = checkIfSubscribed($email);
    } else {
        $subscribed = false;
    }
    
    if (! $subscribed or empty($email)) {
        $html_output .= "<input type=\"radio\" name=\"newsletter_subscribe\" checked value=\"yes\"> $translation_subscribe_newsletter<br/>";
        $html_output .= "<input type=\"radio\" name=\"newsletter_subscribe\" value=\"no\"> $translation_cancel_newsletter";
    } else {
        
        $html_output .= "<input type=\"radio\" name=\"newsletter_subscribe\" value=\"yes\"> $translation_subscribe_newsletter<br/>";
        $html_output .= "<input type=\"radio\" name=\"newsletter_subscribe\" checked value=\"no\"> $translation_cancel_newsletter";
    }
    
    if (class_exists("PrivacyCheckbox")) {
        $checkbox = new PrivacyCheckbox(getCurrentLanguage(true));
        if ($checkbox->isEnabled()) {
            $html_output .= '<div class="newsletter_privacy_checkbox">';
            $html_output .= $checkbox->render();
            $html_output .= '</div>';
        }
    }
    
    $html_output .= "<br/><br/><input type=\"submit\" class=\"btn btn-primary\" value=\"$translation_submit\">";
    
    $html_output .= "</form>";
    
    return $html_output;
}

?>