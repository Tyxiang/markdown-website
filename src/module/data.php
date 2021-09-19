<?php
include "Parsedown.php";
include "heading-array.php";

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
        if ($h1['title'] == 'CONFIG') {
        // {"a":1, "b":2} + {"b":3, "c":4} = {"a":1, "b":3, "c":4}
            foreach ($h1['h2'] as $h2) {
                if ($h2['title'] == 'name') {
                    $data['config']['name'] = trim(strip_tags($h2['content']));
                }
                if ($h2['title'] == 'title') {
                    $data['config']['title'] = trim(strip_tags($h2['content']));
                }
                if ($h2['title'] == 'icon') {
                    $data['config']['icon'] = trim(strip_tags($h2['content']));
                }
                if ($h2['title'] == 'keywords') {
                    $data['config']['keywords'] = trim(strip_tags($h2['content']));
                }
                if ($h2['title'] == 'mode') {
                    $data['config']['mode'] = trim(strip_tags($h2['content']));
                }
                if ($h2['title'] == 'header') {
                    $data['config']['header'] = array();
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
                    $data['config']['ending'] = array();
                    foreach ($h2['h3'] as $h3) {
                        if ($h3['title'] == 'left-1') {
                            $data['config']['ending']['left-1'] = $h3['content'];
                        }
                        if ($h3['title'] == 'left-2') {
                            $data['config']['ending']['left-2'] = $h3['content'];
                        }
                        if ($h3['title'] == 'left-3') {
                            $data['config']['ending']['left-3'] = $h3['content'];
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
        // {"a":1, "b":2} + {"b":3, "c":4} = {"b":3, "c":4}
            $data['docu'] = $h1;
        }
    }
    return $data;
}

