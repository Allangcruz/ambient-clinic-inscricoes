import mix from 'laravel-mix';

mix
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/plugins/jquery/jquery.min.js')
    .copy('node_modules/jquery/dist/jquery.min.map', 'public/assets/plugins/jquery/jquery.min.map')

    .copy('node_modules/@picocss/pico/css', 'public/assets/plugins/pico/css')

    .copy('node_modules/bootstrap/dist/', 'public/assets/plugins/bootstrap/')

    .copy('node_modules/gridjs/dist/', 'public/assets/plugins/gridjs/')
