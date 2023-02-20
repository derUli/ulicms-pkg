<?php
if (!getconfig("facebook_like_button_layout")) {
    setconfig("facebook_like_button_layout", "standard");
}

if (!getconfig("facebook_like_button_action")) {
    setconfig("facebook_like_button_action", "like");
}

if (!getconfig("facebook_like_button_data_colorscheme")) {
    setconfig("facebook_like_button_data_colorscheme", "light");
}

if (getconfig("facebook_like_button_show_faces") === false) {
    setconfig("facebook_like_button_show_faces", "true");
}

if (getconfig("facebook_like_button_shware") === false) {
    setconfig("facebook_like_button_share", "true");
}
?>
<pre>
Sie können optional die folgenden Konfigurationseinstellungen 
anpassen.
facebook_like_button_layout
facebook_like_button_action
facebook_like_button_data_colorscheme
facebook_like_button_show_faces
facebook_like_button_show_faces
facebook_like_button_share
Mögliche Werte für diese Optionen
können Sie erfahren im <a
		href="https://developers.facebook.com/docs/plugins/like-button"
		target="_blank">Facebook Developer Netzwerk</a>.
Außerdem können Sie den Facebook Share Button auf bestimmten Seiten deaktivieren,
in dem Sie folgendes in das Feld "Custom Data" eintragen:
{"disable_facebook_like", "yes"}</pre>