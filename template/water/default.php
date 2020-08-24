<html>

<head>
    <title>My awesome blog!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./template/water/assets/css/light.css">
    <link rel="stylesheet" href="./template/water/assets/css/style.css">
</head>

<body>
    <header class="masthead">
        <div class="header-left">
            <h1><?= get_option_value("site_title", true) ?></h1>
            <p class="tagline"><?= get_option_value("site_tagline", true) ?></p>
        </div>
        <div class="header-right">
            This is the right of the navbar :P
        </div>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>Hi</footer>
</body>

</html>