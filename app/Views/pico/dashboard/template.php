<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php base_url() ?>assets/imgs/icon.png" type="image/x-icon">
    <meta name="color-scheme" content="light dark">
    <title><?= esc($title ?? 'Ambient Clinic') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/pico/css/pico.blue.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/ambientclinic.css') ?>">
    <?= $this->renderSection('css') ?>
</head>
<body>
    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>
      
    <?= $this->renderSection('content') ?>
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script>
        function getPathAmbientClinic(url) {
            url = url || '';
            return '<?= base_url() ?>' + url;
        }
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>