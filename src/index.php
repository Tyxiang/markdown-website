<?php
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "module/Parsedown.php";
include "module/heading-array.php";
$content_dir = "content/";
$content_default = "index.md";
$content_path = $content_default;
if ($_GET["f"]) {
    $content_name = $_GET["f"] . ".md";
    $content_path = $content_dir . $content_name;
}
$content_md = file_get_contents($content_path);
//echo $content_md;
$Parsedown = new Parsedown();
$content_html = $Parsedown->text($content_md);
//echo $content_html;
$content_array = heading_parse($content_html);
//echo json_encode($content_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//exit();
$config = array();
$config['title'] = $content_array['h1'][0]['title'];
foreach ($content_array['h1'][0]['h2'] as $h2) {
    if ($h2['title'] == 'CONFIG') {
        foreach ($h2['h3'] as $h3) {
            if ($h3['title'] == 'title') {
                $config['title'] = strip_tags($h3['content']);
            }
            if ($h3['title'] == 'icon') {
                $config['icon'] = strip_tags($h3['content']);
            }
            if ($h3['title'] == 'keywords') {
                $config['keywords'] = strip_tags($h3['content']);
            }
            if ($h3['title'] == 'header') {
                foreach ($h3['h4'] as $h4) {
                    if ($h4['title'] == 'logo') {
                        $config['header']['logo'] = $h4['content'];
                    }
                    if ($h4['title'] == 'nav') {
                        $config['header']['nav'] = $h4['content'];
                    }
                }
            }
            if ($h3['title'] == 'footer') {
                foreach ($h3['h4'] as $h4) {
                    if ($h4['title'] == 'nav') {
                        $config['footer']['nav'] = $h4['content'];
                    }
                    if ($h4['title'] == 'ending') {
                        $config['footer']['ending'] = $h4['content'];
                    }
                }
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
echo $content_array['h1'][0]['content'];
foreach ($content_array['h1'][0]['h2'] as $i => $h2) {
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
?>
            </div>
        </main>
        <?php
if ($config['footer']) {
    echo '<footer>';
    echo '<div class="container">';
    if ($config['footer']['nav']) {
        echo '<div class="nav">';
        echo $config['footer']['nav'];
        echo '</div>';
    }
    if ($config['footer']['ending']) {
        echo '<div class="ending">';
        echo $config['footer']['ending'];
        echo '</div>';
    }
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
