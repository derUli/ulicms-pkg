<?php
$facebook_app_id = Settings::get("facebook_app_id");
if (!$facebook_app_id) {
    echo "<p class='ulicms-error'>Please set facebook_app_id!</p>";
} else {
    ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&appId=<?php
    echo urlencode($facebook_app_id);
    ?>&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <?php
}
