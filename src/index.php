<?php
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "module/Parsedown.php";
include "module/heading-array.php";
$content_path = "content.md";
$content_md = file_get_contents($content_path);
//echo $content_md;
$Parsedown = new Parsedown();
$content_html = $Parsedown->text($content_md);
//echo $content_html;
$content_array = heading_parse($content_html);
//echo json_encode($content_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//exit();
foreach ($content_array['h1'][0]['h2'] as $h2) {
    if ($h2['title'] == 'header') {
        foreach ($h2['h3'] as $h3) {
            if ($h3['title'] == 'icon') {
                $header['icon'] = strip_tags($h3['content']);
            }
            if ($h3['title'] == 'logo') {
                $header['logo'] = $h3['content'];
            }
            if ($h3['title'] == 'nav') {
                $header['nav'] = $h3['content'];
            }
        }
    }
    if ($h2['title'] == 'footer') {
        foreach ($h2['h3'] as $h3) {
            if ($h3['title'] == 'nav') {
                $footer['nav'] = $h3['content'];
            }
            if ($h3['title'] == 'ending') {
                $footer['ending'] = $h3['content'];
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
        <link rel="shortcut icon" href="<?=$header['icon']?>" />
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="css/csshake-default.min.css" type="text/css">
        <link rel="stylesheet" href="css/basic.css" type="text/css">
        <link rel="stylesheet" href="css/color.css" type="text/css">
        <link rel="stylesheet" href="css/content.css" type="text/css">
        <link rel="stylesheet" href="css/layout.css" type="text/css">
        <link rel="stylesheet" href="css/layout-small.css" type="text/css">
        <link rel="stylesheet" href="css/pop.min.css" type="text/css">
        <title><?=$content_array['h1'][0]['title']?></title>
    </head>
    <body>
        <header>
            <div class="container">
                <div id="logo">
                    <a href="index.php">
                        <?=$header['logo']?>
                    </a>
                </div>
                <div class="nav">
                    <?=$header['nav']?>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <?php
                echo '<div class="description">';
                    echo $content_array['h1'][0]['content'];
                echo '</div>';
                foreach ($content_array['h1'][0]['h2'] as $i => $h2) {
                    if ($h2['title'] != 'footer' && $h2['title'] != 'header') {
                        echo '<div id="' . $h2['title'] . '" class="unit' . ($i % 2 === 0 ? '' : ' bg-color') . '">';
                            echo '<h2 class="shake">';
                                echo $h2['title'];
                            echo '</h2>';
                            echo '<div class="shake">';
                                echo $h2['content'];
                            echo '</div>';
                            if (is_array($h2['h3'])) {
                                $n = count($h2['h3']);
                                foreach ($h2['h3'] as $h3) {
                                    echo '<div class="card o' . $n . ' shake">';
                                    echo '<h3>' . $h3['title'] . '</h3>';
                                    echo $h3['content'];
                                    foreach ($h3['h4'] as $h4) {
                                        $h4_json = json_encode($h4);
                                        echo "<a href ='javascript:void(0);' onclick ='pop.open(" . $h4_json . ");'>";
                                        echo $h4['title'].'&nbsp;';
                                        echo "</a>";
                                    }
                                    echo '</div>';
                                }
                            }
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </main>
        <footer>
            <div class="container">
                <div class="nav"><?=$footer['nav']?></div>
                <div class="ending"><?=$footer['ending']?></div>
            </div>
        </footer>
    </body>
</html>
<script src="js/pop.min.js"></script>
<<<<<<< HEAD
<script src="js/wow.min.js"></script>
<script src="js/card-height.js"></script>
=======
<!-- <script src="js/wow.min.js"></script> -->
<!-- <script src="js/card.js"></script> -->
>>>>>>> a86fd8d68730c78ae253d107aef2c4fdc0cf061f
<script>
    // new WOW().init();
</script>

