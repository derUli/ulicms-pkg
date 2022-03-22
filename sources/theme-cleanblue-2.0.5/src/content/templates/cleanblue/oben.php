<?php html5_doctype(); ?>
<?php og_html_prefix(); ?>
<head>
    <?php base_metas(); ?>
    <?php og_tags(); ?>
    <meta name="viewport" content="width=1024" />
</head>
<body class="<?php body_classes(); ?>">
    <div id="root-container">
        <header>
            <section id="logo">
                <a href="./">
                    <?php
                    if (getconfig("logo_disabled") == "no") {
                        logo();
                        ?>
                        <br />  
                        <?php
                    } else {
                        ?><strong><?php homepage_title(); ?></strong>
                        <?php
                    }
                    ?>
                </a>
            </section>
            <nav><?php
                menu("top");
                ?></nav>
        </header>
        <main>
            <?php Template::headline(); ?>