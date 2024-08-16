<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Courette <?= (isset($aData['title'])?"| " . $aData['title']:"") ?></title>
        <link href="<?= base_url("vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet"/>
        <link href="<?= base_url("vendor/fontawesome/css/all.min.css") ?>" rel="stylesheet"/>
        <!-- il faudra ajouter les fichiers CSS que je veux ici -->
        <?php foreach($aAllCssFiles as $strCssFile): ?>
            <link href="<?= $strCssFile ?>" rel="stylesheet"/>
        <?php endforeach; ?>
    </head>
    <body>
        <?= view("template/header") ?>
        <?= view($viewToLoad, $aData) ?>
        <?= view("template/footer") ?>

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
