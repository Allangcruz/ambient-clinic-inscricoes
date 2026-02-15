const mix = require('laravel-mix')

mix
    .copy('node_modules/admin-lte/dist/css/adminlte.min.css', 'public/assets/plugins/admin-lte/css/adminlte.min.css')
    .copy('node_modules/admin-lte/dist/css/adminlte.min.css.map', 'public/assets/plugins/admin-lte/css/adminlte.min.css.map')
    .copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/assets/plugins/admin-lte/js/adminlte.min.js')
    .copy('node_modules/admin-lte/dist/js/adminlte.min.js.map', 'public/assets/plugins/admin-lte/js/adminlte.min.js.map')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/plugins/jquery/jquery.min.js')
    .copy('node_modules/jquery/dist/jquery.min.map', 'public/assets/plugins/jquery/jquery.min.map')
    .copy('node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/assets/plugins/jquery-validation/jquery.validate.min.js')
    .copy('node_modules/jquery-validation/dist/localization/messages_pt_BR.min.js', 'public/assets/plugins/jquery-validation/localization/messages_pt_BR.min.js')
    .copy('node_modules/gasparesganga-jquery-loading-overlay/dist/loadingoverlay.min.js', 'public/assets/plugins/gasparesganga-jquery-loading-overlay/loadingoverlay.min.js')
    .copy('node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js', 'public/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js')
    
