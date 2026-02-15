<!DOCTYPE html>
<html lang="pt-br" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php base_url() ?>assets/imgs/icon.png" type="image/x-icon">
    <meta name="color-scheme" content="dark light">
    <title><?= esc($title ?? 'Ambient Clinic') ?></title>
</head>
<body>
    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>
      
    <?= $this->renderSection('content') ?>
    <script>
        function getPathAmbientClinic(url) {
            url = url || '';
            return '<?= base_url() ?>' + url;
        }
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>