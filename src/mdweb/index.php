<?php
/*
file_path
file_name
dir_path
dir_name

data = doc + config
doc = main + header + ending + footer
 */
include "module/Parsedown.php";
include "module/heading-array.php";

ini_set("display_errors", "On");
date_default_timezone_set("Asia/Shanghai");
//header('Access-Control-Allow-Origin:*');
//header('Access-Control-Allow-Methods:*');
//header('Access-Control-Allow-Headers:X-Requested-With,X_Requested_With');

// config
$config_file_path = "config.json";
if (file_exists($config_file_path)) {
    $json = file_get_contents($config_file_path);
    $config = json_decode($json, true);
}

// request
// fimik.com/src/tutorial/default.md, fimik.com/src/tutorial/, fimik.com/src/tutorial
$script_name = $_SERVER['SCRIPT_NAME']; // /src/mdweb/index.php, /src/mdweb/index.php, /src/mdweb/index.php
$request_uri = $_SERVER['REQUEST_URI']; // /src/tutorial/default.md, /src/tutorial/, /src/tutorial/
// start dir path
// get the same part at the left of $script_name and $request_uri, it is the $start_dir_path
$the_same_length = strspn($script_name ^ $request_uri, "\0");
$start_dir_path = substr($script_name, 0, $the_same_length); // /src/, /src/, /src/

// $script_dir_path = dirname($script_name); // /src, /src, /src
// $script_dir_path_no_start = ltrim($script_dir_path, $start_dir_path); // "", "", ""
// $request_dir_path = dirname($request_uri); // /src/tutorial, /src, /src
// $request_dir_path_no_start = ltrim($request_dir_path, $start_dir_path); // tutorial, "", ""

// server
// $server_name = $_SERVER['SERVER_NAME']; // fimik.com
// $server_port = $_SERVER['SERVER_PORT']; // 80
// if ($server_port == '80') {
//     $server_address = 'http://' . $server_name . $start_dir_path;
// } else {
//     $server_address = 'http://' . $server_name . ':' . $server_port . $start_dir_path;
// }

chdir('../');

// header
$doc_header_file_path = "_header.md";
if (file_exists($doc_header_file_path)) {
    $md = file_get_contents($doc_header_file_path);
    $Parsedown = new Parsedown();
    $html = $Parsedown->text($md);
    $xml = new DOMDocument('1.0','UTF-8');
    $xml->loadHTML($html);
    foreach($xml->getElementsByTagName('a') as $link) { 
        $old_link = $link->getAttribute("href");
        if (!filter_var($old_link, FILTER_VALIDATE_URL)) { 
            // not url
            $link->setAttribute('href', $start_dir_path . $old_link);
        }
    }
    $html = $xml->saveHtml();
    $array = heading_parse($html);
    foreach ($array['h1'] as $h1) {
        if ($h1['title'] == 'header') {
            foreach ($h1['h2'] as $h2) {
                if ($h2['title'] == 'nav') {
                    $header['nav'] = $h2['content'];
                }
            }
        }
    }
}
// ending
$doc_ending_file_path = "_ending.md";
if (file_exists($doc_ending_file_path)) {
    $md = file_get_contents($doc_ending_file_path);
    $Parsedown = new Parsedown();
    $html = $Parsedown->text($md);
    $xml = new DOMDocument('1.0','UTF-8');
    $xml->loadHTML($html);
    foreach($xml->getElementsByTagName('a') as $link) { 
        $old_link = $link->getAttribute("href");
        if (!filter_var($old_link, FILTER_VALIDATE_URL)) { 
            // not url
            $link->setAttribute('href', $start_dir_path . $old_link);
        }
    }
    $html = $xml->saveHtml();
    $array = heading_parse($html);
    foreach ($array['h1'] as $h1) {
        if ($h1['title'] == 'ending') {
            foreach ($h1['h2'] as $h2) {
                if ($h2['title'] == 'left-1') {
                    $ending['left-1'] = $h2['content'];
                }
                if ($h2['title'] == 'left-2') {
                    $ending['left-2'] = $h2['content'];
                }
                if ($h2['title'] == 'left-3') {
                    $ending['left-3'] = $h2['content'];
                }
                if ($h2['title'] == 'left-4') {
                    $ending['left-4'] = $h2['content'];
                }
                if ($h2['title'] == 'right') {
                    $ending['right'] = $h2['content'];
                }
            }
        }
    }
}
// footer
$doc_footer_file_path = "_footer.md";
if (file_exists($doc_footer_file_path)) {
    $md = file_get_contents($doc_footer_file_path);
    $Parsedown = new Parsedown();
    $html = $Parsedown->text($md);
    $xml = new DOMDocument('1.0','UTF-8');
    $xml->loadHTML($html);
    foreach($xml->getElementsByTagName('a') as $link) { 
        $old_link = $link->getAttribute("href");
        if (!filter_var($old_link, FILTER_VALIDATE_URL)) { 
            // not url
            $link->setAttribute('href', $start_dir_path . $old_link);
        }
    }
    $html = $xml->saveHtml();
    $array = heading_parse($html);
    foreach ($array['h1'] as $h1) {
        if ($h1['title'] == 'footer') {
            $footer = $h1['content'];
        }
    }
}
// main
$request_uri_no_start = ltrim($request_uri, $start_dir_path); // tutorial/default.md, tutorial/, tutorial
if ($request_uri_no_start == "") {
    $doc_main_file_path = "default.md";
} elseif (substr($request_uri_no_start, -1) == "/") {
    $doc_main_file_path = $request_uri_no_start . "default.md";
} elseif (substr($request_uri_no_start, -3) == ".md") {
    $doc_main_file_path = $request_uri_no_start;
} else {
    $doc_main_file_path = $request_uri_no_start . "/default.md";
}
// var_dump($doc_main_file_path);
if (!file_exists($doc_main_file_path)) {
    $doc_main_file_path = "404.md";
}
$work_dir_path = $start_dir_path . dirname($doc_main_file_path) . '/';
$md = file_get_contents($doc_main_file_path);
$Parsedown = new Parsedown();
$html = $Parsedown->text($md);
$array = heading_parse($html);
$main = $array;
// meta
$meta_file_path = substr($doc_main_file_path, 0, -3) . ".json";
if (file_exists($meta_file_path)) {
    $json = file_get_contents($meta_file_path);
    $meta = json_decode($json, true);
}
// var_dump($data);
// echo getcwd();
// echo PHP_EOL;
// var_dump(glob('*'));
// echo PHP_EOL;
// exit();
switch (@$meta["mode"]) {
    case "ucp":
        include "view/ucp.php";
        break;
    case "itti":
        include "view/itti.php";
        break;
    case "text":
        include "view/text.php";
        break;
    default:
        include "view/text.php";
}