<?php
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "module/Parsedown.php";
include "module/heading-array.php";
$data_dir = "./";
$data_default = "index.md";
$data_path = $data_default;
if ($_GET["f"]) {
    $data_name = $_GET["f"] . ".md";
    $data_path = $data_dir . $data_name;
}
$data_md = file_get_contents($data_path);
//echo $data_md;
$Parsedown = new Parsedown();
$data_html = $Parsedown->text($data_md);
//echo $data_html;
$data_array = heading_parse($data_html);
//echo json_encode($data_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//exit();
$content = array();
$content = $data_array['h1'][0];
$config = array();
$config['title'] = $content['title'];
foreach ($data_array['h1'] as $h1) {
    if ($h1['title'] == 'CONFIG') {
        foreach ($h1['h2'] as $h2) {
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
        <title><?=$config['title']?></title>
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
