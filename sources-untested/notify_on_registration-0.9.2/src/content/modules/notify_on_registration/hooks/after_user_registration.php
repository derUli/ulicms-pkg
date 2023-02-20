<?php

$to = Settings::get("email");
$subject = get_translation("REGISTRATION_EMAIL_NOTIFICATION_SUBJECT", array(
    "{domain}" => get_domain()
        ));
$message = get_translation("REGISTRATION_EMAIL_NOTIFICATION_MESSAGE", array(
    "{domain}" => get_domain(),
    "{username}" => $_POST ["username"],
    "{ip}" => get_ip()
        ));

$headers = "From: $to";

ulicms_mail($to, $subject, $message, $headers);
