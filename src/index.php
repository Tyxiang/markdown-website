<?php
// data file = content data + config data
// config file = config data
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "module/Parsedown.php";
include "module/heading-array.php";
include "module/function.php";
$Parsedown = new Parsedown();
$data_dir = "data/";
//// config file
$config_file_name = "config.md";
if ($_GET["c"]) {
    $config_file_name = $_GET["c"] . ".md";
}
$config_path = $data_dir . $config_file_name;
if (file_exists($config_path)) {
    $config_md = file_get_contents($config_path);
    $config_html = $Parsedown->text($config_md);
    $config_array = heading_parse($config_html);
    $config = array();
    $config = update_config($config_array, $config);
}
//// data file
$data_file_name = "index.md"; // default
if ($_GET["d"]) {
    $data_file_name = $_GET["d"] . ".md";
}
$data_path = $data_dir . $data_file_name;
if (file_exists($data_path)) {
    $data_md = file_get_contents($data_path);
    $data_html = $Parsedown->text($data_md);
    $data_array = heading_parse($data_html);
    $content = array();
    $content = $data_array['h1'][0];
    $config['title'] = $content['title'];
    $config = update_config($data_array, $config);
}
// echo json_encode($config, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
// exit();
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="Keywords" Content="<?=$config['keywords']?>">
        <link rel="shortcut icon" href="<?=$config['icon']?>" />
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/basic.css" type="text/css">
        <link rel="stylesheet" href="css/color.css" type="text/css">
        <link rel="stylesheet" href="css/content.css" type="text/css">
        <link rel="stylesheet" href="css/layout.css" type="text/css">
        <link rel="stylesheet" href="css/layout-small.css" type="text/css">
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="css/pop.min.css" type="text/css">
        <title><?=$config['title'] . '-' . $config['name']?></title>
    </head>
    <body>
        <?php
if ($config['header']) {
    echo '<header>';
    echo '<div class="container">';
    if ($config['header']['logo']) {
        echo '<div id="logo">';
        echo '<a href="index.php">';
        echo $config['header']['logo'];
        echo '</a>';
        echo '</div>';
    }
    if ($config['header']['nav']) {
        echo '<div class="nav">';
        echo $config['header']['nav'];
        echo '</div>';
    }
    echo '</div>';
    echo '</header>';
}
?>
        <main>
            <div class="container">
                <?php
if ($config['mode'] == 'text') {
    echo '<h1>';
    echo $content['title'];
    echo '</h1>';
    echo $content['others'];
} else {
    echo $content['content'];
    foreach ($content['h2'] as $i => $h2) {
        if ($h2['title'] != 'CONFIG') {
            echo '<div id="' . $h2['title'] . '" class="unit">';
            echo '<h2 class="wow animate__animated animate__bounceIn">';
            echo $h2['title'];
            echo '</h2>';
            echo '<div class="wow animate__animated animate__zoomInDown">';
            echo $h2['content'];
            echo '</div>';
            echo '<div class="cards">';
            if (is_array($h2['h3'])) {
                $n = count($h2['h3']);
                foreach ($h2['h3'] as $h3) {
                    echo '<div class="card o' . $n . ' wow animate__animated animate__lightSpeedInRight">';
                    echo '<h3>' . $h3['title'] . '</h3>';
                    echo $h3['content'];
                    echo '<p>';
                    foreach ($h3['h4'] as $h4) {
                        $h4_json = json_encode($h4);
                        echo "<a href ='javascript:void(0);' onclick ='pop.open(" . $h4_json . ");'>";
                        echo $h4['title'] . '&nbsp;';
                        echo "</a>";
                    }
                    echo '</p>';
                    echo '</div>';
                }
            }
            echo '</div>';
            echo '</div>';
        }
    }
}

?>
            </div>
        </main>
        <?php
if ($config['ending']) {
    echo '<ending>';
    echo '<div class="container">';
    if ($config['ending']['left']) {
        echo '<div class="left">';
        echo $config['ending']['left'];
        echo '</div>';
    }
    if ($config['ending']['center']) {
        echo '<div class="center">';
        echo $config['ending']['center'];
        echo '</div>';
    }
    if ($config['ending']['right']) {
        echo '<div class="right">';
        echo $config['ending']['right'];
        echo '</div>';
    }
    echo '</div>';
    echo '</ending>';
}
if ($config['footer']) {
    echo '<footer>';
    echo '<div class="container">';
    echo $config['footer'];
    echo '</div>';
    echo '</footer>';
}
?>
    </body>
</html>
<script src="js/pop.min.js"></script>
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
