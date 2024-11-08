<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Courette <?= (isset($aData['title'])?"| " . $aData['title']:"") ?></title>
        <!-- import font-families -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Viga&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        </style>
        <link href="<?= base_url("vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet"/>
        <link href="<?= base_url("vendor/fontawesome/css/all.min.css") ?>" rel="stylesheet"/>
        <link href="<?= base_url("css/base.css") ?>" rel="stylesheet"/>
        <!-- il faudra ajouter les fichiers CSS que je veux ici -->
        <?php foreach($aAllCssFiles as $strCssFile): ?>
            <link href="<?= $strCssFile ?>" rel="stylesheet"/>
        <?php endforeach; ?>
    </head>
    <body>
        <div class="content">
            <header class="py-3">
                <?= view("template/header") ?>
            </header>
            <?= view($viewToLoad, $aData) ?>
        </div>
        <footer>
            <?= view("template/footer") ?>
        </footer>

        <script type="text/javascript">
            var COMMON_BASE_URL = "<?= base_url() ?>";
        </script>
        <script src="<?= base_url("vendor/jquery.min.js") ?>"></script>
        <script src="<?= base_url("vendor/bootstrap/js/bootstrap.min.js") ?>"></script>
        <script src="<?= base_url("js/common.js") ?>"></script>
        <!-- il faudra ajouter les fichiers JS que je veux ici -->
        <?php foreach($aAllJsFiles as $strJsFile): ?>
            <script src="<?= $strJsFile ?>"></script>
        <?php endforeach; ?>
    </body>
</html>
