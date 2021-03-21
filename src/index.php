<?php
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "Parsedown.php";
include "heading-array.php";
// setting
$Parsedown = new Parsedown();
// query
$file = $_GET['f'];
if ($file == '') {
    $file = 'index';
}
$mode = $_GET['m'];
if ($mode != 'show' && $mode != 'word') {
    $mode = 'show';
}
if (isset($_GET['s'])) {
    $mode = 'show';
}
if (isset($_GET['w'])) {
    $mode = 'word';
}
// config
$path_config = "config.md";
$md_config = file_get_contents($path_config);
$html_config = $Parsedown->text($md_config);
$array_config = heading_parse($html_config);
$config = array();
foreach ($array_config['h1'][0]['h2'] as $h2) {
    if ($h2['title'] == 'global') {
        foreach ($h2['h3'] as $h3) {
            if ($h3['title'] == 'name') {
                $config['global']['name'] = strip_tags($h3['content']);
            }
            if ($h3['title'] == 'color') {
                $config['global']['color'] = strip_tags($h3['content']);
            }
        }
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
    if ($h2['title'] == 'footer') {
        foreach ($h2['h3'] as $h3) {
            if ($h3['title'] == 'nav') {
                $config['footer']['nav'] = $h3['content'];
            }
            // if ($h3['title'] == 'card') {
            //     $config['footer']['card'] = $h3['h4'];
            // }
            if ($h3['title'] == 'ending') {
                $config['footer']['ending'] = $h3['content'];
            }
        }
    }
}
// content
$path_content = $file . ".md";
$md_content = file_get_contents($path_content);
$html_content = $Parsedown->text($md_content);
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="icon" href="favicon.png" type="image/png"/>
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="css/basic.css" type="text/css">
        <link rel="stylesheet" href="css/color.css" type="text/css">
        <link rel="stylesheet" href="css/content.css" type="text/css">
        <link rel="stylesheet" href="css/layout.css" type="text/css">
        <link rel="stylesheet" href="css/layout-small.css" type="text/css">
        <link rel="stylesheet" href="css/this.css" type="text/css">
        <link rel="stylesheet" href="css/this-small.css" type="text/css">
        <link rel="stylesheet" href="css/pop.min.css" type="text/css">
        <style type="text/css">:root { --primary-h: <?=$config['global']['color']?>; } </style>
        <title><?=$config['global']['name']?></title>
    </head>
    <body>
        <header>
            <div class="container">
                <div id="logo">
                    <a href="index.php">
                        <?=$config['header']['logo']?>
                    </a>
                </div>
                <div class="nav">
                    <?=$config['header']['nav']?>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <?php
                if ($mode == 'show') {
                    $array_content = heading_parse($html_content);
                    echo '<div class="description">';
                        echo $array_content['h1'][0]['content'];
                    echo '</div>';
                    foreach ($array_content['h1'][0]['h2'] as $i => $h2) {
                        echo '<div id="' . $h2['title'] . '" class="unit' . ($i % 2 === 0 ? '' : ' b') . '">';
                            echo '<h2 class="wow animate__animated animate__bounceIn">';
                                echo $h2['title'];
                            echo '</h2>';
                            echo '<div class="wow animate__animated animate__zoomInDown">';
                                echo $h2['content'];
                            echo '</div>';
                            if (is_array($h2['h3'])) {
                                $n = count($h2['h3']);
                                foreach ($h2['h3'] as $h3) {
                                    echo '<div class="card o' . $n . ' wow animate__animated animate__lightSpeedInRight">';
                                    echo '<h3>' . $h3['title'] . '</h3>';
                                    echo $h3['content'];
                                    foreach ($h3['h4'] as $h4) {
                                        $h4_json = json_encode($h4);
                                        echo "<a href ='javascript:void(0);' onclick ='pop.open(" . $h4_json . ");'>";
                                        echo $h4['title'];
                                        echo "</a>";
                                    }
                                    echo '</div>';
                                }
                            }
                        echo '</div>';
                    }
                }
                if ($mode == 'word') {
                    echo $html_content;
                }
                ?>
            </div>
        </main>
        <footer>
            <div class="container">
                <div class="nav"><?=$config['footer']['nav']?></div>
                <div class="ending"><?=$config['footer']['ending']?></div>
            </div>
        </footer>
    </body>
</html>

<script src="js/pop.min.js"></script>
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>

<?php
// echo json_encode($about, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//echo $html;
?>