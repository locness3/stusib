<link rel="stylesheet" href="./template/ugly/style.css">
<h1><?= get_option_value("site_title", true) ?></h1>
<p id="tagline"><?= get_option_value("site_tagline", true) ?></p>
<?= $content ?>