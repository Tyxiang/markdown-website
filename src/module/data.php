<?php
include "Parsedown.php";
include "heading-array.php";

// $data 中已经有的值会被保留
function update_data($path, $data)
{
    if (!file_exists($path)) {
        return $data;
    }
    $data_md = file_get_contents($path);
    $Parsedown = new Parsedown();
    $data_html = $Parsedown->text($data_md);
    $data_array = heading_parse($data_html);
    foreach ($data_array['h1'] as $h1) {
        if ($h1['title'] == 'Config') {
            foreach ($h1['h2'] as $h2) {
                if ($h2['title'] == 'name') {
                    $data['config']['name'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'title') {
                    $data['config']['title'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'icon') {
                    $data['config']['icon'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'keywords') {
                    $data['config']['keywords'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'mode') {
                    $data['config']['mode'] = strip_tags($h2['content']);
                }
                if ($h2['title'] == 'header') {
                    foreach ($h2['h3'] as $h3) {
                        if ($h3['title'] == 'logo') {
                            $data['config']['header']['logo'] = $h3['content'];
                        }
                        if ($h3['title'] == 'nav') {
                            $data['config']['header']['nav'] = $h3['content'];
                        }
                    }
                }
                if ($h2['title'] == 'ending') {
                    foreach ($h2['h3'] as $h3) {
                        if ($h3['title'] == 'left') {
                            $data['config']['ending']['left'] = $h3['content'];
                        }
                        if ($h3['title'] == 'center') {
                            $data['config']['ending']['center'] = $h3['content'];
                        }
                        if ($h3['title'] == 'right') {
                            $data['config']['ending']['right'] = $h3['content'];
                        }
                    }
                }
                if ($h2['title'] == 'footer') {
                    $data['config']['footer'] = $h2['content'];
                }
            }
        } else {
            $data['docu'] = $h1;
        }
    }
    return $data;
}
