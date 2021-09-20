<?php
// data = docu + config
ini_set("display_errors", "Off");
date_default_timezone_set("Asia/Shanghai");
include "module/data.php";
$file_dir = "file/";
$data = array();
//// default config
$config_filename = "config.md";
$config_path = $file_dir . $config_filename;
$data = update_data($config_path, $data);
//// data
$data_filename = "default.md"; // default data file
if ($_GET["f"]) {
    $data_filename = $_GET["f"] . ".md";
}
$data_path = $file_dir . $data_filename;
$data = update_data($data_path, $data);
if (!$data['config']['title']){
    $data['config']['title'] = trim($data['docu']['title']);
}
// echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//exit();
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="Keywords" Content="<?=$data['config']['keywords']?>">
        <link rel="shortcut icon" href="<?=$data['config']['icon']?>" />
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/basic.css" type="text/css">
        <link rel="stylesheet" href="css/color.css" type="text/css">
        <link rel="stylesheet" href="css/layout.css" type="text/css">
        <link rel="stylesheet" href="css/small-screen.css" type="text/css">
        <link rel="stylesheet" href="css/text.css" type="text/css">
        <link rel="stylesheet" href="css/ucp.css" type="text/css">
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="css/pop.min.css" type="text/css">
        <title><?=$data['config']['title'] . ' - ' . $data['config']['name']?></title>
    </head>
    <body>
        <?php
if ($data['config']['header']) {
    echo '<header>';
    echo '<div class="container">';
    if ($data['config']['header']['logo']) {
        echo '<div id="logo">';
        echo '<a href="index.php">';
        echo $data['config']['header']['logo'];
        echo '</a>';
        echo '</div>';
    }

    echo '</div>';
    echo '<div class="container">';
    if ($data['config']['header']['nav']) {
        echo '<div class="nav">';
        echo $data['config']['header']['nav'];
        echo '</div>';
    }
    echo '</div>';
    echo '</header>';
}
?>
        <main>
            <div class="container">
                <?php
if (!$data['config']['mode']) {
    $data['config']['mode'] = 'text';
}
if ($data['config']['mode'] == 'text') {
    echo '<div class="text">';
    echo '<h1>';
    echo $data['docu']['title'];
    echo '</h1>';
    echo $data['docu']['content'];
    echo $data['docu']['others'];
    echo '</div>';
} 
if ($data['config']['mode'] == 'ucp') {
    echo '<div class="ucp">';
    echo $data['docu']['content'];
    foreach ($data['docu']['h2'] as $i => $h2) {
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
    echo '</div>';
}
?>
            </div>
        </main>
        <?php
if ($data['config']['ending']) {
    echo '<ending>';
    echo '<div class="container">';
    if ($data['config']['ending']['left-1']) {
        echo '<div class="left-1">';
        echo $data['config']['ending']['left-1'];
        echo '</div>';
    }
    if ($data['config']['ending']['left-2']) {
        echo '<div class="left-2">';
        echo $data['config']['ending']['left-2'];
        echo '</div>';
    }
    if ($data['config']['ending']['left-3']) {
        echo '<div class="left-3">';
        echo $data['config']['ending']['left-3'];
        echo '</div>';
    }
    if ($data['config']['ending']['right']) {
        echo '<div class="right">';
        echo $data['config']['ending']['right'];
        echo '</div>';
    }
    echo '</div>';
    echo '</ending>';
}
if ($data['config']['footer']) {
    echo '<footer>';
    echo '<div class="container">';
    echo $data['config']['footer'];
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
