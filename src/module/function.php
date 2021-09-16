<?php
// $config 中已经有的值会被保留
function update_config($heading_array, $config){
    foreach ($heading_array['h1'] as $h1) {
        if ($h1['title'] == 'CONFIG') {
            foreach ($h1['h2'] as $h2) {
                if ($h2['title'] == 'name') {
                    $config['name'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'title') {
                    $config['title'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'icon') {
                    $config['icon'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'keywords') {
                    $config['keywords'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'mode') {
                    $config['mode'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'header') {
                    foreach ($h2['h3'] as $h3) {
                        if ($h3['title'] == 'logo') {
                            $config['header']['logo'] = $h3['content'];
                        }
                        if ($h3['title'] == 'nav') {
                            $config['header']['nav'] = $h3['content'];
                        }
                    }
                }
                if ($h2['title'] == 'ending') {
                    foreach ($h2['h3'] as $h3) {
                        if ($h3['title'] == 'left') {
                            $config['ending']['left'] = $h3['content'];
                        }
                        if ($h3['title'] == 'center') {
                            $config['ending']['center'] = $h3['content'];
                        }
                        if ($h3['title'] == 'right') {
                            $config['ending']['right'] = $h3['content'];
                        }
                    }
                }
                if ($h2['title'] == 'footer') {
                    $config['footer'] = $h2['content'];
                }
            }
        }
    }
    return $config;
}