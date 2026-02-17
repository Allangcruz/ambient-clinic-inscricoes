<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url() ?>/favicon.ico" type="image/x-icon">
    <title><?= esc($title ?? 'Ambient Clinic') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <?= $this->renderSection('css') ?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">      
      <?= $this->renderSection('content') ?>
    </div>
    
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