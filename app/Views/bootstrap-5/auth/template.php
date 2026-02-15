<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php base_url() ?>assets/imgs/icon.png" type="image/x-icon">
    <title><?= esc($title ?? 'Ambient Clinic') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/admin-lte/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/ambientclinic.css') ?>">
    <?= $this->renderSection('css') ?>
</head>
<body class="login-page bg-body-secondary">
    <?= $this->renderSection('content') ?>
    <script src="<?= base_url('assets/plugins/admin-lte/js/adminlte.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/jquery-validation/localization/messages_pt_BR.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/gasparesganga-jquery-loading-overlay/loadingoverlay.min.js ') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>