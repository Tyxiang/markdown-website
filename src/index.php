<?php
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "module/Parsedown.php";
include "module/heading-array.php";
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
        <link rel="icon" type="image/png" href="data:image/png; base64, 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"/>
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