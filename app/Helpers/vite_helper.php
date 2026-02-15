<?php

function vite_assets($entry)
{
    $env = env('CI_ENVIRONMENT', 'production');
    $devServer = "http://localhost:5173";

    if ($env === 'development') {
        return '
            <script type="module" src="' . $devServer . '/@vite/client"></script>
            <script type="module" src="' . $devServer . '/' . $entry . '"></script>
        ';
    }

    $manifestPath = FCPATH . 'dist/manifest.json';
    if (!file_exists($manifestPath)) {
        return '';
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
    
    if (!isset($manifest[$entry])) {
        return '';
    }

    $file = $manifest[$entry]['file'];
    $css = isset($manifest[$entry]['css']) ? $manifest[$entry]['css'] : [];

    $html = '<script type="module" src="' . base_url('dist/' . $file) . '"></script>';
    foreach ($css as $cssFile) {
        $html .= '<link rel="stylesheet" href="' . base_url('dist/' . $cssFile) . '">';
    }

    return $html;
}