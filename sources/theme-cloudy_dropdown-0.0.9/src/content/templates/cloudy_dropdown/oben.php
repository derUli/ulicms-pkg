<!doctype html>
<html lang="<?php
echo getCurrentLanguage();
?>">
    <head>
        <?php base_metas() ?>
        <link rel="stylesheet"
              href="<?php
              echo getTemplateDirPath("cloudy_dropdown");
              ?>mobile.css"
              type="text/css" media="only screen and (max-device-width:800px)" />

        <link rel="stylesheet"
              href="<?php
              echo getTemplateDirPath("cloudy_dropdown");
              ?>mobile.css"
              type="text/css" media="handheld" />

    </head>

    <body class="<?php body_classes(); ?>">
        <div class="root-container">
            <div class="logo">
                <p>
                    <a href="./">
                        <?php
                        if (getconfig("logo_disabled") == "no") {
                            logo();
                            ?>
                            <br />
                            <?php
                        } else {
                            ?><strong><?php homepage_title() ?></strong>
                            <?php
                        }
                        ?>
                    </a>
                </p>
                <p>
                    <strong><?php motto() ?></strong>

            </div>
            <?php
            menu("top");
            ?>

            <div class="content">
                <?php Template::headline(); ?>
